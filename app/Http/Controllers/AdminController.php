<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\DemoMail;
class AdminController extends Controller
{
    public function getalluser(){
        $role = Auth::user()->role;
       $authEmail = Auth::user()->email;

       if($role==='admin'){
        $userData = DB::table('tasks')->get();
        return view('adminDashboard',['userData'=>$userData]);
        }else{
           return redirect('dashboard');
       }
      
    }

    public function UserDetails($id){
        $role = Auth::user()->role;
        if($role==='admin'){
       $userData = DB::table('tasks')->where('id','=',$id)->get();
        return view('adminupdate',['userdata'=>$userData]);
        }else{
           return redirect('dashboard');
        }
    }

    public function updateUserDetails(Request $req,$id){
         $data = DB::table('tasks')->where('id',$id)
        ->update([
            'title' =>$req->title,
            'description' =>$req->description,
            'category' =>$req->category,
            'assignfrom' =>$req->assignfrom,
            'assignto' =>$req->assignto,
            'status'=>$req->status,
            'comments'=>$req->comments,
            'commentstime'=>now(),
            ]);
            if($data){
                return redirect('admin');
            } else{
                return redirect('admin');
            }
    }

    public function adminAssignTask(){
        return view('adminAssignTask');
    }

    public function newtaskAssign(Request $req){
        if($req->has('file')){
            $file =  $req->file('file');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = 'upload/category/';
            $file->move($path, $filename);
        }
        if($req->has('file')){
        $user = DB::table('tasks')
        ->insert([
            'email' => $req->email,
            'title' =>$req->title,
            'description' =>$req->description,
            'category' =>$req->category,
            'assignfrom' =>$req->assignfrom,
            'assignto' =>$req->assignto,
            'comments' =>$req->comments,
            'status' =>$req->status,
            'file'=>$path.$filename??'',
            'commentsby'=>Auth::user()->email,
            'commentstime'=>now(),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }else{
        $user = DB::table('tasks')
        ->insert([
            'email' => $req->email,
            'title' =>$req->title,
            'description' =>$req->description,
            'category' =>$req->category,
            'assignfrom' =>$req->assignfrom,
            'assignto' =>$req->assignto,
            'comments' =>$req->comments,
            'status' =>$req->status,
            'commentsby'=>Auth::user()->email,
            'commentstime'=>now(),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
        if($user){
            $auth = Auth::user()->email;
            $mailData =[
                'title' => 'Mail from ' . $auth,
                'body'=> 'A new task is being assigned',
                'tasktitle'=> $req->title,
                'taskdesc' =>$req->description,

            ];
            $mail = Mail::to($req->email)->send(new DemoMail($mailData));
            if($mail){
            return redirect('/admin');
            }
            return redirect('/admin');
        }
    }

    public function admindeleteTask($id){
        $taskDelete = DB::table('tasks')->where('id',"=",$id)
        ->delete();
        if($taskDelete){
            return redirect('admin');
        }
    }

    
}
