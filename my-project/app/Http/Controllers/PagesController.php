<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function home()
    {
    	$people = ['Devendra', 'Adarsh', 'Rim'];

    	return view('welcome', compact('people'));
    }


    public function about()
    {
    	return view('about' );

    }
    

}
