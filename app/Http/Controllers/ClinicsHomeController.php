<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AffiliatedDoctor;
use App\Models\Clinic;
use App\Models\Consultation;
use App\Models\ConsultationFile;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClinicsHomeController extends Controller
{
    private $module = "Dashboard";
    private $model = "Consultation";
    private $viewFolder = "clinics_home";
    private $modalSize = "modal-lg";

    // public function __construct()
    // {
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?int $yr = null, ?int $mon = null, ?int $dayNum = null, ?string $booking_type = null, ?string $specialty = null, ?int $doctor_id = null)
    {
        $user = Auth::user();
        if(!isset($yr))
            $yr = date('Y');
        if(!isset($mon))
            $mon = date('n');
        $dayNumSet  = true;
        if(!isset($dayNum))
            $dayNumSet  = false;
        if(!isset($dayNum) && date('n') == $mon && date('Y') == $yr){
            $dayNum = date('d');
        }elseif(!isset($dayNum)){
            $dayNum = 1;
        }
        if(isset($doctor_id)){
            $schedules = User::whereIn('id', $user->clinic->schedules()->where('dateSched', $yr . '-' . str_pad($mon, 2, 0, STR_PAD_LEFT) . '-' . $dayNum)->get('doctor_id'))->where('id', $doctor_id);
            if(!empty($schedules->get()[0]->specialty))
                $specialty = $schedules->get()[0]->specialty;
            $schedulesMon = User::whereIn('id', $user->clinic->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get('doctor_id'))->where('id', $doctor_id);
        }elseif(isset($specialty)){
            $schedules = User::whereIn('id', $user->clinic->schedules()->where('dateSched', $yr . '-' . str_pad($mon, 2, 0, STR_PAD_LEFT) . '-' . $dayNum)->get('doctor_id'))->where('specialty', $specialty);
            $schedulesMon = User::whereIn('id', $user->clinic->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get('doctor_id'))->where('specialty', $specialty);
        }else{
            $schedules = User::whereIn('id', $user->clinic->schedules()->where('dateSched', $yr . '-' . str_pad($mon, 2, 0, STR_PAD_LEFT) . '-' . $dayNum)->get('doctor_id'));
            $schedulesMon = User::whereIn('id', $user->clinic->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get('doctor_id'));
        }

        unset($booking_type_arr);
        
        foreach($user->clinic->bookings()->distinct('booking_type')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get() as $in=>$booking){
            if($booking->consultation_parent_id != "")
                $booking_type_arr['Referral'] = 'Referral';
            if($booking->booking_type == '')
                $booking_type_arr['Consultation'] = 'Consultation';
            else
                $booking_type_arr[$booking->booking_type] = $booking->booking_type;
        }
        if(isset($booking_type_arr))
            ksort($booking_type_arr);
        if((!isset($booking_type) || $booking_type == 'NULL') && isset($booking_type_arr))
            $booking_type = reset($booking_type_arr);
        elseif((!isset($booking_type) || $booking_type == 'NULL'))
            $booking_type = 'Consultation';

        if(!isset($booking_type_arr))
            $booking_type_arr = null;

        $patients = $user->patients->sortBy('name');
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", "Please fullfill the form first. Make sure you also change the old password.");
        else{
            return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'viewFolder' => $this->viewFolder, 
                'yr'=>$yr, 
                'mon'=>$mon, 
                'dayNum'=>$dayNum,
                'dayNumSet'=>$dayNumSet,
                'user'=>$user,
                'specialty'=>$specialty,
                'doctor_id'=>$doctor_id,
                'booking_type'=>$booking_type,
                'booking_type_arr'=>$booking_type_arr,
                'schedules'=>$schedules,
                'schedulesMon'=>$schedulesMon,
                'patients'=>$patients
            ]);
        }
    }

    public function manageDoctor()
    {
        $user = Auth::user();
        
        $yr = null;
        $mon = null;
        $dayNum = null;
        $datum =  (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'datum' => $datum, 
                'inputFormHeader' => 'Manage  Affiliated Doctors', 
                'formAction' => 'storeDoctor', 
                'viewFolder' => $this->viewFolder, 
                'action'=> 'manageDoctor', 
                'selectItems' => $this->selectItems(),
                'user' => $user,
                'yr' => $yr, 
                'mon' => $mon, 
                'dayNum' => $dayNum, 
                'modalSize' => $this->modalSize, 
                'modal' => true
            ]);
    }

    public function storeDoctor(Request $request)
    {
        $user = Auth::user();
        AffiliatedDoctor::where('clinic_id', $user->clinic_id)->whereNot('active', 1)->update(['active' => 2]);
        if(!empty($request->input($this->viewFolder)['doctor_id'])){
            AffiliatedDoctor::where('clinic_id', $user->clinic_id)
                            ->whereIn('doctor_id', $request->input($this->viewFolder)['doctor_id'])
                            ->update(['active' => 1]);
        }
        

        return redirect()->route($this->viewFolder . '.index')->with('message', "Approved doctor's affiliation request.");
    }

    public function book(Request $request)
    {
        // dd($request);

        $user = Auth::user();
        
        $yr = null;
        $mon = null;
        $dayNum = null;
        $datum =  (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        $doctor =  User::find($request->input($this->viewFolder)['doctor_id']);
        $patients = $user->patients->sortBy('name');
        return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'datum' => $datum, 
                'inputFormHeader' => 'Add Booking', 
                'formId' => 'bookMod',
                'formAction' => 'storeBook',
                'viewFolder' => $this->viewFolder, 
                'action'=> 'book', 
                'selectItems' => $this->selectItems(),
                'user' => $user,
                'doctor' => $doctor,
                'yr' => $yr, 
                'mon' => $mon, 
                'dayNum' => $dayNum, 
                'modalSize' => 'modal-xl', 
                'modal' => true,
                'dateBooking' => $request->input($this->viewFolder)['dateSched'],
                'patients'=>$patients
            ]);
    }

    public function storeBook(Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        $patient = $params['Patient'];
        if(!empty($request->clinics_home['Patient']['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->clinics_home['Patient']['profile_pic']->extension();
            $request->clinics_home['Patient']['profile_pic']->storeAs('public/px_files', $profile_pic);
            $patient['profile_pic'] = $profile_pic;
        }
        unset($params['Patient']);
        $patient['client_id'] = $user->id;
        $patient['name'] = $patient['f_name'] . " " . $patient['m_name'] . " " . $patient['l_name'];
        $patient['birthdate'] = date('Y-m-d', strtotime($patient['birthdate']));
        if(isset($patient['pastMedicalHistory']))
            $patient['pastMedicalHistory'] = json_encode($patient['pastMedicalHistory']);
        if(isset($patient['pastFamilyHistory']))
            $patient['pastFamilyHistory'] = json_encode($patient['pastFamilyHistory']);
        if(isset($patient['allergies']))
            $patient['allergies'] = json_encode($patient['allergies']);
        $patient['created_by'] = $user->id;
        $patient['updated_by'] = $user->id;
        if(isset($params['patient_id'])){
            $patientObj = Patient::find($params['patient_id']);
            $patientObj->update($patient);
        }else{
            $patientObj = Patient::create($patient);
        }
        $params['bookingDate'] = date('Y-m-d', strtotime($params['bookingDate']));
        if(is_null($params['booking_type']))
            $params['booking_type'] = '';
        $doctorObj = User::find($params['doctor_id']);
        $params['fee'] = $doctorObj->fee;
        $params['status'] = "Confirmed";
        $params['patient_id'] = $patientObj->id;
        $params['client_id'] = $user->id;
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        Consultation::create($params);
        return redirect()->route($this->viewFolder . '.index')->with('message', "Booking successfully saved.");
    }

    public function updateMyAccount(User $clinics_home, Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        // dd($params);
        $userInputedDetails = $params['user'];
        unset($params['user']);
        $params['updated_by'] = $user->id;
        if($userInputedDetails['passwordOld'] != ''){
            if (Hash::check($userInputedDetails['passwordOld'], $user->getAuthPassword())) {
                $userInputedDetails['password'] = Hash::make($userInputedDetails['passwordNew']);
                // dd($params);
                $user->update($userInputedDetails);
                $clinics_home->clinic->update($params);
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
            }else{
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Invalid old password.');
            }
        }else{
            $clinics_home->clinic->update($params);
            return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
        }
        
        
    }

    public function edit(Consultation $clinics_home, Request $request)
    {
        $data = $this->getData($request->input());
        $user = Auth::user();
        $datum = $clinics_home;
        $yr = null;
        $mon = null;
        $dayNum = null;
        $patients = $user->patients->sortBy('name');
        return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'data' => $data, 
                'datum' => $datum, 
                'inputFormHeader' => 'Edit Booking', 
                'formId' => 'bookMod',
                'formAction' => 'update', 
                'viewFolder' => $this->viewFolder, 
                'action'=> 'book', 
                'selectItems' => $this->selectItems(),
                'user' => $user,
                'doctor' => $datum->doctor,
                'yr' => $yr, 
                'mon' => $mon, 
                'dayNum' => $dayNum, 
                'modalSize' => 'modal-xl', 
                'modal' => true,
                'dateBooking' => $datum->bookingDate,
                'patients'=>$patients, 
                'viewFolder' => $this->viewFolder, 
                'modalSize' => 'modal-xl'
            ]);
    }

    public function update(Request $request, Consultation $clinics_home)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        if(isset($params['referal'])){
            $referalExp = explode(',', $params['referal']);
            foreach($referalExp as $refDet){
                $refDetExp = explode(" | ", $refDet);
                $clinicExp = explode(" - ", $refDetExp[1]);
                $doctorExp = explode(" - ", $refDetExp[2]);
                $bookingReplication = $clinics_home->replicate();
                $bookingReplication['bookingDate'] = $refDetExp[0];
                $bookingReplication['clinic_id'] = $clinicExp[0];
                $bookingReplication['doctor_id'] = $doctorExp[0];
                $bookingReplication['consultation_parent_id'] = $clinics_home->id;
                $bookingReplication['created_by'] = $user->id;
                $bookingReplication['updated_by'] = $user->id;
                $bookingReplication->save();
                // $consultationFilesObj = ConsultationFile::where('consultation_id', $clinics_home->id)->get();
                // foreach($consultationFilesObj as $consultationFile){
                //     unset($consultationFileArr);
                //     $consultationFileArr['consultation_id'] = $bookingReplication->id;
                //     $consultationFileArr['file_link'] = $consultationFile->file_link;
                //     $consultationFileArr['file_type'] = $consultationFile->file_type;
                //     $consultationFileArr['created_by'] = $user->id;
                //     $consultationFileArr['updated_by'] = $user->id;
                //     ConsultationFile::create($consultationFileArr);
                // }
            }
            unset($params['referal']);
        }
        $patient = $params['Patient'];
        if(!empty($request->clinics_home['Patient']['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->clinics_home['Patient']['profile_pic']->extension();
            $request->clinics_home['Patient']['profile_pic']->storeAs('public/px_files', $profile_pic);
            $patient['profile_pic'] = $profile_pic;
        }
        if(!empty($request->clinics_home['ConsultationFile']['files'])){
            foreach($request->clinics_home['ConsultationFile']['files'] as $ind => $file){
                unset($parFile);
                $file_name = $clinics_home->id . '_consultation_' . date('ymdhis') . $ind . '.' . $file->extension();
                $file->storeAs('public/consultation_files', $file_name);
                $parFile['consultation_id'] = $clinics_home->id;
                $parFile['file_link'] = 'storage/consultation_files/' . $file_name;
                $parFile['file_type'] = $file->getMimeType();
                $params['created_by'] = $user->id;
                $params['updated_by'] = $user->id;
                ConsultationFile::create($parFile);
            }
        }
        unset($params['Patient']);
        $patient['client_id'] = $user->id;
        $patient['name'] = $patient['f_name'] . " " . $patient['m_name'] . " " . $patient['l_name'];
        $patient['birthdate'] = date('Y-m-d', strtotime($patient['birthdate']));
        if(isset($patient['pastMedicalHistory']))
            $patient['pastMedicalHistory'] = json_encode($patient['pastMedicalHistory']);
        else
            $patient['pastMedicalHistory'] = json_encode('');
        if(!isset($patient['pastMedicalHistoryCancer']))
            $patient['pastMedicalHistoryCancer'] = '';
        if(!isset($patient['pastMedicalHistoryOthers']))
            $patient['pastMedicalHistoryOthers'] = '';

        if(isset($patient['pastFamilyHistory']))
            $patient['pastFamilyHistory'] = json_encode($patient['pastFamilyHistory']);
        else
            $patient['pastFamilyHistory'] = json_encode('');
        if(!isset($patient['pastFamilyHistoryCancer']))
            $patient['pastFamilyHistoryCancer'] = '';
        if(!isset($patient['pastFamilyHistoryOthers']))
            $patient['pastFamilyHistoryOthers'] = '';
        
        if(isset($patient['allergies']))
            $patient['allergies'] = json_encode($patient['allergies']);
        else
            $patient['allergies'] = json_encode('');
        if(!isset($patient['allergiesFood']))
            $patient['allergiesFood'] = '';
        if(!isset($patient['allergiesMedicine']))
            $patient['allergiesMedicine'] = '';
        if(!isset($patient['allergiesOthers']))
            $patient['allergiesOthers'] = '';
        if(!isset($patient['referral_from']))
            $patient['referral_from'] = '';
        
        $patient['updated_by'] = $user->id;
        $clinics_home->patient->update($patient);
        $params['bookingDate'] = date('Y-m-d', strtotime($params['bookingDate']));
        if(is_null($params['booking_type']))
            $params['booking_type'] = '';
        if($params['arod_sphere'] == 'No Target'){
            $params['arod_cylinder'] = null;
            $params['arod_axis'] = null;
        }
        if($params['aros_sphere'] == 'No Target'){
            $params['aros_cylinder'] = null;
            $params['aros_axis'] = null;
        }
        if($params['vaod_num'] == 'NA'){
            $params['vaod_den'] = null;
        }
        if($params['vaodcor_num'] == 'NA'){
            $params['vaodcor_den'] = null;
        }
        if($params['vaos_num'] == 'NA'){
            $params['vaos_den'] = null;
        }
        if($params['vaoscor_num'] == 'NA'){
            $params['vaoscor_den'] = null;
        }
        if($params['pinod_num'] == 'NA'){
            $params['pinod_den'] = null;
        }
        if($params['pinodcor_num'] == 'NA'){
            $params['pinodcor_den'] = null;
        }
        if($params['pinos_num'] == 'NA'){
            $params['pinos_den'] = null;
        }
        if($params['pinoscor_num'] == 'NA'){
            $params['pinoscor_den'] = null;
        }    
        
        $params['patient_id'] = $clinics_home->patient->id;
        $params['client_id'] = $user->id;
        $params['updated_by'] = $user->id;
        $clinics_home->update($params);
        
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been updated.');
    }

    public function destroy($id)
    {
        Consultation::destroy($id);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
    }

    function getPatientInfo(?int $patient_id){
        $patient = Patient::find($patient_id);
        return json_encode($patient);
    }

    function deleteUploadedFile(?int $id){
        ConsultationFile::destroy($id);
    }

    private function getData($search_query = null)
    {
        $condition = $this->queryBuilder('consultations', !empty($search_query['clinics_home']) ? $search_query['clinics_home'] : '');
        // dd($search_query);
        $data = Consultation::where($condition)
            ->sortable(['id' => 'asc'])
            ->paginate($this->page);
        //dd($data);
        return $data;
        
    }

    private function queryBuilder($model, $search_query){
        $condition[] = [$model . '.active', 1];
        if(!empty($search_query)){
            foreach($search_query as $colName => $searchDet){
                if($searchDet != "")
                    $condition[] = [$model . '.' . $colName, 'like', "%" . $searchDet . "%"];
            }
        }
        return $condition;
    }

    private function selectItems()
    {
        $selectItems['doctors'] = User::where('user_type', 'Doctor')->orderBy('name', 'asc')->get();
        return $selectItems;
    }
    
}
