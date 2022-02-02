<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//HEMATOLOGI CONTROLLER
class HematologiController extends Controller
{

    //PAGING
    function index(){
        return view('hematologi.index');
    }

    function instrument(){
        return view('hematologi.instrument');
    }
    
    function inputqc(){
        return view('hematologi.inputqc');
    }

    function inputequas(){
        return view('hematologi.inputequas');
    }

    function report(){
        return view('hematologi.report');
    }
    //PAGING-END
}
