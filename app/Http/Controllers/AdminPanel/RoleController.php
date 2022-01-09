<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class RoleController extends Controller
{


    /**
     * Display a listing of the Roles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = Role::get();

        return view('adminPanel.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Roles.
     *
     * @return Response
     */
    public function create()
    {
        $data['permissions'] = Permission::orderBy('page')->get();
        return view('adminPanel.roles.create', $data);
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=> 'required']);
        $role = Role::create(['name' => request('name')]);

        $role->syncPermissions(request('permissions'));

        return redirect(route('adminPanel.roles.index'))->with(['successMessage' => 'Created Successfully']);
    }

    /**
     * Display the specified Roles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['roles'] = Role::find($id);

        if (empty($data['roles'])) {return back()->with(['errorMessage' => 'This episode not found']);}

        return view('adminPanel.roles.show', $data);
    }

    /**
     * Show the form for editing the specified Roles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::orderBy('page')->get();

        if (empty($roles) || $roles->id == 1) {return back()->with(['errorMessage' => 'This episode not found']);}

        return view('adminPanel.roles.edit', compact('roles', 'permissions'));
    }

    /**
     * Update the specified Roles in storage.
     *
     * @param int $id
     * @param UpdateRolesRequest $request
     *
     * @return Response
     */
    public function update(Role $role, Request $request)
    {
        $role->update(['name' => request('name')]);

        $role->syncPermissions(request('permissions'));

        if (empty($role) || $role->id == 1) {return back()->with(['errorMessage' => 'This episode not found']);}

        return redirect(route('adminPanel.roles.index'))->with(['successMessage' => 'Updated Successfully']);
    }

    /**
     * Remove the specified Roles from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Role $role)
    {
        if (empty($role) || $role->id == 1) {return back()->with(['errorMessage' => 'This episode not found']);}
        $role->delete();

        return redirect(route('adminPanel.roles.index'))->with(['successMessage' => 'Deleted Successfully']);
    }

    public function updatePermissions(Request $request)
    {

        $collection = Route::getRoutes()->get();

        $routes = [];
        $permissions = [];

        foreach($collection as $route) {

            if ($route->getPrefix() == '/adminPanel') {

                $routeName = $route->getName();

                if ($routeName && !in_array($routeName, config('permission.excluded_routes')) ) {
                    $routePartials = explode('.', $routeName);

                    $page = $routePartials[1];
                    $action = $routePartials[2];

                    switch (true) {
                        case in_array($action, ['index', 'show']):
                            $permissions[$page .'_view'] = [
                                'page' => $page,
                                'action' => 'view',
                                'name' => $page .' view'
                            ];
                            break;

                        case in_array($action, ['create', 'store']):
                            $permissions[$page .'_create'] = [
                                'page' => $page,
                                'action' => 'create',
                                'name' => $page .' create'
                            ];
                            break;

                        case in_array($action, ['edit', 'update']):
                            $permissions[$page .'_edit'] = [
                                'page' => $page,
                                'action' => 'edit',
                                'name' => $page .' edit'
                            ];
                            break;

                        case in_array($action, ['destory']):
                            $permissions[$page .'_delete'] = [
                                'page' => $page,
                                'action' => 'delete',
                                'name' => $page .' delete'
                            ];
                            break;

                        default:
                            $permissions[$page .'_'. $action] = [
                                'page' => $page,
                                'action' => $action,
                                'name' => $page .' '. $action
                            ];
                            break;
                    }

                    $routes[] = $routeName;
                }
            }

        }

        foreach ($permissions as $permission) {
            Permission::createOnlyNew($permission);
        }

        return back();
    }
}
