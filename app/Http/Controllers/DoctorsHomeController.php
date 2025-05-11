<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Schedule;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\ScheduleConso;
use App\Models\AffiliatedDoctor;
use App\Models\ConsultationFile;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorsHomeController extends Controller
{
    private $module = "Dashboard";
    private $viewFolder = "doctors_home";
    private $modalSize = "modal-lg";

    // public function __construct()
    // {
    // }
    
    public function index(?int $yr = null, ?int $mon = null, ?int $dayNum = null, ?string $booking_type = null)
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

        unset($booking_type_arr);
        
        foreach($user->bookings()->distinct('booking_type')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get() as $in=>$booking){
            if($booking->consultation_parent_id != "")
                $booking_type_arr['Referral'] = 'Referral';
            else{
                if($booking->booking_type == '')
                    $booking_type_arr['Consultation'] = 'Consultation';
                else
                    $booking_type_arr[$booking->booking_type] = $booking->booking_type;
            }
            
        }
        if(isset($booking_type_arr))
            ksort($booking_type_arr);
        if(!isset($booking_type) && isset($booking_type_arr))
            $booking_type = reset($booking_type_arr);

        if(!isset($booking_type_arr))
            $booking_type_arr = null;

        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", "Please fullfill the form first. Make sure you also change the old password.");
        else{
            return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'viewFolder' => $this->viewFolder,
                'booking_type'=>$booking_type,
                'booking_type_arr'=>$booking_type_arr,
                'yr'=>$yr, 
                'mon'=>$mon, 
                'dayNum'=>$dayNum,
                'user'=>$user
            ]);
        }
            
    }

    public function manageSchedule(Request $request)
    {
        $user = Auth::user();
        $yr = null;
        $mon = null;
        $dayNum = null;
        $data = $user->scheduleConsos;
        $datum =  (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        return view($this->viewFolder . '.index', [
            'moduleList' => $this->moduleList(), 
            'moduleActive' => $this->module, 
            'data' => $data, 
            'datum' => $datum, 
            'inputFormHeader' => 'Manage Schedule', 
            'formAction' => 'storeSchedule', 
            'viewFolder' => $this->viewFolder, 
            'action'=> 'manageSchedule', 
            'selectItems' => $this->selectItems(),
            'yr'=>$yr, 
            'mon'=>$mon, 
            'dayNum'=>$dayNum, 
            'modalSize' => $this->modalSize, 
            'modal' => true,
            'user' => $user
        ]);
    }

    public function storeSchedule(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        unset($params);
        $params = $request[$this->viewFolder];
        $params['doctor_id'] = $user->id;
        $params['date_from'] = date('Y-m-d', strtotime($params['date_from']));
        $params['date_to'] = date('Y-m-d', strtotime($params['date_to']));
        $params['time_from'] = date('H:i:s', strtotime($params['time_from']));
        $params['time_to'] = date('H:i:s', strtotime($params['time_to']));
        $params['days'] = json_encode($params['days']);
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        // dd($params);
        $sc = ScheduleConso::create($params);

        for($i=strtotime($sc->date_from . ' ' . $sc->time_from); $i<=strtotime($sc->date_to . ' ' . $sc->time_to); ){
            $daysDecode = json_decode($sc->days);
            unset($timeslot);
            if(in_array(date('D', strtotime(date('Y-m-d H:i:s', $i) . ' +' . $sc->timeslot_interval . ' minutes')), $daysDecode) && date('H:i', strtotime(date('Y-m-d H:i:s', $i) . ' +' . $sc->timeslot_interval . ' minutes')) <= $sc->time_to && date('H:i', strtotime(date('Y-m-d H:i:s', $i) . ' +' . $sc->timeslot_interval . ' minutes')) > $sc->time_from)
                $timeslot = date('H:i', $i);
            $i = strtotime(date('Y-m-d H:i:s', $i) . ' +' . $sc->timeslot_interval . ' minutes');
            // print date('Y-m-d', $i) . "<br>";
            // print date('D', $i) . "<br>";
            // print date('H:i', $i) . "<br>";
            // print $i . "<br>";
            // print strtotime($sc->date_to . ' ' . $sc->time_to) . "<br>";
            if(in_array(date('D', $i), $daysDecode) && date('H:i', $i) <= $sc->time_to && date('H:i', $i) > $sc->time_from){
                $timeslot .= ' - ' .  date('H:i', strtotime(date('Y-m-d H:i:s', $i) . ' -1 minute'));
                // print date('Y-m-d', strtotime(date('Y-m-d H:i:s', $i) . ' -1 minute')) . "<br>";    
                // print $timeslot . "<br>"; 
                unset($params);
                $params['schedule_conso_id'] = $sc->id;
                $params['clinic_id'] = $sc->clinic_id;
                $params['doctor_id'] = $sc->doctor_id;
                $params['dateSched'] = date('Y-m-d', strtotime(date('Y-m-d H:i:s', $i) . ' -1 minute'));
                $params['timeslot'] = $timeslot;
                $params['created_by'] = $user->id;
                $params['updated_by'] = $user->id;   
                Schedule::create($params);
            }
            
        }
        
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Doctor schedule saved.');
    }

    public function manageClinic()
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
                'inputFormHeader' => 'Manage Clinic Affiliations', 
                'formAction' => 'storeClinic', 
                'viewFolder' => $this->viewFolder, 
                'action'=> 'manageClinic', 
                'selectItems' => $this->selectItems(),
                'user' => $user,
                'yr' => $yr, 
                'mon' => $mon, 
                'dayNum' => $dayNum, 
                'modalSize' => $this->modalSize, 
                'modal' => true
            ]);
    }

    public function storeClinic(Request $request)
    {
        $user = Auth::user();
        AffiliatedDoctor::where('doctor_id', $user->id)->delete();
        if(!empty($request->input($this->viewFolder)['clinic_id'])){
            foreach($request->input($this->viewFolder)['clinic_id'] as $clinic_id){
                unset($params);
                $params['clinic_id'] = $clinic_id;
                $params['doctor_id'] = $user->id;
                $params['active'] = 2;
                $params['created_by'] = $user->id;
                $params['updated_by'] = $user->id;
                AffiliatedDoctor::create($params);
            }
        }
        

        return redirect()->route($this->viewFolder . '.index')->with('message', 'Affiliated clinic updated.');
    }

    public function updateMyAccount(User $doctors_home, Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        $params['updated_by'] = $user->id;
        if($params['passwordOld'] != ''){
            if (Hash::check($params['passwordOld'], $user->getAuthPassword())) {
                $params['password'] = Hash::make($params['passwordNew']);
                // dd($params);
                $user->update($params);
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
            }else{
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Invalid old password.');
            }
        }else{
            $params['name'] = $params['f_name'] . ' ' . $params['m_name'] . ' ' . $params['l_name'];
            $user->update($params);
            return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
        }
        
        
    }

    public function edit(Consultation $doctors_home, Request $request)
    {
        $data = $this->getData($request->input());
        $user = Auth::user();
        $datum = $doctors_home;
        $yr = null;
        $mon = null;
        $dayNum = null;
        $patients = $user->patients->sortBy('name');
        return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'data' => $data, 
                'datum' => $datum, 
                'inputFormHeader' => ($datum->booking_type == '' ? 'Consultation' : $datum->booking_type) . ' Booking', 
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
                'modal' => true,
                'dateBooking' => $datum->bookingDate,
                'patients'=>$patients, 
                'viewFolder' => $this->viewFolder, 
                'modalSize' => 'modal-fullscreen'
            ]);
    }

    public function update(Request $request, Consultation $doctors_home)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        
        if(isset($params['referral_id'])){
            $consultationObj = Consultation::find($params['referral_id']);
            
            unset($paramsRef);
            if(isset($params['docNotesHPI']))
                $paramsRef['docNotesHPI'] = $params['docNotesHPI'];
            if(isset($params['docNotesSubject']))
                $paramsRef['docNotesSubject'] = $params['docNotesSubject'];
            unset($params['docNotesSubject']);
            $paramsRef['docNotes'] = $params['docNotes'];
            unset($params['docNotes']);
            $paramsRef['icd_code'] = $params['icd_code'];
            unset($params['icd_code']);
            $paramsRef['assessment'] = $params['assessment'];
            unset($params['assessment']);
            $paramsRef['planMed'] = $params['planMed'];
            unset($params['planMed']);
            $paramsRef['plan'] = $params['plan'];
            unset($params['plan']);
            $paramsRef['planRem'] = $params['planRem'];
            unset($params['planRem']);
            $consultationObj->update($paramsRef);
            if(!empty($request->doctors_home['ConsultationFile']['files'])){
                foreach($request->doctors_home['ConsultationFile']['files'] as $ind => $file){
                    unset($parFile);
                    $file_name = $doctors_home->id . '_consultation_' . date('ymdhis') . $ind . '.' . $file->extension();
                    $file->storeAs('public/consultation_files', $file_name);
                    $parFile['consultation_id'] = $doctors_home->consultation_parent_id;
                    $parFile['file_link'] = 'storage/consultation_files/' . $file_name;
                    $parFile['file_type'] = $file->getMimeType();
                    $parFile['created_by'] = $user->id;
                    $parFile['updated_by'] = $user->id;
                    ConsultationFile::create($parFile);
                }
            }
        }else{
            if(!empty($request->doctors_home['ConsultationFile']['files'])){
                foreach($request->doctors_home['ConsultationFile']['files'] as $ind => $file){
                    unset($parFile);
                    $file_name = $doctors_home->id . '_consultation_' . date('ymdhis') . $ind . '.' . $file->extension();
                    $file->storeAs('public/consultation_files', $file_name);
                    $parFile['consultation_id'] = $doctors_home->id;
                    $parFile['file_link'] = 'storage/consultation_files/' . $file_name;
                    $parFile['file_type'] = $file->getMimeType();
                    $parFile['created_by'] = $user->id;
                    $parFile['updated_by'] = $user->id;
                    ConsultationFile::create($parFile);
                }
            }
            if(isset($params['Doctor'])){
                $doctor = $params['Doctor'];
                unset($params['Doctor']);
                if($params['submit_type'] == "" && !isset($params['referral_id']))
                    $params['status'] = "Done";
            
                $doctor['updated_by'] = $user->id;
                $doctors_home->doctor->update($doctor);
            }
            unset($params['referral_id']);
            $params['updated_by'] = $user->id;
            $doctors_home->update($params);
        }
        
        
        
        
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been updated.');
    }

    public function destroy($id)
    {
        Consultation::destroy($id);
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
        return redirect()->back()->with('message', 'Entry has been deleted.');
    }

    private function getData($search_query = null)
    {
        $condition = $this->queryBuilder('schedule_consos', !empty($search_query['schedule_consos']) ? $search_query['schedule_consos'] : '');
        $data = ScheduleConso::where($condition)
            ->sortable(['date_from' => 'asc'])
            ->paginate($this->page);
        return $data;
        
    }

    function getPrevBookingInfo(Consultation $doctors_home, int $index){
        $user = Auth::user();
        $prevBookingInfo = $doctors_home->patient->consultations()->where('doctor_id', $user->id)->where('id', '<', $doctors_home->id)->orderByDesc('bookingDate')->get();
        $prevBookingArr['consultation'] = $prevBookingInfo[$index];
        $prevBookingArr['consultation']['iframePrevPrescSrc'] = file_exists(public_path('storage/prescription_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        $prevBookingArr['consultation']['iframePrevMedCertSrc'] = file_exists(public_path('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        $prevBookingArr['consultation']['iframePrevAdmittingSrc'] = file_exists(public_path('storage/admitting_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        $prevBookingArr['patient'] = $prevBookingInfo[$index]->patient;
        foreach($prevBookingInfo[$index]->consultation_files as $ind=>$consultation_file){
            $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
        }
        
        
        return json_encode($prevBookingArr);
    }

    function pdfPrescription(Consultation $doctors_home){
        $pdf = Pdf::loadView($this->viewFolder . '.pdfPrescription', ['datum' => $doctors_home])->setOptions(['defaultFont' => 'sans-serif']);
        Storage::put('public/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'E-Prescription PDF is created.');
    }

    function pdfMedCert(Consultation $doctors_home){
        $pdf = Pdf::loadView($this->viewFolder . '.pdfMedCert', ['datum' => $doctors_home])->setOptions(['defaultFont' => 'sans-serif']);
        Storage::put('public/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Med Cert PDF is created.');
    }

    function pdfAdmitting(Consultation $doctors_home){
        $pdf = Pdf::loadView($this->viewFolder . '.pdfAdmitting', ['datum' => $doctors_home])->setOptions(['defaultFont' => 'sans-serif']);
        Storage::put('public/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Admitting Order PDF is created.');
    }

    private function queryBuilder($model, $search_query){
        $condition[] = [$model . '.active', 1];
        if($model == 'users')
            $condition[] = [$model . '.user_type', 'Internal'];
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
        $user = Auth::user();
        $selectItems['affiliated_clinics'] = $user->affiliated_clinics;
        $selectItems['clinics'] = Clinic::orderBy('name', 'asc')->get();
        return $selectItems;
    }

    
}
