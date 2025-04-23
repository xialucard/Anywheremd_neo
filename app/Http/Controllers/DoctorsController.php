<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFormRequest;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorsController extends Controller
{
    private $module = "Setup";
    private $model = "Doctor";
    private $viewFolder = "doctors";
    private $modalSize = "modal-lg  ";

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
    
    public function store(DoctorFormRequest $request)
    {
        $user = Auth::user();
        
        $request->validated();
        unset($params);
        
        $params = $request->input($this->viewFolder);
        if(!empty($request->doctors['prc_pic'])){
            $prc_pic = 'prc_pic_' . time() . '.' . $request->doctors['prc_pic']->extension();
            $request->doctors['prc_pic']->storeAs('public/doctor_files', $prc_pic);
            $params['prc_pic'] = $prc_pic;
        }
        
        if(!empty($request->doctors['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->doctors['profile_pic']->extension();
            $request->doctors['profile_pic']->storeAs('public/doctor_files', $profile_pic);
            $params['profile_pic'] = $profile_pic;
            
        }

        if(!empty($request->doctors['diploma_pic'])){
            $diploma_pic = 'diploma_pic_' . time() . '.' . $request->doctors['diploma_pic']->extension();
            $request->doctors['diploma_pic']->storeAs('public/doctor_files', $diploma_pic);
            $params['diploma_pic'] = $diploma_pic;
        }
        
        $params['name'] = $params['f_name'] . ' ' . $params['m_name'] . ' ' . $params['l_name'];
        $params['user_type'] = 'Doctor';
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        $params['password'] = Hash::make($this->defaultPassword);
        User::create($params)->assignRole('Doctor');
       
        return redirect()->route($this->viewFolder . '.index')->with('message', 'New Entry has been created.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $doctor, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $doctor;
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'View ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $doctor, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $doctor;
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Edit ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorFormRequest $request, User $doctor)
    {
        $user = Auth::user();

        $request->validated();
        unset($params);
        $params = $request->input($this->viewFolder);
        if(!empty($request->doctors['prc_pic'])){
            $prc_pic = 'prc_pic_' . time() . '.' . $request->doctors['prc_pic']->extension();
            $request->doctors['prc_pic']->storeAs('public/doctor_files', $prc_pic);
            $params['prc_pic'] = $prc_pic;
        }
        
        if(!empty($request->doctors['profile_pic'])){
            $profile_pic = 'profile_pic_' . time() . '.' . $request->doctors['profile_pic']->extension();
            $request->doctors['profile_pic']->storeAs('public/doctor_files', $profile_pic);
            $params['profile_pic'] = $profile_pic;
            
        }

        if(!empty($request->doctors['diploma_pic'])){
            $diploma_pic = 'diploma_pic_' . time() . '.' . $request->doctors['diploma_pic']->extension();
            $request->doctors['diploma_pic']->storeAs('public/doctor_files', $diploma_pic);
            $params['diploma_pic'] = $diploma_pic;
        }
        
        $params['name'] = $params['f_name'] . ' ' . $params['m_name'] . ' ' . $params['l_name'];
        $params['user_type'] = 'Doctor';
        $params['updated_by'] = $user->id;
        $doctor->update($params);
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
        User::destroy($id);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
    }

    private function getData($search_query = null)
    {
        $condition = $this->queryBuilder('users', !empty($search_query['doctors']) ? $search_query['doctors'] : '');
        // dd($search_query);
        $data = User::where($condition)
            ->sortable(['id' => 'desc'])
            ->paginate($this->page);
        //dd($data);
        return $data;
        
    }

    private function queryBuilder($model, $search_query){
        $condition[] = [$model . '.active', 1];
        $condition[] = [$model . '.user_type', 'Doctor'];
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
        $selectItems['specialty'] = $this->docSpecs;
        return $selectItems;
    }
}
