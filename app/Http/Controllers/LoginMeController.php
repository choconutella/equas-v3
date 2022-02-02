<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;

class LoginMeController extends Controller
{
    function login(Request $request){
        $data = User::where('user_id',$request->user_id)->firstOrFail();
        if($data){
            if($data->password==$request->password){
                session(['user_id'=>$data->user_id,'user_name'=>$data->user_name,'islogin'=>true]);
                return redirect()->route('koagulasi.home');
            }
            return redirect()->route('koagulasi.index');
        }
        return redirect()->route('koagulasi.index');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('koagulasi.index');
    }
}
