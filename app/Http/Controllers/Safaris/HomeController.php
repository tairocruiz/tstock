<?php

namespace App\Http\Controllers\Safaris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the 404 Not found
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('f404');
    }
}
