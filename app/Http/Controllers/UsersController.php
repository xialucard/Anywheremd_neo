<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    private $module = "Setup";
    private $model = "User";
    private $viewFolder = "users";
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
        $userRole[0] = '';
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'userRole' => $userRole, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Input New ' . $this->model, 'formAction' => 'store', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
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
        $userRole[0] = '';
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'userRole' => $userRole, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Input New ' . $this->model, 'formAction' => 'store', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize, 'modal' => true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user = Auth::user();

        $request->validated();
        unset($params);
        $params = $request->input($this->viewFolder);
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        $params['password'] = Hash::make($this->defaultPassword);
        $selectedRole = $params['role'];
        unset($params['role']);
        $parentItem = User::create($params);
        $parentItem->syncRoles($selectedRole);
        if(!empty($request->input('user_warehouses'))){
            foreach($request->input('user_warehouses') as $user_warehouse){
                unset($params);
                $params = $user_warehouse;
                //$params['user_id'] = $parentItem->id;
                $params['created_by'] = $user->id;
                $params['updated_by'] = $user->id;
                $parentItem->warehouses()->create($params);
            }
         }
        
        return redirect()->route($this->viewFolder . '.index')->with('message', 'New Entry has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $user;
        $userRole = $user->roles->pluck('name')->toArray();
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'userRole' => $userRole, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'View ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $user;
        $userRole = $user->roles->pluck('name')->toArray();
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'userRole' => $userRole, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Edit ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        $userAuth = Auth::user();

        $request->validated();
        
        unset($params);
        $params = $request->input($this->viewFolder);
        $params['updated_by'] = $userAuth->id;
        $selectedRole = $params['role'];
        unset($params['role']);
        $user->update($params);
        $user->syncRoles($selectedRole);
        
        $user->user_warehouses()->delete();
        if($request->input('user_warehouses') !== null){
            foreach($request->input('user_warehouses') as $user_warehouse){
                unset($params);
                $params = $user_warehouse;
                //$params['user_id'] = $user->id;
                $params['created_by'] = $userAuth->id;
                $params['updated_by'] = $userAuth->id;
                $user->user_warehouses()->create($params);
            }
        }
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
        $condition = $this->queryBuilder('users', !empty($search_query['users']) ? $search_query['users'] : '');
        $data = User::with(['roles'])
            ->where($condition)
            ->whereHas('roles', function ($query) use($search_query) {
                $condition = $this->queryBuilder('roles', !empty($search_query['roles']) ? $search_query['roles'] : '');
                return $query->where($condition);
            })
            ->sortable()->paginate($this->page);
        //dd($data);
        return $data;
        
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
        $selectItems['roles'] = Role::orderBy('name', 'asc')->get();
        return $selectItems;
    }
}
