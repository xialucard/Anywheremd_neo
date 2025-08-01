<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Schedule;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\ScheduleConso;
use App\Models\AffiliatedDoctor;
use App\Models\ConsultationFile;
use App\Models\HealthOrganization;
use App\Models\IcdCode;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Spatie\LaravelPdf\Facades\Pdf;

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

        // print "<br>";
        // print "<br>";
        // print "<br>";
        // print "<br>";
        // print(public_path('storage/uploads/sig_pics'));
        
        $booking_type_arr = array('Diagnostics' => 0, 'Dialysis' => 0, 'Surgery' => 0, 'Laser' => 0, 'Laboratory' => 0, 'Referral' => 0, 'Consultation' => 0);
        foreach($user->bookings()->distinct('booking_type')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get() as $in=>$booking){
            if($booking->consultation_parent_id != ""){
                $booking_type_arr['Referral'] += 1;
            }elseif($booking->booking_type == ''){
                $booking_type_arr['Consultation'] += 1;
            }else{
                $booking_type_arr[$booking->booking_type] += 1;
            }
        }
        if(isset($booking_type_arr))
            ksort($booking_type_arr);
        if((!isset($booking_type) || $booking_type == 'NULL') && isset($booking_type_arr)){
            foreach($booking_type_arr as $booking_type => $count){
                if($count > 0)
                    break;
            }
        }
        elseif((!isset($booking_type) || $booking_type == 'NULL') && !isset($booking_type_arr))
            $booking_type = 'Consultation';

        if(!isset($booking_type_arr))
            $booking_type_arr = null;

        $calendarArr = null;
        if(isset($user->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get()[0])){
            foreach($user->schedules()->whereYear('dateSched', $yr)->whereMonth('dateSched', $mon)->get() as $sched){
                if(!isset($calendarArr[date('d', strtotime($sched->dateSched))]))
                    $calendarArr[date('d', strtotime($sched->dateSched))] = 1;
                else
                    $calendarArr[date('d', strtotime($sched->dateSched))] += 1;
            }
        }

        $bookingArr = null;
        foreach($user->bookings()->whereYear('bookingDate', $yr)->whereMonth('bookingDate', $mon)->get() as $booking){
            if(!isset($bookingArr[date('d', strtotime($booking->bookingDate))]))
                $bookingArr[date('d', strtotime($booking->bookingDate))] = 1;
            else
                $bookingArr[date('d', strtotime($booking->bookingDate))] += 1;
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
                'booking_type'=>$booking_type,
                'booking_type_arr'=>$booking_type_arr,
                'yr'=>$yr, 
                'mon'=>$mon, 
                'dayNum'=>$dayNum,
                'user'=>$user,
                'calendarArr'=>$calendarArr,
                'bookingArr'=>$bookingArr,
                'inputFormHeader' => 'Booking',
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
         if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
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
                'user' => $user,
                'referer' => urldecode($request->headers->get('referer'))
            ]);
        }
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
        $referer = $params['referer'];
        unset($params['referer']);
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
        return redirect()->to($referer)->with('message', "Doctor schedule saved.");
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Doctor schedule saved.');
    }

    public function manageClinic(Request $request)
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
                    'modal' => true,
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
            }
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
        $referer = $request->input($this->viewFolder)['referer'];
        return redirect()->to($referer)->with('message', "Affiliated clinic updated.");

        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Affiliated clinic updated.');
    }

    public function updateMyAccount(User $doctors_home, Request $request)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        $params['updated_by'] = $user->id;
        if(!empty($request->doctors_home['prc_pic'])){
            $prc_pic = 'prc_pic_' . time() . '.' . $request->doctors_home['prc_pic']->extension();
            $request->doctors_home['prc_pic']->storeAs('public/doctor_files', $prc_pic);
            $params['prc_pic'] = $prc_pic;
        }
        
        if(!empty($request->doctors_home['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->doctors_home['profile_pic']->extension();
            $request->doctors_home['profile_pic']->storeAs('public/doctor_files', $profile_pic);
            $params['profile_pic'] = $profile_pic;
            
        }

        if(!empty($request->doctors_home['diploma_pic'])){
            $diploma_pic = 'diploma_pic_' . time() . '.' . $request->doctors_home['diploma_pic']->extension();
            $request->doctors_home['diploma_pic']->storeAs('public/doctor_files', $diploma_pic);
            $params['diploma_pic'] = $diploma_pic;
        }

        if(!empty($request->doctors_home['sig_pic'])){
            $sig_pic = 'sig_pic' . time() . '.' . $request->doctors_home['sig_pic']->extension();
            $request->doctors_home['sig_pic']->storeAs('public/doctor_files', $sig_pic);
            $params['sig_pic'] = $sig_pic;
        }

        if($params['passwordOld'] != ''){
            if (Hash::check($params['passwordOld'], $user->getAuthPassword())) {
                $params['password'] = Hash::make($params['passwordNew']);
                // dd($params);
                if($user->active == 2)
                    $params['active'] = 1;
                $params['name'] = $params['f_name'] . ' ' . $params['m_name'] . ' ' . $params['l_name'];
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

    public function show(Consultation $doctors_home, Request $request)
    {
        $data = $this->getData($request->input());
        $user = Auth::user();
        $datum = $doctors_home;
        // dd($datum);
        $yr = null;
        $mon = null;
        $dayNum = null;
        $patients = $user->patients->sortBy('name');
        if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
            return view($this->viewFolder . '.index', [
                    'moduleList' => $this->moduleList(), 
                    'moduleActive' => $this->module, 
                    'data' => $data, 
                    'datum' => $datum, 
                    'inputFormHeader' => 'View ' . ($datum->booking_type == '' ? 'Consultation' : $datum->booking_type) . ' Booking', 
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
                    'modalSize' => 'modal-fullscreen',
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
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
         if($user->active == 2)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->newUserMsg);
        elseif($user->approved == 0)
            return redirect()->route('home.myaccount')->with("Incomplete Form", $this->notApproveMsg);
        else{
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
                    'modalSize' => 'modal-fullscreen',
                    'maxDateSched' =>$datum->doctor->schedules()->max('dateSched'),
                    'referer' => urldecode($request->headers->get('referer'))
                ]);
        }
    }

    public function update(Request $request, Consultation $doctors_home)
    {
        $user = Auth::user();
        unset($params);
        $params = $request->input($this->viewFolder);
        // dd($params);
        unset($patient);
        $patient = $params['Patient'];
        if(isset($patient)){
            $doctors_home->patient->update($patient);
        }

        if(isset($params['referal'])){
            $referralEntry = $params['referal'];
            unset($params['referal']);
        }
        
        $referer = $params['referer'];
        unset($params['referer']);
        
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
            $paramsRef['assessment'] = $params['assessment'];
            unset($params['assessment']);
            $paramsRef['planMed'] = $params['planMed'];
            unset($params['planMed']);
            $paramsRef['plan'] = $params['plan'];
            unset($params['plan']);
            $paramsRef['planRem'] = $params['planRem'];
            unset($params['planRem']);
            if(isset($params['prescription'])){
                $paramsRef['prescription'] = $params['prescription'];
                unset($params['prescription']);
            }
            if(isset($params['findings'])){    
                $paramsRef['findings'] = $params['findings'];
                unset($params['findings']);
            }
            if(isset($params['diagnosis'])){ 
                $paramsRef['diagnosis'] = $params['diagnosis'];
                unset($params['diagnosis']);
            }
            if(isset($params['recommendations'])){ 
                $paramsRef['recommendations'] = $params['recommendations'];
                unset($params['recommendations']);
            }
            if(isset($params['con_date_ao'])){ 
                $paramsRef['con_date_ao'] = $params['con_date_ao'];
                unset($params['con_date_ao']);
            }
            if(isset($params['procedure_ao'])){ 
                $paramsRef['procedure_ao'] = $params['procedure_ao'];
                unset($params['procedure_ao']);
            }
            if(isset($params['anesthesia_type_ao'])){
                $paramsRef['anesthesia_type_ao'] = $params['anesthesia_type_ao'];
                unset($params['anesthesia_type_ao']);
            }
            if(isset($params['anesthesiologist_ao'])){ 
                $paramsRef['anesthesiologist_ao'] = $params['anesthesiologist_ao'];
                unset($params['anesthesiologist_ao']);
            }
            if(isset($params['admittingOrder'])){ 
                $paramsRef['admittingOrder'] = $params['admittingOrder'];
                unset($params['admittingOrder']);
            }
            if($params['icd_code'] != '')
                $paramsRef['icd_code'] = explode(' - ', $params['icd_code'])[0];
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
            if(isset($params['Doctor'])){
                $doctor = $params['Doctor'];
                unset($params['Doctor']);
                if($params['submit_type'] == "" && !isset($params['referral_id']))
                    $params['status'] = "Done";
            
                $doctor['updated_by'] = $user->id;
                $doctors_home->doctor->update($doctor);
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
            if($params['icd_code'] != '')
                $params['icd_code'] = explode(' - ', $params['icd_code'])[0];
            // dd($params);
            $doctors_home->update($params);
        }

        Consultation::where('advance_booking_id', $doctors_home->id)->delete();
        if(isset($referralEntry)){
            // if(stristr($referralEntry, ' - ')){
                // $referalExp = explode(' - ', $referralEntry);
                // $dateExp = explode(' ', $referalExp[1]);
                unset($params);
                
                $params['booking_type'] = $doctors_home->booking_type;
                // if($referalExp[0] == 'Consultation')
                //     $params['booking_type'] = '';
                $params['bookingDate'] = $referralEntry;
                $params['doctor_id'] = $user->id;
                $params['fee'] = $user->fee;
                $params['patient_id'] = $doctors_home->patient_id;
                $params['client_id'] = $doctors_home->client_id;
                $params['clinic_id'] = $doctors_home->clinic_id;
                $params['advance_booking_id'] = $doctors_home->id;
                $params['status'] = "Confirmed";
                $params['others'] = "Follow up checkup";
                $params['created_by'] = $user->id;
                $params['updated_by'] = $user->id;
                
                Consultation::create($params);
            // }

        }
        
        
        
        return redirect()->to($referer)->with('message', "Entry has been updated.");
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been updated.');
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
        // $prevBookingInfo = $doctors_home->patient->consultations()->where('doctor_id', $user->id)->where('id', '<', $doctors_home->id)->orderByDesc('bookingDate')->get();
        // $prevBookingArr['consultation'] = $prevBookingInfo[$index];
        // $prevBookingArr['consultation']['iframePrevPrescSrc'] = file_exists(public_path('storage/prescription_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        // $prevBookingArr['consultation']['iframePrevMedCertSrc'] = file_exists(public_path('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        // $prevBookingArr['consultation']['iframePrevAdmittingSrc'] = file_exists(public_path('storage/admitting_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $prevBookingInfo[$index]->id . '_' . $prevBookingInfo[$index]->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        // $prevBookingArr['patient'] = $prevBookingInfo[$index]->patient;
        // foreach($prevBookingInfo[$index]->consultation_files as $ind=>$consultation_file){
        //     $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
        // }
        if(isset($datum->parent_consultation))
            $prevBookingArr['parent_consultation'] = $doctors_home->parent_consultation;
        $prevBookingArr['consultation'] = $doctors_home;
        if(isset($doctors_home->icd_code_obj->icd_code)){
            $prevBookingArr['consultation']['icd_code_obj']['icd_code'] = $doctors_home->icd_code_obj->icd_code;
            $prevBookingArr['consultation']['icd_code_obj']['details'] = $doctors_home->icd_code_obj->details;
        }
        $prevBookingArr['consultation']['doctor'] = $doctors_home->doctor;
        $prevBookingArr['consultation']['clinic'] = $doctors_home->clinic;
        $prevBookingArr['consultation']['iframePrevPrescSrc'] = file_exists(public_path('storage/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : (file_exists(public_path('storage/uploads/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage//uploads/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
        $prevBookingArr['consultation']['iframePrevMedCertSrc'] = file_exists(public_path('storage/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : (file_exists(public_path('storage/uploads/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage//uploads/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
        $prevBookingArr['consultation']['iframePrevAdmittingSrc'] = file_exists(public_path('storage/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : (file_exists(public_path('storage/uploads/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf')) ? asset('storage//uploads/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf') : 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg');
        $prevBookingArr['patient'] = $doctors_home->patient;
        foreach($doctors_home->consultation_files as $ind=>$consultation_file){
            $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
            $prevBookingArr['consultation_files'][$ind]['id'] = $consultation_file->id;
        }
        foreach($doctors_home->anesthesia_files as $consultation_file){
            $ind++;
            $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
            $prevBookingArr['consultation_files'][$ind]['id'] = $consultation_file->id;
        }
        foreach($doctors_home->doctor_files as $consultation_file){
            $ind++;
            $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
            $prevBookingArr['consultation_files'][$ind]['id'] = $consultation_file->id;
        }
        foreach($doctors_home->prescription_files as $consultation_file){
            $ind++;
            $prevBookingArr['consultation_files'][$ind]['file_link'] = asset($consultation_file->file_link);
            $prevBookingArr['consultation_files'][$ind]['id'] = $consultation_file->id;
        }

        if(isset($doctors_home->consultation_referals[0]->id)){
            $prevBookingArr['consultation_referals'] = $doctors_home->consultation_referals;
            foreach($doctors_home->consultation_referals as $ind=>$consoDet){
                $prevBookingArr['consultation_referals'][$ind]['doctor'] = $consoDet->doctor;
                $prevBookingArr['consultation_referals'][$ind]['clinic'] = $consoDet->clinic;
            }
        }else{
            $prevBookingArr['consultation_referals'][0]['id'] = '';
        }
        if(isset($doctors_home->parent_consultation->id)){
            $prevBookingArr['parent_consultation'] = $doctors_home->parent_consultation;
            $prevBookingArr['parent_consultation']['doctor'] = $doctors_home->parent_consultation->doctor;
            $prevBookingArr['parent_consultation']['clinic'] = $doctors_home->parent_consultation->clinic;
            if(isset($doctors_home->parent_consultation->consultation_referals[0]->id)){
                $prevBookingArr['consultation_referals'] = $doctors_home->parent_consultation->consultation_referals;
                foreach($doctors_home->parent_consultation->consultation_referals as $ind=>$consoDet){
                    $prevBookingArr['consultation_referals'][$ind]['doctor'] = $consoDet->doctor;
                    $prevBookingArr['consultation_referals'][$ind]['clinic'] = $consoDet->clinic;
                }
            }else{
                $prevBookingArr['consultation_referals'][0]['id'] = '';
            }
        }else{
            $prevBookingArr['parent_consultation']['id'] = '';
        }

        return json_encode($prevBookingArr);
    }

    function getDoctorBookingList($bookingDate, $booking_type){
        $user = Auth::user();
        $doc = $user;
        $cnt = 0;
        foreach($doc->affiliated_clinics->sortBy('name') as $clin){
            foreach($doc->schedules()->whereBetween('dateSched', [date('Y-m-d', strtotime($bookingDate . ' + 7 days')), date('Y-m-d', strtotime($bookingDate . ' + 30 days'))])->orderBy('dateSched', 'asc')->distinct()->get('dateSched') as $sched){
                $datalist[$cnt]['id'] = $booking_type . ' - ' . $sched->dateSched;
                $datalist[$cnt]['name'] = $booking_type . ' - ' . $sched->dateSched . ' (' . date('l', strtotime($sched->dateSched)) . ')';
                $cnt++;
                // $datalist[$cnt]['id'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $datalist[$cnt]['name'] = 'Diagnostics - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $cnt++;
                // $datalist[$cnt]['id'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $datalist[$cnt]['name'] = 'Dialysis - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $cnt++;
                // $datalist[$cnt]['id'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $datalist[$cnt]['name'] = 'Laboratory - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $cnt++;
                // $datalist[$cnt]['id'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $datalist[$cnt]['name'] = 'Laser - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $cnt++;
                // $datalist[$cnt]['id'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $datalist[$cnt]['name'] = 'Surgery - ' . $sched->dateSched . ' | ' . $clin->clinic->id . ' - ' . $clin->clinic->name . ' | ' . $doc->id . ' - Dr. ' . $doc->name;
                // $cnt++;
            }
        }
        // dd($datalist);
    
        return json_encode($datalist);
    }

    function pdfPrescription(Consultation $doctors_home){
        //Pdf::view($this->viewFolder . '.pdfPrescription', ['datum' => $doctors_home])->save('public/prescription_files' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        $pdf = Pdf::setOptions(['defaultFont' => 'sans-serif', 'chroot' => public_path('img/rx.jpg')])->loadView($this->viewFolder . '.pdfPrescription', ['datum' => $doctors_home]);
        // // $pdf->getDomPDF()->setHttpContext(
        // //     stream_context_create([
        // //         'ssl' => [
        // //             'allow_self_signed'=> TRUE,
        // //             'verify_peer' => FALSE,
        // //             'verify_peer_name' => FALSE,
        // //         ]
        // //     ])
        // // );
        Storage::put('public/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/prescription_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'E-Prescription PDF is created.');
    }

    function pdfMedCert(Consultation $doctors_home){
        $pdf = Pdf::setOptions(['defaultFont' => 'sans-serif', 'chroot' => public_path('storage/' . $doctors_home->doctor->sig_pic)])->loadView($this->viewFolder . '.pdfMedCert', ['datum' => $doctors_home]);
        // $pdf->getDomPDF()->setHttpContext(
        //     stream_context_create([
        //         'ssl' => [
        //             'allow_self_signed'=> TRUE,
        //             'verify_peer' => FALSE,
        //             'verify_peer_name' => FALSE,
        //         ]
        //     ])
        // );
        Storage::put('public/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/med_cert_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Med Cert PDF is created.');
    }

    function pdfAdmitting(Consultation $doctors_home){
        $pdf = Pdf::setOptions(['defaultFont' => 'sans-serif', 'chroot' => public_path('storage/' . $doctors_home->doctor->sig_pic)])->loadView($this->viewFolder . '.pdfAdmitting', ['datum' => $doctors_home]);
        
        Storage::put('public/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf', $pdf->output());
        $src = asset('storage/admitting_order_files/' . $doctors_home->id . '_' . $doctors_home->patient->l_name . '.pdf');
        return $src;
        // return redirect()->route($this->viewFolder . '.index')->with('message', 'Admitting Order PDF is created.');
    }

    function getIcdCode($icd_code){
        $icd_code = IcdCode::where('icd_code', 'like', "%{$icd_code}%")->orWhere('details', 'like', "%{$icd_code}%")->get();
        return json_encode($icd_code);
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
        $selectItems['affiliated_clinics'] = $user->affiliated_clinics->where('active', 1);
        $selectItems['clinics'] = Clinic::where('active', 1)->orderBy('name', 'asc')->get();
        $selectItems['hmos'] = HealthOrganization::all()->sortBy('name');
        return $selectItems;
    }

    
}
