<?php

namespace App\Http\Controllers;

use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private $module = "Setup";
    private $model = "Role";
    private $viewFolder = "roles";
    private $modalSize = "modal-md";
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
    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'roles.name' => 'required|unique:roles,name',
            'roles.permission' => 'required',
        ]);
        
        $params = $request->input($this->viewFolder);
        $params['created_by'] = $user->id;
        $params['updated_by'] = $user->id;
        $selected_permissions = $params['permission'];
        unset($params['permission']);
        $parentItem = Role::create($params);
        $parentItem->syncPermissions($selected_permissions);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'New Entry has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $role;
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'View ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Request $request)
    {
        $data = $this->getData($request->input());
        $datum = $role;
        
        return view($this->viewFolder . '.index', ['moduleList' => $this->moduleList(), 'moduleActive' => $this->module, 'data' => $data, 'datum' => $datum, 'selectItems' => $this->selectItems(), 'inputFormHeader' => 'Edit ' . $this->model, 'formAction' => 'update', 'viewFolder' => $this->viewFolder, 'modalSize' => $this->modalSize]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $user = Auth::user();

        $this->validate($request, [
            'roles.name' => 'required',
            'roles.permission' => 'required',
        ]);

        $params = $request->input($this->viewFolder);
        $params['updated_by'] = $user->id;
        $selected_permissions = $params['permission'];
        unset($params['permission']);
        $role->update($params);
        $role->syncPermissions($selected_permissions);
        
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
        Role::destroy($id);
        return redirect()->route($this->viewFolder . '.index')->with('message', 'Entry has been deleted.');
    }

    private function getData($search_query = null)
    {
        $condition[] = ['active', 1];
        if(!empty($search_query[$this->viewFolder])){
            foreach($search_query[$this->viewFolder] as $colName => $searchDet){
                if($searchDet != "")
                    $condition[] = [$colName, 'like', "%" . $searchDet . "%"];  
            }
        }
        $data = ModelsRole::where($condition)->sortable()->paginate($this->page);
        
        return $data;
    }

    private function selectItems()
    {
        $selectItems['permissions'] = Permission::where('active', 1)->orderBy('name', 'asc')->get();
        return $selectItems;
    }
}
