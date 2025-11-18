<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AffiliatedDoctor;
use App\Models\Clinic;
use App\Models\Consultation;
use App\Models\ConsultationFile;
use App\Models\ConsultationMed;
use App\Models\ConsultationMonitoring;
use App\Models\ConsultationNurseNote;
use App\Models\HealthOrganization;
use App\Models\NurseFile;
use App\Models\Opdpatient;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use PSpell\Config;

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
    public function index(Request $request, ?int $yr = null, ?int $mon = null, ?int $dayNum = null, ?string $booking_type = null, ?string $specialty = null, ?int $doctor_id = null)
    {
        // print_r(urldecode(explode('?', $request->fullUrl())[1]));
        // exit();

        $urlQuery = null;
        if(stristr($request->fullUrl(), '?')){
            // print "pumasok";
            $urlQuery = urldecode(explode('?', $request->fullUrl())[1]);
        }
            

        // print "<pre>";
        // print_r($request->fullUrl());
        // print "</pre>";
        // exit();

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
        $affDocArr = AffiliatedDoctor::where('clinic_id', $user->clinic_id)->distinct()->get('doctor_id');
        unset($doctorArr);
        // foreach($user->clinic->affiliated_doctors()->get('doctor_id') as $docObj){
        foreach($affDocArr  as $docObj){
            if(!is_null($docObj->doctor_id)){
                // $docRes = User::find($docObj->doctor_id);
                // if(isset($docRes)){
                //     foreach($docRes->schedules()->where('dateSched', $yr . '-' . $mon . '-' . $dayNum)->get('doctor_id') as $doc){
                //         $doctorArr[$doc->doctor_id] = $doc->doctor_id;
                //     }
                // }
                foreach(Schedule::where('dateSched', $yr . '-' . $mon . '-' . $dayNum)->where('doctor_id', $docObj->doctor_id)->distinct()->get('doctor_id') as $doc){
                    $doctorArr[$doc->doctor_id] = $doc->doctor_id;
                }
            }
            
        }
        unset($doctorArrMon);
        // foreach($user->clinic->affiliated_doctors()->get('doctor_id') as $docObj){
         foreach($affDocArr  as $docObj){
            if(!is_null($docObj->doctor_id)){
                // $docRes = User::find($docObj->doctor_id);
                // if(isset($docRes)){
                //     foreach($docRes->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get('doctor_id') as $doc){
                //         $doctorArrMon[$doc->doctor_id] = $doc->doctor_id;
                //     }
                // }
                foreach(Schedule::whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->where('doctor_id', $docObj->doctor_id)->distinct()->get('doctor_id') as $doc){
                    $doctorArrMon[$doc->doctor_id] = $doc->doctor_id;
                }
            }
        }
        $schedules = null;
        $schedulesMon = null;
        
        if(isset($doctor_id)){
            if(isset($doctorArr)){
                $schedules = User::whereIn('id', $doctorArr)->where('id', $doctor_id);
                if(!empty($schedules->get()[0]->specialty))
                    $specialty = $schedules->get()[0]->specialty;
            }
            if(isset($doctorArrMon))
                $schedulesMon = User::whereIn('id', $doctorArrMon)->where('id', $doctor_id)->count();
        }elseif(isset($specialty)){
            if(isset($doctorArr))
                $schedules = User::whereIn('id', $doctorArr)->where('specialty', $specialty);
            if(isset($doctorArrMon))
                $schedulesMon = User::whereIn('id', $doctorArrMon)->where('specialty', $specialty)->count();
        }else{
            if(isset($doctorArr))
                $schedules = User::whereIn('id', $doctorArr);
            if(isset($doctorArrMon))
                $schedulesMon = User::whereIn('id', $doctorArrMon)->count();
        }
        // if(!is_null($schedulesMon))
        //     $doctor_list_id = $schedulesMon->get('id');
        
        
        $patientArr = null;
        if(isset($request->input()['clinics_home']['Patient']['name']) && $request->input()['clinics_home']['Patient']['name'] != ''){
            $patientRes = Patient::where('name', 'like', "%{$request->input()['clinics_home']['Patient']['name']}%")->get();
            foreach($patientRes as $patArr){
                $patientArr[$patArr->id] = $patArr->id;
            }
        }

        $doctorArr = null;
        if(isset($request->input()['clinics_home']['Doctor']['name']) && $request->input()['clinics_home']['Doctor']['name'] != ''){
            $doctorRes = User::where('name', 'like', "%{$request->input()['clinics_home']['Doctor']['name']}%")->get();
            foreach($doctorRes as $docArr){
                $doctorArr[$docArr->id] = $docArr->id;
            }
        }


        if(!is_null($patientArr) && !is_null($doctorArr)){
            // $bookings = $user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
            $bookings = Consultation::where('clinic_id', $user->clinic_id)->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get('booking_type');
        }elseif(!is_null($patientArr)){
            // $bookings = $user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get();
            $bookings = Consultation::where('clinic_id', $user->clinic_id)->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get('booking_type');
        }elseif(!is_null($doctorArr)){
            // $bookings = $user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get();
            $bookings = Consultation::where('clinic_id', $user->clinic_id)->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get('booking_type');
        }else{
            // $bookings = $user->clinic->bookings()->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
            $bookings = Consultation::where('clinic_id', $user->clinic_id)->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get('booking_type');
        }

        $booking_type_arr = array('Diagnostics' => 0, 'Dialysis' => 0, 'Surgery' => 0, 'Laser' => 0, 'Laboratory' => 0, 'Referral' => 0, 'Consultation' => 0);
        foreach($bookings as $in=>$booking){
            if($booking->consultation_parent_id != ""){
                $booking_type_arr['Referral'] += 1;
            }elseif($booking->booking_type == ''){
                $booking_type_arr['Consultation'] += 1;
            }else{
                $booking_type_arr[$booking->booking_type] += 1;
            }
        }
        foreach($booking_type_arr as $booking_type_temp => $count){
            if($count == 0)
                unset($booking_type_arr[$booking_type_temp]);
        }
        
        if(isset($booking_type_arr))
            ksort($booking_type_arr);
        if((!isset($booking_type) || $booking_type == 'NULL') && isset($booking_type_arr)){
            foreach($booking_type_arr as $booking_type => $count){
                if($count > 0)
                    break;
            }
            
        }elseif((!isset($booking_type) || $booking_type == 'NULL' || $booking_type == '') && !isset($booking_type_arr)){
            
            $booking_type = 'Consultation';
        }
            
        
        
        if(sizeof($booking_type_arr) == 0){
            $booking_type_arr = null;
            $booking_type = 'Consultation';
        }

        
        
        
        $calendarArr = null;
        if(!is_null($schedulesMon)){
            // foreach($user->clinic->affiliated_doctors()->get() as $docObj){
            foreach($affDocArr as $docObj){
                // $docRes = User::find($docObj->doctor_id);
                // if(isset($docRes)){
                //     foreach($docRes->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get() as $sched){
                //         if(!isset($calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id]))
                //             $calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id] = 1;
                //         else
                //             $calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id] += 1;
                //     }    
                // }
                if(!is_null($docObj->doctor_id)){
                    foreach(Schedule::whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->where('doctor_id', $docObj->doctor_id)->get('doctor_id') as $sched){
                        if(!isset($calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id]))
                            $calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id] = 1;
                        else
                            $calendarArr[date('d', strtotime($sched->dateSched))][$sched->doctor_id] += 1;
                    }
                }
            }
        }

        if(!is_null($patientArr) && !is_null($doctorArr)){
            // $bookingsMon = $user->clinic->bookings()->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
            $bookingsMon = Consultation::where('clinic_id', $user->clinic_id)->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get('bookingDate');
        }elseif(!is_null($patientArr)){
            // $bookingsMon = $user->clinic->bookings()->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('patient_id', $patientArr)->get();
            $bookingsMon = Consultation::where('clinic_id', $user->clinic_id)->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('patient_id', $patientArr)->get('bookingDate');
        }elseif(!is_null($doctorArr)){
            // $bookingsMon = $user->clinic->bookings()->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('doctor_id', $doctorArr)->get();
            $bookingsMon = Consultation::where('clinic_id', $user->clinic_id)->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->whereIn('doctor_id', $doctorArr)->get('bookingDate');
        }else{
            // $bookingsMon = $user->clinic->bookings()->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->get();
            $bookingsMon = Consultation::where('clinic_id', $user->clinic_id)->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->get('bookingDate');
        }
        // print "<pre>";
        // print_r($bookingsMon);
        // print "</pre>";
        
        $bookingArr = null;
        foreach($bookingsMon as $booking){
            if(!isset($bookingArr[date('d', strtotime($booking->bookingDate))]))
                $bookingArr[date('d', strtotime($booking->bookingDate))] = 1;
            else
                $bookingArr[date('d', strtotime($booking->bookingDate))] += 1;
        }
        unset($bookingArrList);
        if(!empty($booking_type) && $booking_type == 'Referral'){
            if(!is_null($patientArr) && !is_null($doctorArr))
                $bookingArrList = Consultation::whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
            elseif(!is_null($patientArr))
                $bookingArrList = Consultation::whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get();
            elseif(!is_null($doctorArr))
                $bookingArrList = Consultation::whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get();
            else
                $bookingArrList = Consultation::whereNotNull('consultation_parent_id', )->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
        }else{
            if(!is_null($patientArr) && !is_null($doctorArr))
                $bookingArrList = Consultation::where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->whereIn('doctor_id', $doctorArr)->get();
            elseif(!is_null($patientArr))
                $bookingArrList = Consultation::where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('patient_id', $patientArr)->get();
            elseif(!is_null($doctorArr))
                $bookingArrList = Consultation::where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->whereIn('doctor_id', $doctorArr)->get();
            else
                $bookingArrList = Consultation::where('booking_type', $booking_type == 'Consultation' ? '' : $booking_type)->whereNull('consultation_parent_id')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get();
        }
        

        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
            return view($this->viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'viewFolder' => $this->viewFolder, 
                'selectItems' => $this->selectItems(),
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
                'bookingArr'=>$bookingArr,
                'bookingArrList'=>$bookingArrList,
                'calendarArr'=>$calendarArr,
                'user' => $user,
                'inputFormHeader' => 'Booking',
                'patientArr' => $patientArr,
                'doctorArr' => $doctorArr,
                'urlQuery' => $urlQuery
            ]);
        }
    }

    public function manageDoctor(Clinic $clinics_home, Request $request)
    {
        $user = Auth::user();
        
        $yr = null;
        $mon = null;
        $dayNum = null;
        $datum =  (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
            return view($this->viewFolder . '.index', [
                    'moduleList' => $this->moduleList(), 
                    'moduleActive' => $this->module, 
                    'datum' => $datum, 
                    'inputFormHeader' => 'Manage Affiliated Doctors', 
                    'formAction' => 'storeDoctor', 
                    'viewFolder' => $this->viewFolder, 
                    'action'=> 'manageDoctor', 
                    'selectItems' => $this->selectItems(),
                    'user' => $user,
                    'yr' => $yr, 
                    'mon' => $mon, 
                    'dayNum' => $dayNum, 
                    'modalSize' => $this->modalSize, 
                    'modal' => true,
                    'booking_type' => null,
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
        }
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
        $referer = $request->input($this->viewFolder)['referer'];
        return redirect()->to($referer)->with('message', "Approved doctor's affiliation request.");
        // return redirect()->route($this->viewFolder . '.index')->with('message', "Approved doctor's affiliation request.");
        // return redirect()->back()->with('message', "Approved doctor's affiliation request.");
    }

    public function book(Request $request)
    {
        // dd($request);

        $user = Auth::user();
        
        $yr = null;
        $mon = null;
        $dayNum = null;
        $datum =  (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        $cityZip = file(storage_path('app/public/cityZip.csv', FILE_IGNORE_NEW_LINES));
        $cityZip = array_map('trim', $cityZip);
        $provinceZip = file(storage_path('app/public/provinceZip.csv', FILE_IGNORE_NEW_LINES));
        $provinceZip = array_map('trim', $provinceZip);
        $doctor =  User::find($request->input($this->viewFolder)['doctor_id']);
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
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
                    'booking_type' => null,
                    'cityZip' => $cityZip,
                    'provinceZip' => $provinceZip,
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
        }
    }

    public function storeBook(Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        $patient = $params['Patient'];
        $referer = $params['referer'];
        unset($params['referer']);
        $existing = Consultation::where('bookingDate', $params['bookingDate'])
                    ->where('doctor_id', $params['doctor_id'])
                    ->where('booking_type', $params['booking_type'])
                    ->where('patient_id', $params['patient_id'])->get();
        // if(isset($existing[0]->id) || !isset($params['patient_id'])){
        if(true){
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
            // dd($params);
            if($params['patient_id'] != ''){
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
            return redirect()->to($referer)->with('message', "Booking successfully saved.");
            // return redirect()->route($this->viewFolder . '.index')->with('message', "Booking successfully saved.");
            // return redirect()->back()->with('message', "Booking successfully saved.");
        }else{
            return redirect()->to($referer)->with('message', "Cannot book with existing booking type, patient, doctor and date.");
        }
        
        
    }

    public function updateMyAccount(User $clinics_home, Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        // dd($params);
        
        $userInputedDetails = $params['user'];
        if(!empty($request->clinics_home['prc_pic'])){
            $prc_pic = 'prc_pic_' . time() . '.' . $request->clinics_home['prc_pic']->extension();
            $request->clinics_home['prc_pic']->storeAs('public/doctor_files', $prc_pic);
            $userInputedDetails['prc_pic'] = $prc_pic;
            unset($params['prc_pic']);
        }
        
        if(!empty($request->clinics_home['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->clinics_home['profile_pic']->extension();
            $request->clinics_home['profile_pic']->storeAs('public/doctor_files', $profile_pic);
            $userInputedDetails['profile_pic'] = $profile_pic;
            unset($params['profile_pic']);
        }

        if(!empty($request->clinics_home['sig_pic'])){
            $sig_pic = 'sig_pic' . time() . '.' . $request->clinics_home['sig_pic']->extension();
            $request->clinics_home['sig_pic']->storeAs('public/doctor_files', $sig_pic);
            $userInputedDetails['sig_pic'] = $sig_pic;
            unset($params['sig_pic']);
        }
        unset($params['user']);
        $referer = $params['referer'];
        unset($params['referer']);
        $params['updated_by'] = $user->id;
        if($userInputedDetails['passwordOld'] != ''){
            if (Hash::check($userInputedDetails['passwordOld'], $user->getAuthPassword())) {
                $userInputedDetails['password'] = Hash::make($userInputedDetails['passwordNew']);
                // dd($params);
                if($user->active == 2)
                    $userInputedDetails['active'] = 1;
                $userInputedDetails['name'] = $userInputedDetails['f_name'] . ' ' . $userInputedDetails['m_name'] . ' ' . $userInputedDetails['l_name'];
                $user->update($userInputedDetails);
                $clinics_home->clinic->update($params);
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
                // return redirect()->back()->with('message', 'Your account is updated.');
            }else{
                return redirect()->route($this->viewFolder . '.index')->with('message', 'Invalid old password.');
                // return redirect()->back()->with('message', 'Invalid old password.');
            }
        }else{
            $clinics_home->clinic->update($params);
            $userInputedDetails['name'] = $userInputedDetails['f_name'] . ' ' . $userInputedDetails['m_name'] . ' ' . $userInputedDetails['l_name'];
            $user->update($userInputedDetails);
            return redirect()->to($referer)->with('message', 'Your account is updated.');
            // return redirect()->route($this->viewFolder . '.index')->with('message', 'Your account is updated.');
            // return redirect()->back()->with('message', 'Your account is updated.');
        }
        
        
    }

    public function show(Consultation $clinics_home, Request $request)
    {
        // dd($clinics_home);
        $user = Auth::user();
        $datum = $clinics_home;
        $yr = null;
        $mon = null;
        $dayNum = null;
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
            return view($this->viewFolder . '.index', [
                    'moduleList' => $this->moduleList(), 
                    'moduleActive' => $this->module, 
                    // 'data' => $data, 
                    'datum' => $datum, 
                    'inputFormHeader' => 'View Booking', 
                    'formId' => 'bookMod',
                    'formAction' => 'update', 
                    'viewFolder' => $this->viewFolder, 
                    'action'=> 'book', 
                    'selectItems' => $this->selectItems(),
                    // 'user' => $user,
                    'doctor' => $datum->doctor,
                    'yr' => $yr, 
                    'mon' => $mon, 
                    'dayNum' => $dayNum, 
                    'modalSize' => 'modal-xl', 
                    'modal' => true,
                    'dateBooking' => $datum->bookingDate,
                    'viewFolder' => $this->viewFolder, 
                    'modalSize' => 'modal-xl',
                    // 'users' => $user,
                    'booking_type' => $datum->booking_type,
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
        }
    }

    public function edit(Consultation $clinics_home, Request $request)
    {
        // $data = $this->getData($request->input());
        $user = Auth::user();
        $datum = $clinics_home;
        $yr = null;
        $mon = null;
        $dayNum = null;
        $prevBooking = null;
        $allBooking = null;
        if($datum->booking_type == 'Dialysis'){
            $prevBooking = Consultation::where('patient_id', $datum->patient_id)->where('booking_type', 'Dialysis')->whereNotNull('time_ended')->whereNot('id', $datum->id)->orderBy('bookingDate','desc')->first();
            $allBooking = Consultation::where('patient_id', $datum->patient_id)->where('booking_type', 'Dialysis')->whereNotNull('time_ended')->whereNot('id', $datum->id)->where('bookingDate', '<', $datum->bookingDate)->orderBy('bookingDate','asc')->get();
        }
        $cityZip = file(storage_path('app/public/cityZip.csv', FILE_IGNORE_NEW_LINES));
        $cityZip = array_map('trim', $cityZip);
        $provinceZip = file(storage_path('app/public/provinceZip.csv', FILE_IGNORE_NEW_LINES));
        $provinceZip = array_map('trim', $provinceZip);
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
            return view($this->viewFolder . '.index', [
                    'moduleList' => $this->moduleList(), 
                    'moduleActive' => $this->module, 
                    // 'data' => $data, 
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
                    'viewFolder' => $this->viewFolder, 
                    'modalSize' => 'modal-xl',
                    'booking_type' => $datum->booking_type,
                    'prevBooking' => $prevBooking,
                    'allBooking' => $allBooking,
                    'cityZip' => $cityZip,
                    'provinceZip' => $provinceZip,
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
        }
    }

    public function update(Request $request, Consultation $clinics_home)
    {
        // dd($clinics_home);
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        // dd($params);
        if(isset($params['referal'])){
            $referralEntry = $params['referal'];
            unset($params['referal']);
        }
        $referer = $params['referer'];
        unset($params['referer']);

        if(isset($params['referral_id']) && isset($params['procedure_details'])){
            Consultation::find($params['referral_id'])->update(['procedure_details' => $params['procedure_details']]);
            unset($params['referral_id']);
            unset($params['procedure_details']);
        }

        if(isset($params['Med'])){
            $medication = $params['Med'];
            unset($params['Med']);
            if($medication['time_given'] != ''){
                $medication['consultation_id'] = $clinics_home->id;
                $medication['created_by'] = $user->id;
                $medication['updated_by'] = $user->id;
                // dd($medication);
                if($medication['id'] != "")
                    ConsultationMed::where('id', $medication['id'])->update($medication);
                else
                    ConsultationMed::create($medication);
                
            }
        }
        
        if(isset($params['Monitoring'])){
            $monitoring = $params['Monitoring'];
            unset($params['Monitoring']);
            if($monitoring['time_given'] != ''){
                $monitoring['consultation_id'] = $clinics_home->id;
                $monitoring['created_by'] = $user->id;
                $monitoring['updated_by'] = $user->id;
                // dd($medication);
                if($monitoring['id'] != "")
                    ConsultationMonitoring::where('id', $monitoring['id'])->update($monitoring);
                else
                    ConsultationMonitoring::create($monitoring);
                
            }
        }

        if(isset($params['Nurse'])){
            $nurse_notes = $params['Nurse'];
            unset($params['Nurse']);
            if($nurse_notes['time_given'] != ''){
                $nurse_notes['consultation_id'] = $clinics_home->id;
                $nurse_notes['created_by'] = $user->id;
                $nurse_notes['updated_by'] = $user->id;
                // dd($nurse_notes);
                if($nurse_notes['id'] != "")
                    ConsultationNurseNote::where('id', $nurse_notes['id'])->update($nurse_notes);
                else
                    ConsultationNurseNote::create($nurse_notes);
                
            }
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
                $parFile['created_by'] = $user->id;
                $parFile['updated_by'] = $user->id;
                ConsultationFile::create($parFile);
            }
        }
        if(!empty($request->clinics_home['NurseFile']['files'])){
            foreach($request->clinics_home['NurseFile']['files'] as $ind => $file){
                unset($parFile);
                $file_name = $clinics_home->id . '_consultation_' . date('ymdhis') . $ind . '.' . $file->extension();
                $file->storeAs('public/nurse_files', $file_name);
                $parFile['consultation_id'] = $clinics_home->id;
                $parFile['file_link'] = 'storage/nurse_files/' . $file_name;
                $parFile['file_type'] = $file->getMimeType();
                $parFile['created_by'] = $user->id;
                $parFile['updated_by'] = $user->id;
                NurseFile::create($parFile);
            }
        }
        unset($params['Patient']);
        // $patient['client_id'] = $user->id;
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
        // dd($params);
        if(!isset($params['booking_type']))
            $params['booking_type'] = '';
        if(isset($params['arod_sphere']) && $params['arod_sphere'] == 'No Target'){
            $params['arod_cylinder'] = null;
            $params['arod_axis'] = null;
        }
        if(isset($params['aros_sphere']) && $params['aros_sphere'] == 'No Target'){
            $params['aros_cylinder'] = null;
            $params['aros_axis'] = null;
        }
        if(isset($params['vaod_num']) && $params['vaod_num'] == 'NA'){
            $params['vaod_den'] = null;
        }
        if(isset($params['vaodcor_num']) && $params['vaodcor_num'] == 'NA'){
            $params['vaodcor_den'] = null;
        }
        if(isset($params['vaos_num']) && $params['vaos_num'] == 'NA'){
            $params['vaos_den'] = null;
        }
        if(isset($params['vaoscor_num']) && $params['vaoscor_num'] == 'NA'){
            $params['vaoscor_den'] = null;
        }
        if(isset($params['pinod_num']) && $params['pinod_num'] == 'NA'){
            $params['pinod_den'] = null;
        }
        if(isset($params['pinodcor_num']) && $params['pinodcor_num'] == 'NA'){
            $params['pinodcor_den'] = null;
        }
        if(isset($params['pinos_num']) && $params['pinos_num'] == 'NA'){
            $params['pinos_den'] = null;
        }
        if(isset($params['pinoscor_num']) && $params['pinoscor_num'] == 'NA'){
            $params['pinoscor_den'] = null;
        }

        if(isset($params['mental_status']))
            $params['mental_status'] = json_encode($params['mental_status']);
        else
            $params['mental_status'] = json_encode('');
        if(isset($params['ambulation_status_j']))
            $params['ambulation_status_j'] = json_encode($params['ambulation_status_j']);
        else
            $params['ambulation_status_j'] = json_encode('');
        if(isset($params['pe_findings']))
            $params['pe_findings'] = json_encode($params['pe_findings']);
        else
            $params['pe_findings'] = json_encode('');
        if(isset($params['post_mental_status']))
            $params['post_mental_status'] = json_encode($params['post_mental_status']);
        else
            $params['post_mental_status'] = json_encode('');
        if(isset($params['post_ambulation_status_j']))
            $params['post_ambulation_status_j'] = json_encode($params['post_ambulation_status_j']);
        else
            $params['post_ambulation_status_j'] = json_encode('');
        if(isset($params['post_pe_findings']))
            $params['post_pe_findings'] = json_encode($params['post_pe_findings']);
        else
            $params['post_pe_findings'] = json_encode('');
        if(isset($params['vaccess_j']))
            $params['vaccess_j'] = json_encode($params['vaccess_j']);
        else
            $params['vaccess_j'] = json_encode('');
        if(isset($params['vaccess_detail']))
            $params['vaccess_detail'] = json_encode($params['vaccess_detail']);
        else
            $params['vaccess_detail'] = json_encode('');
        if(isset($params['av_fistula_detail']))
            $params['av_fistula_detail'] = json_encode($params['av_fistula_detail']);
        else
            $params['av_fistula_detail'] = json_encode('');
        if(isset($params['hd_catheter_detail']))
            $params['hd_catheter_detail'] = json_encode($params['hd_catheter_detail']);
        else
            $params['hd_catheter_detail'] = json_encode('');

        if(isset($params['time_started']) && $clinics_home->time_started == '' && $params['time_started'] != ''){
            $params['hd_started_by'] = $user->id;
        }

        if(isset($params['time_started']) && $clinics_home->time_ended == '' && $params['time_ended'] != ''){
            $params['hd_terminated_by'] = $user->id;
        }
        
        $params['patient_id'] = $clinics_home->patient->id;
        $params['doctor_id'] = $clinics_home->doctor->id;
        $params['client_id'] = $user->id;
        $params['updated_by'] = $user->id;
        if(is_null($clinics_home->vitals_updated_by) && is_null($clinics_home->temp) && $params['temp'] != '')
            $params['vitals_updated_by'] = $user->id;
        // print "<pre>";
        // print_r($params);
        // print "</pre>";
        // exit();
        
        $clinics_home->update($params);

        if(isset($referralEntry)){
            $referalExp = explode(',', $referralEntry);
            unset($params['referal']);
            unset($referralIDArr);
            foreach($referalExp as $refDet){
                $refDetExp = explode(" | ", $refDet);
                $consoDet = explode(" - ", $refDetExp[0]);
                $clinicExp = explode(" - ", $refDetExp[1]);
                $doctorExp = explode(" - ", $refDetExp[2]);
                
                $doctorObj = User::find($doctorExp[0]);
                
                $consultationReferralObj = $clinics_home->consultation_referals()
                            ->where('bookingDate', $consoDet[1])
                            ->where('clinic_id', $clinicExp[0])
                            ->where('doctor_id', $doctorExp[0])
                            ->get();
                
                // print "<pre>";
                // print_r($consultationReferralObj[0]->id);
                // print "</pre>";
                // exit();
                if(!isset($consultationReferralObj[0]->id)){
                    
                    $bookingReplication = $clinics_home->replicate();
                    $bookingReplication['booking_type'] = $consoDet[0];
                    if($consoDet[0] == 'Consultation')
                        $bookingReplication['booking_type'] = '';
                    $bookingReplication['bookingDate'] = $consoDet[1];
                    $bookingReplication['clinic_id'] = $clinicExp[0];
                    $bookingReplication['doctor_id'] = $doctorExp[0];
                    $bookingReplication['consultation_parent_id'] = $clinics_home->id;
                    $bookingReplication['fee'] = $doctorObj->fee;
                    $bookingReplication['created_by'] = $user->id;
                    $bookingReplication['updated_by'] = $user->id;
                    // print "<pre>";
                    // print_r($bookingReplication);
                    // print "</pre>";
                    // exit();
                    $bookingReplication->save();
                    $referralIDArr[$bookingReplication->id] = $bookingReplication->id;
                }else{
                    $referralIDArr[$consultationReferralObj[0]->id] = $consultationReferralObj[0]->id;
                    if(is_null($params['booking_type']))
                        $params['booking_type'] = '';
                    $params['bookingDate'] = $refDetExp[0];
                    $params['clinic_id'] = $clinicExp[0];
                    $params['doctor_id'] = $doctorExp[0];
                    $params['fee'] = $doctorObj->fee;
                    $params['updated_by'] = $user->id;
                    $consultationReferralObj[0]->update($params);
                }
                
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
            $clinics_home->consultation_referals()->whereNotIn('id', $referralIDArr)->delete();
        }
        
        return redirect()->to($referer)->with('message', 'Entry has been updated.');
        
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been updated.');
        // return redirect()->back()->with('message', 'Entry has been updated.');
    }

    public function destroy($id)
    {
        Consultation::destroy($id);
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
        return redirect()->back()->with('message', 'Entry has been deleted.');
    }

    function getPatientInfo(?int $patient_id){
        $patient = Patient::find($patient_id);
        return json_encode($patient);
    }

    function deleteUploadedFile(?int $id){
        ConsultationFile::destroy($id);
    }

    function deleteUploadedNurseFile(?int $id){
        NurseFile::destroy($id);
    }

    function deleteHDLogs($log_type, ?int $id){
        if($log_type == 'meds')
            ConsultationMed::destroy($id);
        elseif($log_type == 'moni')
            ConsultationMed::destroy($id);
        else    
            ConsultationNurseNote::destroy($id);
    }

    function getHDLogs($log_type, ?int $id){
        unset($HDLogs);
        if($log_type == 'meds'){
            $HDLogs = ConsultationMed::find($id);
            $HDLogs->type = 'meds';
        }elseif($log_type == 'moni'){
            $HDLogs = ConsultationMonitoring::find($id);
            $HDLogs->type = 'moni';
        }else{    
            $HDLogs = ConsultationNurseNote::find($id);
        }
        return json_encode($HDLogs);
    }

    function getPatientList($patient_name, $conso = null){
        $user = Auth::user();
        if($user->user_type == 'Clinic' && is_null($conso)){
            $patients = Patient::where('name', 'like', "%{$patient_name}%")->where('client_id', $user->id)->orderBy('name')->get();
            foreach($patients as $ind => $pat){
                $patients[$ind]->consoCount = Consultation::where('clinic_id', $user->clinic_id)->where('patient_id', $pat->id)->count();
                
                
            }
        }elseif($user->user_type == 'Clinic'){
            unset($patientsId);
            // foreach($user->clinic->bookings()->distinct('patient_id')->get() as $booking){
            foreach(Consultation::where('clinic_id', $user->clinic_id)->get('patient_id') as $booking){
                if($booking->patient_id != ''){
                    $patientsId[$booking->patient_id] = $booking->patient_id;
                    if(!isset($consoCount[$booking->patient_id]))
                        $consoCount[$booking->patient_id] = 1;
                    else
                        $consoCount[$booking->patient_id]++;
                }
            }
            $patients = Patient::where('name', 'like', "%{$patient_name}%")->whereIn('id', $patientsId)->orderBy('name')->distinct()->get('name');
        }elseif($user->user_type == 'Doctor'){
            unset($patientsId);
            foreach(Consultation::where('doctor_id', $user->id)->get() as $booking){
                if($booking->patient_id != '')
                    $patientsId[$booking->patient_id] = $booking->patient_id;
            }
            $patients = Patient::where('name', 'like', "%{$patient_name}%")->whereIn('id', $patientsId)->orderBy('name')->distinct()->get('name');
        }else{
            $patients = Patient::where('name', 'like', "%{$patient_name}%")->orderBy('name')->distinct()->get('name');
        }
        return json_encode($patients);
    }

    

    function getReferralList($bookingDate, $doctor_id, $booking_type){
        $user = Auth::user();
        $affiliatedDoctorObj = AffiliatedDoctor::where('clinic_id', $user->clinic_id)->get();
        // print "<pre>";
        // print_r($affiliatedDoctorObj[0]->doctor->affiliated_clinics[0]->clinic->name);
        // print "</pre>";
        $cnt = 0;
        unset($affDocArr);
        foreach($affiliatedDoctorObj as $doc){
            $affDocArr[$doc->doctor_id] = $doc->doctor_id;
        }
        $docObj = User::whereIn('id', $affDocArr)->where('name', 'like', "%{$_GET['keyword']}%")->get();
        foreach($docObj as $doc){
            if(isset($doc->affiliated_clinics)){
                foreach($doc->affiliated_clinics->sortBy('name') as $clin){
                    foreach($doc->schedules()->whereBetween('dateSched', [$bookingDate, date('Y-m-d', strtotime($bookingDate . ' + 30 days'))])->orderBy('dateSched', 'asc')->distinct()->get('dateSched') as $sched){
                        // if($sched->dateSched == $bookingDate && $clin->clinic->id == $user->clinic_id && $doc->id == $doctor_id){
                            // if($booking_type != 'Consultation'){
                                $datalist[$cnt]['id'] = 'Consultation - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Consultation - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            // if($booking_type != 'Diagnostics'){
                                $datalist[$cnt]['id'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            // if($booking_type != 'Dialysis'){
                                $datalist[$cnt]['id'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            // if($booking_type != 'Laboratory'){
                                $datalist[$cnt]['id'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            // if($booking_type != 'Laser'){
                                $datalist[$cnt]['id'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            // if($booking_type != 'Surgery'){
                                $datalist[$cnt]['id'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $datalist[$cnt]['name'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                                $cnt++;
                            // }
                            
                        // }else{
                            // $datalist[$cnt]['id'] = $booking_type . ' - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                            // $datalist[$cnt]['name'] = $booking_type . ' - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                            // $cnt++;
                        // }
                    }
                }
            }
        }
    //     $cnt = 0;
    //     foreach($user->clinic->affiliated_doctors->sortBy('name') as $doc){
    //         if(isset($doc->doctor->affiliated_clinics)){
    //             foreach($doc->doctor->affiliated_clinics->sortBy('name') as $clin){
    //                 foreach($doc->doctor->schedules()->whereBetween('dateSched', [$bookingDate, date('Y-m-d', strtotime($bookingDate . ' + 15 days'))])->orderBy('dateSched', 'asc')->distinct()->get('dateSched') as $sched){
    //                     if($sched->dateSched == $bookingDate && $doc->doctor->id == $doctor_id){
    //                         if($booking_type != 'Diagnostics'){
    //                             $datalist[$cnt]['id'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                         if($booking_type != 'Dialysis'){
    //                             $datalist[$cnt]['id'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                         if($booking_type != 'Laboratory'){
    //                             $datalist[$cnt]['id'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                         if($booking_type != 'Laser'){
    //                             $datalist[$cnt]['id'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                         if($booking_type != 'Surgery'){
    //                             $datalist[$cnt]['id'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                         if($booking_type != 'Consultation'){
    //                             $datalist[$cnt]['id'] = 'Consultation - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $datalist[$cnt]['name'] = 'Consultation - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                             $cnt++;
    //                         }
    //                     }
    //                     $datalist[$cnt]['id'] = $booking_type . ' - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                     $datalist[$cnt]['name'] = $booking_type . ' - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->doctor->id . ' - Dr. ' . $doc->doctor->name;
    //                     $cnt++;
    //                 }
    //             }
    //         }
    //    }
        // $data['data'] = $datalist;
        // dd(json_encode($data));
        return json_encode($datalist);
    }

    function getMedTable($id){
        $medLogs = ConsultationMed::where('consultation_id', $id)->orderBy('id', 'desc')->get();
        $medLogArr = $medLogs->toArray();
        foreach($medLogs as $ind=>$dat){
            $medLogArr[$ind]['creator'] = $dat->creator->name;
        }
        return json_encode($medLogArr);

    }

    function getMonTable($id){
        $monLogs = ConsultationMonitoring::where('consultation_id', $id)->orderBy('id', 'desc')->get();
        $monLogArr = $monLogs->toArray();
        foreach($monLogs as $ind=>$dat){
            $monLogArr[$ind]['creator'] = $dat->creator->name;
        }
        return json_encode($monLogArr);

    }

    function getNurseNotesTable($id){
        $nurseNotesLogs = ConsultationNurseNote::where('consultation_id', $id)->orderBy('id', 'desc')->get();
        $nurseNotesLogArr = $nurseNotesLogs->toArray();
        foreach($nurseNotesLogs as $ind=>$dat){
            $nurseNotesLogArr[$ind]['creator'] = $dat->creator->name;
        }
        return json_encode($nurseNotesLogArr);

    }

    function getDoctorList($patient_name, $conso = null){
        $user = Auth::user();
        unset($doctorsId);
        foreach(Consultation::where('clinic_id', $user->clinic_id)->get('doctor_id') as $booking){
            if($booking->doctor_id != '')
                $doctorsId[$booking->doctor_id] = $booking->doctor_id;
        }
        $doctors = User::where('name', 'like', "%{$patient_name}%")->whereIn('id', $doctorsId)->orderBy('name')->distinct()->get('name');
        return json_encode($doctors);
    }

    function pdfHD(Consultation $clinics_home){
        $pdf = Pdf::loadView($this->viewFolder . '.pdfHD', ['datum' => $clinics_home]);
        return $pdf->download('hd_' . $clinics_home->id . '-' . $clinics_home->treatment_number . '.pdf');
        
    }

    function pdfHDSum(Consultation $clinics_home){
        $allBooking = Consultation::where('patient_id', $clinics_home->patient_id)->where('booking_type', 'Dialysis')->whereNotNull('time_ended')->whereNot('id', $clinics_home->id)->where('bookingDate', '<', $clinics_home->bookingDate)->orderBy('bookingDate','asc')->get();
        $pdf = Pdf::loadView($this->viewFolder . '.pdfHDSum', ['datum' => $clinics_home, 'allBooking' => $allBooking]);
        return $pdf->download('hdSum_' . $clinics_home->id . '-' . $clinics_home->treatment_number . '.pdf');
        
    }

    function sendDrainwiz(Consultation $clinics_home){
        // dd($clinics_home);
        unset($params);
        // $params['opid'] = "";
        // $params['imagefile'] = "";
        $params['lname'] = $clinics_home->patient->l_name;
        $params['fname'] = $clinics_home->patient->f_name;
        $params['mname'] = $clinics_home->patient->m_name;
        $params['name'] = $clinics_home->patient->l_name . ', ' . $clinics_home->patient->f_name;
        // $params['suffix'] = "";
        $params['bday'] = $clinics_home->patient->birthdate;
        $params['age'] = floor((strtotime($clinics_home->bookingDate) - strtotime($clinics_home->patient->birthdate))/(60*60*24*365.25));
        $params['sex'] = $clinics_home->patient->gender;
        $params['adrs'] = $clinics_home->patient->address;
        if($clinics_home->patient->cityZip != ''){
            $expCity = explode(",", $clinics_home->patient->cityZip);
            $params['cityadd'] = $expCity[0];
            if(isset($expCity[2]))
                $params['zipcode'] = $expCity[2];
        }elseif($clinics_home->patient->provinceZip != ''){
            $expProv = explode(",", $clinics_home->patient->provinceZip);
            if(stristr($expProv[1], 'City'))
                $params['cityadd'] = $expProv[1];
            $params['provadd'] = $expProv[0];
            if(isset($expProv[2]))
                $params['zipcode'] = $expProv[2];
        }
        
        $params['civilstatus'] = $clinics_home->patient->civilStatus;
        $params['contactno'] = $clinics_home->patient->mobile_no;
        $params['lastconsultation'] =$clinics_home->bookingDate;
        $params['temp'] = $clinics_home->temp;
        $params['bp'] = $clinics_home->bpS . '/' . $clinics_home->bpD;
        $params['weight'] = $clinics_home->weight;
        // $params['pwd'] = "";
        // $params['phiccode'] = "";
        // $params['phicmembr'] = "";
        // $params['relationtomember'] = "";
        $params['phicpin'] = $clinics_home->patient->phil_num;
        // $params['phicmembrname'] = "";
        $params['emailadd'] = $clinics_home->patient->email;
        $params['anywheremd_id'] = $clinics_home->id;
        $params['anywheremd_updated'] = date('Y-m-d H:i:s');
        $params['status'] = "DONE ENTRY";
        $params['client_id'] = $clinics_home->clinic_id;
        Opdpatient::create($params);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been sent to Drainwiz.');
        
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
        // $user = Auth::user();
        $selectItems['doctors'] = User::where('user_type', 'Doctor')->where('active', 1)->orderBy('name', 'asc')->get();
        // $selectItems['patients'] = $user->patients->sortBy('name');
        $selectItems['hmos'] = HealthOrganization::all()->sortBy('name');
        $selectItems['civilStatus'] = $this->civilStatus;
        return $selectItems;
    }
    
}
