<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function task(){
        $auth = Auth::user()->email;
        $tasks = DB::table('tasks')->where('email','=',$auth)->orderBy('id','desc')->paginate(5);
        return view('dashboard',['tasks'=>$tasks]);
    }
    
    public function create(Request $req){
    
        $user = DB::table('tasks')
        ->insert([
            'title' =>$req->title,
            'description' =>$req->description,
            'email'=>Auth::user()->email,
            'created_at'=>now(),
            'updated_at'=>now()

        ]);
      if($user){
        return redirect('/dashboard');
      }
    }
    
    public function update($id){
        $data = DB::table('tasks')->find($id);
        return view('update',['data'=>$data]);
        
    }
    public function updateTask(Request $req, $id){
        $data = DB::table('tasks')->where('id',$id)
        ->update([
            'title' =>$req->title,
            'description' =>$req->description,
            'status'=>$req->status,
            ]);
        if($data){
            return redirect('dashboard');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function deleteTask($id){
        $taskDelete = DB::table('tasks')->where('id',$id)
        ->delete();
        if($taskDelete){
            return redirect('dashboard');
        }
    }

    public function assignTask($id){
        $assignTask = DB::table('tasks')->find($id);
        return view('assign',['assignTask'=>$assignTask]);
    }

    public function assignTaskUser(Request $req,$title,$description,$status){
        $auth = Auth::user()->email;
        $userFind = DB::table('tasks')->where('email','=',$req->email)->get();
        if($auth===$req->email){
            return "<h1>Task cannot be assigned to yourself</h1>";
        }elseif(count($userFind)!=0){
        $user = DB::table('tasks')
        ->insert([
            'title' =>$title,
            'description' =>$description,
            'email'=>$req->email,
            'assign'=>$auth,
            'status' =>$status,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        if($user){
            return redirect('dashboard');
        }
    }else{
        return "<h1>User Does not exist</h1>";
    }
    }
}
