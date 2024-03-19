<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\DemoMail;

class UserController extends Controller
{
    public function task(Request $req){
        $search = $req['search']??"";
       $authEmail = Auth::user()->email;
       $role = Auth::user()->role;

        if($search!=""){
            $tasks = DB::table('tasks')->where('email',$authEmail)
            ->where('title','LIKE', "%$search%")->orwhere('description','LIKE', "%$search%")
            ->orwhere('status','LIKE', "%$search%")->orwhere('category','LIKE', "%$search%")
            ->orderBy('id', 'desc')
            ->paginate(5);
        $assignedTasks = DB::table('tasks')
            ->where('assignfrom', $authEmail)
            ->get();
        }else{ 
       $tasks = DB::table('tasks')
                   ->where('email', $authEmail)
                   ->orderBy('id', 'desc')
                   ->paginate(5);
       $assignedTasks = DB::table('tasks')
                   ->where('assignto', $authEmail)
                   ->get();
    }

    // return $tasks;
    return view('dashboard', [
        'assignedTasks' =>$assignedTasks,
        'authemail'=>$authEmail,
        'tasks' => $tasks,
        'role'=>$role,
    ]);
    }
    
    public function create(Request $req){
        if($req->has('file')){
        if($req->has('file')){
            $file =  $req->file('file');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = 'upload/category/';
            $file->move($path, $filename);
        }
        $user = DB::table('tasks')
        ->insert([
            'title' =>$req->title,
            'description' =>$req->description,
            'email'=>Auth::user()->email,
            'file'=>$path.$filename,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
      if($user){
        return redirect('/dashboard');
      }
    }else{
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
    }
    
    public function update($id){
        $data = DB::table('tasks')->find($id);
        return view('update',['data'=>$data]);
        
    }
    public function updateTask(Request $req, $id){
        $auth = Auth::user()->email;
        if($req->has('file')){
        if($req->has('file')){
            $file =  $req->file('file');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = 'upload/category/';
            $file->move($path, $filename);
        }
        $data = DB::table('tasks')->where('id',$id)
        ->update([
            'title' =>$req->title,
            'description' =>$req->description,
            'status'=>$req->status,
            'comments'=>$req->comments,
            'commentsby'=>$auth,
            'file'=>$path.$filename,
            'commentstime'=>now(),
            ]);
        if($data){
            return redirect('dashboard');
        } else{
            return redirect('dashboard');
        }
    }else{
        $data = DB::table('tasks')->where('id',$id)
        ->update([
            'title' =>$req->title,
            'description' =>$req->description,
            'status'=>$req->status,
            'comments'=>$req->comments,
            'commentsby'=>$auth,
            'commentstime'=>now(),
            ]);
            if($data){
                return redirect('dashboard');
            } else{
                return redirect('dashboard');
            }
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

    public function assignTaskUser(Request $req,$id,$title,$description){
        $auth = Auth::user()->email;
        $userFind = DB::table('users')->where('email','=',$req->email)->get();
        if($auth===$req->email){
            return "<h1>Task cannot be assigned to yourself</h1>";
        }elseif(count($userFind)!=0){
        $user = DB::table('tasks')->where('id','=',$id)
        ->update([
            'assignfrom' =>$auth,
            'assignto' =>$req->email,
        ]);
        if($user){
            $mailData =[
                'title' => 'Mail from ' . $auth,
                'body'=> 'A new task is being assigned',
                'tasktitle'=> $title,
                'taskdesc' =>$description,
            ];
            Mail::to($req->email)->send(new DemoMail($mailData));
            return redirect('dashboard');
        }
    }else{
        return "<h1>User Does not exist</h1>";
    }
    }
}
