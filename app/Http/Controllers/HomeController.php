<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $module = "Dashboard";
    private $viewFolder = "home";
    private $modalSize = "modal-md";

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $this->getData($request->input());
        $datum = (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Test', 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user();
        if($user->user_type == "Doctor")
            return redirect('doctors_home');  
        if($user->user_type == "Clinic")
            return redirect('clinics_home');  

        $datum = (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        
        return view($this->viewFolder . '.index', [
            'moduleList' => $this->moduleList(), 
            'datum' => $datum, 
            'moduleActive' => $this->module, 
            'inputFormHeader' => 'Test', 
            'formAction' => 'update', 
            'viewFolder' => $this->viewFolder, 
            'modalSize' => $this->modalSize]);
    }

    public function myaccount(Request $request)
    {
        $urlQuery = null;
        if(stristr('?', $request->fullUrl()))
            $urlQuery = urldecode(explode('?', $request->fullUrl())[1]);
        $data = null;
        $user = Auth::user();
        $datum = $user;
        $userRole = $user->roles->pluck('name')->toArray();
        $viewFolder = $this->viewFolder;
        
        if($user->active == 2){
            $errors = ["Incomplete Form" => $this->newUserMsg];
        }elseif($user->approved == 0){
            // dd($user->approved);
            $errors = ["Pending Approval" => $this->notApproveMsg];
        }

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
        if($user->user_type == 'Doctor'){
            $viewFolder = 'doctors_home';
            $booking_type = null;
            unset($booking_type_arr);
            foreach($user->bookings()->distinct('booking_type')->where('bookingDate', $yr . '-' . $mon . '-' . $dayNum)->get() as $in=>$booking){
                if($booking->booking_type == '')
                    $booking_type_arr['Consultation'] = 'Consultation';
                else
                    $booking_type_arr[$booking->booking_type] = $booking->booking_type;
            }
            if(isset($booking_type_arr))
                ksort($booking_type_arr);
            if(!isset($booking_type) && isset($booking_type_arr))
                $booking_type = reset($booking_type_arr);

            if(!isset($booking_type_arr))
                $booking_type_arr = null;
            
            return view($viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'data' => $data, 
                'datum' => $datum, 
                'userRole' => $userRole, 
                'selectItems' => $this->selectItems(), 
                'viewFolder' => $viewFolder,
                'inputFormHeader' => 'My Account',
                'action'=>'myaccount',
                'formAction' => 'updateMyAccount', 
                'booking_type'=>$booking_type,
                'booking_type_arr'=>$booking_type_arr,
                'yr'=>$yr, 
                'mon'=>$mon, 
                'dayNum'=>$dayNum,
                'user'=>$user,
                'modalSize' => $this->modalSize,
                'modal' => true,
                'patientArr' => null,
                'doctorArr' => null,
                'urlQuery' => $urlQuery,
                'referer' => urldecode($request->headers->get('referer'))
            ])->withErrors(!empty($errors) ? $errors : null);
        }elseif($user->user_type == 'Clinic'){
            $viewFolder = 'clinics_home';
            $doctor_id = null;
            $specialty = null;
            $booking_type = null;
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
                if($booking->booking_type == '')
                    $booking_type_arr['Consultation'] = 'Consultation';
                else
                    $booking_type_arr[$booking->booking_type] = $booking->booking_type;
            }
            if(isset($booking_type_arr))
                ksort($booking_type_arr);
            if(!isset($booking_type) && isset($booking_type_arr))
                $booking_type = reset($booking_type_arr);
    
            if(!isset($booking_type_arr))
                $booking_type_arr = null;
    
            $patients = $user->patients->sortBy('name');
            
            return view($viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module,
                'data' => $data, 
                'datum' => $datum,
                'userRole' => $userRole, 
                'selectItems' => $this->selectItems(), 
                'viewFolder' => $viewFolder, 
                'inputFormHeader' => 'My Account',
                'action'=>'myaccount',
                'formAction' => 'updateMyAccount', 
                'yr'=>$yr, 
                'mon'=>$mon, 
                'dayNum'=>$dayNum,
                'dayNumSet'=>$dayNumSet,
                'user'=>$user,
                'specialty'=>$specialty,
                'doctor_id'=>$doctor_id,
                'booking_type'=>$booking_type,
                'booking_type_arr'=>$booking_type_arr,
                'modalSize' => $this->modalSize,
                'schedules'=>$schedules,
                'schedulesMon'=>$schedulesMon,
                'patients'=>$patients,
                'patientArr' => null,
                'doctorArr' => null,
                'urlQuery' => $urlQuery,
                'referer' => urldecode($request->headers->get('referer'))
            ])->withErrors(!empty($errors) ? $errors : null);
        }else{
            $viewFolder = 'home';
            return view($viewFolder . '.index', [
                'moduleList' => $this->moduleList(), 
                'moduleActive' => $this->module, 
                'data' => $data, 
                'datum' => $datum, 
                'userRole' => $userRole, 
                'selectItems' => $this->selectItems(), 
                'inputFormHeader' => 'My Account', 
                'action'=>'myaccount',
                'formAction' => 'update',
                'user'=>$user,
                'viewFolder' => $viewFolder, 
                'modalSize' => $this->modalSize,
                'patientArr' => null,
                'doctorArr' => null,
                'urlQuery' => $urlQuery,
                'referer' => urldecode($request->headers->get('referer'))
                ])->withErrors(!empty($errors) ? $errors : null);
        }
        
    }

    private function selectItems()
    {
        $user = Auth::user();
        $selectItems['roles'] = Role::orderBy('name', 'asc')->get();
        $selectItems['specialty'] = $this->docSpecs;
        return $selectItems;
    }
}
