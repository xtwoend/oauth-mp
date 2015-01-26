<?php 

//filter 

Route::filter('auth.mp', function(){
		
	if(!Auth::check()){

		$mp = App::make('Merahputih\MpApi');

		if($mp->getUser()){

			$userdata = $mp->api('userdata');
			

			$auth = \Merahputih\OauthClient\MPUser::where('usn_name','=', $userdata['username'])->first();

			$user = User::find($auth->id);

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
	}
});


Route::filter('guest.mp', function()
{
	if (Auth::check()) return Redirect::to('/');
});
