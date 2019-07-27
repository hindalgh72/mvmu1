<?php

namespace App\Http\Controllers\backend;

use App\User;
use App\UserRole;
use App\RoleAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createrole(Request $request){
        $data= $request->all();
        // dd($data);
        $validation= Validator::make($data,[
            'role'=> 'required|string',
            'description'=> 'required|string'
        ]);
        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $usertype = UserRole::create([
            'user_role'=>$data['role'],
            'description'=>$data['description']
        ]);
        if(!$usertype){
            return Redirect::route('user.createrole')->with('message', 'Role not Created')->with('type','danger');
        }    
        return Redirect::route('user.createrole')->with('message', 'Role Created')->with('type','success');
    }
    protected function createuser(Request $request){
        $data = $request->all();
        // dd($data);
        $validator=Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id'=>['required','integer']
        ]);
        // dd($validator);
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
            $role = RoleAssign::create([
                'user_id'=>$user->id,
                'role_id'=>$data['role_id']
            ]);
        return Redirect::route('user.createuser')->with('message','User Created')->with('type','success');
    }
    public function getroles(){
        $userroles = UserRole::where('id','>','1')->get();
        // dd($userroles);
        // return $userrole[0]->user_role;
        return view('backend.createuser')->with('userroles',$userroles);
    }
}
