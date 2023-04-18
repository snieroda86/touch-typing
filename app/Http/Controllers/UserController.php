<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // check access
    public function checkAccess( Request $request){
        $reloadCounter = $request->reloadCounter;
        $access = true;
        if (auth()->check()) {
            return response()->json(['access' =>  $access]);
        } else {
            
            if($reloadCounter > 5){
                $access = false;
                return response()->json(['access' =>  $access]);
            }else{
                return response()->json(['access' =>  $access]);
            }
        }
        
    }

    // Logout 
    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }
}
