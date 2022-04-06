<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

/**
 * Class RoleController
 * @package App\Http\Controllers
 * @category Controller
 */
class RoleController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:role-read|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-update', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function index(Request $request)
    {
        $roles = $this->filter($request)->paginate(10)->withQueryString();
        return view('roles.index',compact('roles'));
    }

    private function filter(Request $request)
    {
        $query = Role::latest();
        if ($request->name)
            $query->where('name', 'like', $request->name.'%');
        if (isset($request->role_for))
            $query->where('role_for', $request->role_for);
        return $query;
    }

    /**
     * Show the form for creating a new resource
     *
     * @access public
     * @return mixed
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage
     *
     * @access public
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            'role_for' => 'required',
        ]);

        if($request->input('role_for') == "1") //staff
        {
            $role = Role::create([
                'name' => $request->input('name'),
                'role_for' => $request->input('role_for')
            ]);
            $role->syncPermissions($request->input('permission'));
        } else {
            $this->validate($request, [
                'price' => 'required',
                'validity' => 'required',
            ]);
            $role = Role::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'validity' => $request->input('validity'),
                'role_for' => $request->input('role_for')
            ]);
            $role->syncPermissions($request->input('permission'));
        }
        session()->flash('success', trans('Role Created Successfully'));
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource
     *
     * @param $id
     * @access public
     * @return mixed
     */
    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();
        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param $id
     * @access public
     * @return mixed
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('role','permissions','rolePermissions'));
    }

    /**
     * Method to custom update
     *
     * @access public
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            'role_for' => 'required',
        ]);

        if($request->input('role_for') == "1")
        {
            $role->name = $request->input('name');
            $role->role_for = $request->input('role_for');
            $role->price = '';
            $role->validity = '';
            $role->save();
            $role->syncPermissions($request->input('permission'));
        } else {
            $this->validate($request, [
                'price' => 'required',
                'validity' => 'required',
            ]);
            $role->name = $request->input('name');
            $role->role_for = $request->input('role_for');
            $role->price = $request->input('price');
            $role->validity = $request->input('validity');
            $role->save();
            $role->syncPermissions($request->input('permission'));
        }
        return redirect()->route('roles.index')->with('success',trans('Role Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage
     *
     * @access public
     * @param $id
     * @return mixed
     */
    public function destroy(Role $role)
    {
        DB::table("roles")->where('id', $role->id)->delete();
        return redirect()->route('roles.index')
            ->with('success',trans('Role Deleted Successfully'));
    }
}
