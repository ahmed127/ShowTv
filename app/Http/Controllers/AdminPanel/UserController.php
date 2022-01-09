<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if(request()->filled('name')){
            $query->where('name', $request->name);
        }

        if(request()->filled('email')){
            $query->where('email', $request->email);
        }

        $data['users'] = $query->latest()->paginate($request->pagination??5);
        
        return view('adminPanel.users.index' , $data);
    }

}
