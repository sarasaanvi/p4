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
	
	/**
	* 
	* get the account type for the user : Student /Teacher or Admin
	*/
    public static function getAccountType($user_name) {
		$user = User::where('user_name', '=', $user_name)->first();
		 # If we found the user, then return it's account type
		if($user) {
			#echo $user;
			return $user->account_type;
		} 
		else{
			return "Not Found";
		}

	}
	
	public static function getAccount($user_name) {
		$user = User::where('user_name', '=', $user_name)->first();
		 # If we found the user, then return it's account type
		if($user) {
			//echo $user;
			return $user;
		} 
		else{
			return "Not Found";
		}

	}
	
}
