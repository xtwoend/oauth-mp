<?php namespace Merahputih\OauthClient;

use Illuminate\Support\ServiceProvider;
use Merahputih\OauthClient\MPSdk;

class OauthClientServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		include __DIR__ . '/filters.php';
		include __DIR__ . '/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerMpApi();
	}

	/**
	 * create instant class
	 * register mp sdk
	 */
	public function registerMpApi()
	{	
		$this->app->bind('Merahputih\MpApi', function(){
			return new MPSdk(\Config::get('merahputih.api'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
