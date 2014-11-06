<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
                
        //Validation New User
        public static $rules = array(
            'username' => 'required|unique:users|alpha_dash|min:4',
            'name' => 'required|between:3,10',
            'family' => 'required|between:5,25',
            'email' => 'required|email',
            'password' => 'required|alpha_num|between:6,18',
            'confirm_password' => 'required|same:password'
        );
        
        public static function validate($data) {
            return Validator::make($data, static::$rules);        
        }
        
        
        //Create New User
        public static function newUser($data) {
            $user = new User;
            $user->username = Input::get('username');
            $user->name = Input::get('name');
            $user->family = Input::get('family');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
        }
}
