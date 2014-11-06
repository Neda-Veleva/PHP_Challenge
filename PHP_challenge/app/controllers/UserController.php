<?php

class UserController extends \BaseController {

    
        public function getLogin()
	{
	    return View::make('users.login');
	}
        
        public function postLogin()
	{
	    $data = Input::all();
            $rules = array(
                'username' => 'required',
                'password' => 'required'
            );
            
            $validator = Validator::make($data, $rules);
            
            if($validator->fails()) {
                return Redirect::to('/account/login')->withErrors($validator)->withInput()->with('message', 'Incorrect data');
            }
            else {
                $user = array(
                    'username'=>Input::get('username'),
                    'password'=>Input::get('password'),
                );
                $username = ucwords(Input::get('username'));
                $remember = (Input::has('remember')) ? true : false;
                if(Auth::attempt($user, $remember)){ 
                    return Redirect::to('/')->with('message', "Hello, $username!");
                } else {
                    return Redirect::to('/account/login')->withErrors($validator)->withInput()->with('message', 'Incorrect data');                
                }
           }
	}
        
        public function logout() {
            $message = 'You are logout!';
            if(Auth::check()){
                Auth::logout();
                return Redirect::to('/')->with('message', $message);
            } else {
                return Redirect::to('/account/login')->with('message', $message);
            }
        }
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $data = Input::all();
            
            //model/User
            $validator = User::validate($data);
            
            if ($validator->fails()) {
                return Redirect::to('account/create')->withErrors($validator)->withInput()->with('message', 'Incorrect data!');
            }
            //model/User
	    User::newUser($data);
            return Redirect::to('/account/login')->with('message', 'Registration is successful! Please, Sign In!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editPassword()
	{
            if(Auth::check()){
                return View::make('users.password');
            } else {
                return Redirect::to('/account/login')->with('message', 'You are logout!');
            }
            
	}

        public function changePassword() {
            
            $user = User::find(Auth::user()->id);
            $data = Input::all();
            $rules = array(
                'old_password' => 'required',
                'new_password' => 'required|alpha_num|between:6,18',
                'confirm_password' => 'same:new_password'
            );
            
            $validator = Validator::make($data, $rules);
            
            if($validator->fails()) {
                return Redirect::to("/account/edit_password")->withErrors($validator)->with('message', 'Invalid data!');
            }
            else {
                $old_password = Input::get('old_password');
                $new_password = Input::get('new_password');
                
                if(Hash::check($old_password, $user->password)){
                    $user->password = Hash::make($new_password);
                    $user->save();
                    return Redirect::to('/')->with('message', 'Password have been changed!');
                }
                else {
                    return Redirect::to("/account/edit_password")->with('message', 'Your old password is incorrect!');
                }
            }
            
            return Redirect::to("/account/edit_password")->with('message', 'Your password is could not be changed!');
        }

}
