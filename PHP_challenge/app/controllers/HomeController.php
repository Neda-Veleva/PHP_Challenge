<?php

class HomeController extends BaseController {

	public function home()
	{
            if(Auth::check()) {
                $auth = User::find(Auth::user()->id);        
                return View::make('index')->with('auth', $auth);
            }
            else {
                return View::make('index');
           }
            
	}

}
