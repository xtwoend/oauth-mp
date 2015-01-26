<?php


///login

Route::get('oauth/login', function(){

	if(!Auth::check()){

		$mp = \App::make('Merahputih\MpApi');
		
		if(! $mp->getUser())
		{
			return Redirect::to($mp->getLoginUrl());
		}
		else
		{
			$userdata = $mp->api('userdata');

			$auth = \Merahputih\OauthClient\MPUser::where('usn_name','=', $userdata['username'])->first();

			//dd($auth->uid);

			$user = \User::find($auth->uid);
			
			//dd($user);

			if(!$user){
				
				$user = new User;
				$user->email 	= $userdata['email'];
				$user->username = $userdata['username'];
				$user->fullname	= $userdata['fullname'];
				$user->avatar	= $userdata['avatar'];
				$user->cover 	= $userdata['cover'];
				$user->state_name = $userdata['state_name'];
				$user->city_name = $userdata['city_name'];
				$user->password = Hash::make(str_random(40));
				$user->id = $auth->uid;
				$user->save();
		
			}

			\Auth::login($user);
		}
		
		return Redirect::to('/');
	}
})->before(['guest.mp']);;



Route::get('oauth/logout', function()
{
		\Auth::logout();
		
		@session_start();

		@session_destroy();

		return \Redirect::to('/')->withErrors(array('logout success'));
});