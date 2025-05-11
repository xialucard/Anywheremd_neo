<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicFormRequest;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClinicsController extends Controller
{
    private $module = "Setup";
    private $model = "Clinic";
    private $viewFolder = "clinics";
    private $modalSize = "modal-md";

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
        $data = $this->getData($request->input());
        $datum = (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        // migration code //
        foreach (Clinic::whereNotNull(['user_id'])->get()     as $clinic) {
            User::where('id', $clinic->user_id)->update(['clinic_id' => $clinic->id]);
        }
        // print '<pre>';
        // print_r(Patient::where('active', 1));
        // print '</pre>';
        foreach (Patient::where('active', 1)->skip(20000)->take(10000)->get() as $patient) {
            $pastMedicalHistoryCommaArr = explode(',', $patient->pastMedicalHistoryComma);
            $pastFamilyHistoryCommaArr = explode(',', $patient->pastFamilyHistoryComma);
            $pastAllergiesCommaArr = explode(',', $patient->allergiesComma);
            $patient->update([
                'pastMedicalHistory' => json_encode($pastMedicalHistoryCommaArr),
                'pastFamilyHistory' => json_encode($pastFamilyHistoryCommaArr),
                'pastAllergies' => json_encode($pastAllergiesCommaArr)
            ]);

        }
        
        ///////////////////
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Input New ' . $this->model, 'formAction' => 'store', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        $data = $this->getData($request->input());
        $datum = (object)['id' => null, 'created_at' => null, 'updated_at' => null];
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Input New ' . $this->model, 'formAction' => 'store', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize, 'modal' => true]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(ClinicFormRequest $request)
    {
        $user = Auth::user();

        $request->validated();
        unset($params);
        $params = $request->input($this->viewFolder);
        if(!empty($params['user'])){
            $userC = $params['user'];
            unset($params['user']);
        }
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        //dd($params);
        $clinicObj = Clinic::create($params);
        if(!empty($userC)){
            $userC['name'] = $userC['f_name'] . ' ' . $userC['m_name'] . ' ' . $userC['l_name'];
            $userC['user_type'] = 'Clinic';
            $userC['clinic_id'] = $clinicObj->id;
            $userC['created_by'] = $user->id;
            $userC['updated_by'] = $user->id;
            $userC['password'] = Hash::make($this->defaultPassword);
            $userObj = User::create($userC)->assignRole('Clinic Admin');
            
        }
        return redirect()->route($this->viewFolder . '.index')->with('message', 'New Entry has been created.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $clinic;
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'View ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $clinic;
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'inputFormHeader' => 'Edit ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicFormRequest $request, Clinic $clinic)
    {
        $user = Auth::user();

        $request->validated();
        unset($params);
        $params = $request->input($this->viewFolder);
        if(!empty($params['user'])){
            $userC = $params['user'];
            unset($params['user']);
        }
        $params['updated_by'] = $user->id;
        if(!empty($userC)){
            $userC['name'] = $userC['f_name'] . ' ' . $userC['m_name'] . ' ' . $userC['l_name'];
            $userC['user_type'] = 'Clinic';
            $userC['created_by'] = $user->id;
            $userC['updated_by'] = $user->id;
            $userC['password'] = Hash::make($this->defaultPassword);
            $clinic->users()->find($userC['id'])->update($userC);
            
        }
        $clinic->update($params);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinicObj = Clinic::find($id);
        $clinicObj->users()->delete();
        Clinic::destroy($id);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
    }

    private function getData($search_query = null)
    {
        $condition = $this->queryBuilder('clinics', !empty($search_query['clinics']) ? $search_query['clinics'] : '');
        $data = Clinic::where($condition)
            ->sortable(['id' => 'desc'])
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
        $selectItems = null;
        return $selectItems;
    }
}
