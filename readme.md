# Installasi


	{
		...
		"merahputih/oauth-client": "dev-master"
	}


	composer update

## 
DB users

	tambahakan field ini 

	email
	username
	fullname
	avatar
	cover
	state_name
	city_name


# login 

	url : oauth/login

# logout 
	
	url : oauth/logout


# filter

	Route::get('/', 'HomeController@index')->before(['auth.mp']);

