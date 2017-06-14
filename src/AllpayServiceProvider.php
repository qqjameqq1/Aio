<?php

namespace Kevin50406418\Aio;

use Illuminate\Support\ServiceProvider;

class AllpayServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Publish Config
		$this->publishes([
			__DIR__ . '/Config/allpay.php' => config_path('allpay.php'),
		], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//Facade => Custom Class
		$this->app->singleton('allpay', function ($app) {
			return new Allpay;
		});
	}
}
