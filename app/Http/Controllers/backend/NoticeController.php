<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    public function getnotice(){
        $notices = DB::table('notice_type')->get();
        // dd($notices[0]);
        return view('backend.createnotice')->with('notices',$notices);
    }
    public function create(Request $request){
        $data=$request->all();
        $validator=Validator::make($data, [
            'notice_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'notice_type_id' => ['required', 'integer',]
        ]);
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $user = Notice::create([
            'notice_name' => $data['notice_name'],
            'description' => $data['description'],
            'notice_type_id' => $data['notice_type_id'],
        ]);

        return Redirect::route('notice.createnotice')->with('message','Notice Created')->with('type','success');
    }
    
    public function editpage(){
        $notices = Notice::join('notice_type','notice_type.id','notices.notice_type_id')
        ->select('*','notices.id as notice_id')
        ->get();
        // dd($notices);
        return view('backend.shownotice')->with('getnotices', $notices);
    }
    public function editnotice($id){
        $notice = Notice::join('notice_type','notice_type.id','notices.notice_type_id')
        ->select('*','notices.id as notice_id')
        ->where('notices.id','=',$id)
        ->first();
        $noticetype = DB::table('notice_type')->get();
        // dd($notice);
        return view('backend.updatenotice')->with('notice',$notice)->with('noticetypes',$noticetype);
    }
    public function updatenotice(Request $request){
        $data=$request->all();
        $validator=Validator::make($data,[
            'notice_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'notice_type_id' => ['required', 'integer',],
            'noticeid' => ['required', 'integer',]
        ]);
        
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $notice= Notice::findorfail($data['noticeid']);
        $notice->notice_name= $data['notice_name'];
        $notice->description=$data['description'];
        $notice->notice_type_id=$data['notice_type_id'];
        $notice->save();

        return Redirect::back()->with('message','Notice updated succesfully')->with('type','success');
    }
    public function delete($id){
        Notice::where('id',$id)->delete();
        return Redirect::route('notice.editnotice');
    }
}
