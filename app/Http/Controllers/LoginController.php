<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(){
        return Socialite::driver('github')->redirect();
    }
    
    public function loginCallback(){
        try{
            $githubUser = Socialite::driver('github')->stateless()->user();
            $user = User::updateOrCreate([
                'email' => $githubUser->email,
            ], [
                'name' => $githubUser->name,
                'password' => 'password',
            ]);
         
            Auth::login($user);
         
            return redirect('/dashboard');


        }catch(Exception $e){
            dd($e);
        }
    }
}
