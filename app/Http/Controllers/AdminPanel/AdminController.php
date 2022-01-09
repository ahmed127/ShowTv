<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Admin::query();

        if(request()->filled('name')){
            $query->where('name', $request->name);
        }

        if(request()->filled('email')){
            $query->where('email', $request->email);
        }

        $data['admins'] = $query->latest()->paginate($request->pagination??5);

        return view('adminPanel.admins.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::get()->pluck('name', 'id');
        return view('adminPanel.admins.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|max:191|confirmed'
        ]);

        $admin = Admin::create($inputs);

        $admin->syncRoles([request('role')]);

        return redirect()->route('adminPanel.admins.index')->with(['successMessage' => 'Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['admin'] = Admin::find($id);
        if(empty($data['admin'])){return back()->with(['errorMessage' => 'This admin not found']);}
        return view('adminPanel.admins.show' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['admin'] = Admin::find($id);
        if(empty($data['admin'])){return back()->with(['errorMessage' => 'This admin not found']);}
        $data['roles'] = Role::get()->pluck('name', 'id');
        return view('adminPanel.admins.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:admins,email,'.$id. ',id',
        ]);

        if(request()->filled('password')){
            $request->validate(['password' => 'required|min:6|max:191|confirmed']);
            $inputs['password'] = $request->password;
        }

        $admin = Admin::find($id);
        if(empty($admin)){return back()->with(['errorMessage' => 'This admin not found']);}

        $admin->update($inputs);

        if ($id != 1) { $admin->syncRoles([request('role')]); }
        return redirect()->route('adminPanel.admins.index')->with(['successMessage' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if(empty($admin) || $id == 1){return back()->with(['errorMessage' => 'This admin not found']);}

        $admin->delete();
        return redirect()->route('adminPanel.admins.index')->with(['successMessage' => 'Deleted Successfully']);
    }
}
