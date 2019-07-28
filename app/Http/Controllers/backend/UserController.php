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
    public function editpage(){
        $users = RoleAssign::join('users','users.id','role_assigns.id')
        ->join('user_role','user_role.id','role_assigns.role_id')
        ->select('*','role_assigns.id as roleassignid','user_role.id as userroleid')
        ->where('role_assigns.role_id','>','1')
        ->get();
        // dd($users);
        return view('backend.edituser')->with('getusers', $users);
    }
    public function editsingle($id){
        $users = RoleAssign::join('users','users.id','role_assigns.id')
        ->join('user_role','user_role.id','role_assigns.role_id')
        ->select('*','role_assigns.id as roleassignid','user_role.id as userroleid')
        ->where('role_assigns.user_id','=',$id)
        ->get();
        $userroles = UserRole::where('id','>','1')->get();
        // dd($users[0]);
        return view('backend.updateuser')->with('user',$users[0])->with('userroles',$userroles);
    }
    public function updateuser(Request $request){
        $data=$request->all();
        $validator=Validator::make($data,[
            'name'=>'required|string',
            'email'=>'required|string|email',
            'role_id'=>'required|integer',
            'user_id'=>'required|min:1|integer'
        ]);
        
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $user= User::findorfail($data['user_id']);
        $user->name= $data['name'];
        $user->email=$data['email'];
        $user->save();

        
        $roleid=$data['role_id'];
        $userrole = RoleAssign::where('user_id',$data['user_id'])->update(['role_id'=>$roleid]);
        // $userrole->role_id=$roleid;
        // $userrole->update();
        return Redirect::back()->with('message','User Updated Succesfully')->with('type','success');
    }
    public function updatepass(Request $request){
        $data=$request->all();
        $validator=Validator::make($data,[
            'password'=>'required|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $user= User::findorfail($data['user_id']);
        $user->password=Hash::make($data['password']);
        $user->save();

        return Redirect::back()->with('password','Succesfully Password Changed')->with('type','success');
    }
    public function delete($id){
        User::where('id',$id)->delete();
        RoleAssign::where('user_id',$id)->delete();
        return Redirect::route('user.editget');
    }
}
