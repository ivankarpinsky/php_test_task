<?php

namespace App\Http\Controllers;

use App\Directory;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $files = File::where('user_id','=',$user_id)->where('parent_directory','=',0)->get();
        $directories = Directory::where('user_id','=',$user_id)->where('parent_directory','=',0)->get();

        return view('home',compact('files','directories'));
    }
}
