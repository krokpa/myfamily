<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->session()->has('loggedin') && session('loggedin') === true)
        {
          
            switch(session('sessionRole')){
                case 'admin' :

                    if ($message = session()->get('error')){ redirect()->route('admin_home')->with('error',$message); }
                    if ($message = session()->get('success')){ redirect()->route('admin_home')->with('success',$message); }
                    if ($message = session()->get('warning')){ redirect()->route('admin_home')->with('warning',$message); }
                    if ($message = session()->get('info')){ redirect()->route('admin_home')->with('info',$message); }
                    if ($message = session()->get('danger')){redirect()->route('admin_home')->with('danger',$message); }
                    if ($message = session()->get('primary')){ redirect()->route('admin_home')->with('primary',$message); }
                    return redirect()->route('admin_home');
                    break;

                case 'user':
                    if ($message = session()->get('error')){ redirect()->route('user_home')->with('error',$message); }
                    if ($message = session()->get('success')){ redirect()->route('user_home')->with('success',$message); }
                    if ($message = session()->get('warning')){ redirect()->route('user_home')->with('warning',$message); }
                    if ($message = session()->get('info')){ redirect()->route('user_home')->with('info',$message); }
                    if ($message = session()->get('danger')){redirect()->route('user_home')->with('danger',$message); }
                    if ($message = session()->get('primary')){ redirect()->route('user_home')->with('primary',$message); }
                    return redirect()->route('user_home');
                    break;

                default:
                    return redirect()->route('signIn');
                    break;

             }

        }
        else
        {
            return redirect()->route('signIn');
        }
    }


}