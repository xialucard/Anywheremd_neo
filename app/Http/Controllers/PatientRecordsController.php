<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFormRequest;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientRecordsController extends Controller
{
    private $module = "Patient's Records";
    private $model = "Consultation";
    private $viewFolder = "patient_records";
    private $modalSize = "modal-fullscreen";

    public function __construct()
    {
        //$this->middleware(['auth'])->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = null;
        if(!empty($request->input()))
            $data = $this->getData($request->input());
        $datum = (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        
        $patients = $user->patients->sortBy('name');

        return view($this->viewFolder . '.index', [
            'moduleList' => $this->moduleList(), 
            'moduleActive' => $this->module, 
            'data' => $data, 
            'datum' => $datum, 
            'selectItems' => $this->selectItems(), 
            'inputFormHeader' => 'Input New ' . $this->model, 
            'formAction' => 'store', 
            'viewFolder' => $this->viewFolder, 
            'modalSize' => $this->modalSize,
            'user' => $user,
            'patients' => $patients
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient_record, Request $request)
    {
        $user = Auth::user();
        $data = null;
        if(!empty($request->input()))
            $data = $this->getData($request->input());
        $datum = $patient_record;
        
        $patients = $user->patients->sortBy('name');
       
        return view($this->viewFolder . '.index', [
            'moduleList' => $this->moduleList(), 
            'moduleActive' => $this->module, 
            'data' => $data, 
            'datum' => $datum, 
            'selectItems' => $this->selectItems(), 
            'inputFormHeader' => 'View ' . $this->model, 
            'formAction' => 'update', 
            'viewFolder' => $this->viewFolder, 
            'modalSize' => $this->modalSize,
            'user' => $user,
            'patients' => $patients
        ]);
    }

    private function getData($search_query = null)
    {
        $condition = $this->queryBuilder('patients', !empty($search_query['patient_records']) ? $search_query['patient_records'] : '');
        // dd($search_query);
        $data = Consultation::with(['patient'])
            ->where($condition)
            ->sortable(['patient.name' => 'asc'])
            // ->get('patients.name');
            ->get();
            // ->paginate($this->page);
        //dd($data);
        return $data;
        
    }

    private function queryBuilder($model, $search_query){
        $user = Auth::user();
        $condition[] = [$model . '.active', 1];
        if($user->user_type != 'Internal' && $user->user_type != 'Doctor')
            $condition[] = [$model . '.client_id', $user->id];
        elseif($user->user_type == 'Doctor')
            $condition[] = ['consultations.doctor_id', $user->id];
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
        $selectItems = null;
        $selectItems['specialty'] = $this->docSpecs;
        if($user->user_type == 'Clinic')
            $selectItems['patients'] = $user->patients->sortBy('name');
        elseif($user->user_type == 'Doctor'){
            foreach($user->bookings()->distinct('patient_id')->get() as $booking){
                if(isset($booking->patient->name)){
                    $selectItems['patients'][$booking->patient->name] = $booking->patient;
                    
                }
            }

        }
        return $selectItems;
    }
}
