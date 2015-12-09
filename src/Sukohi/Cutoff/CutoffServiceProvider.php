<?php namespace Sukohi\Cutoff;

use Illuminate\Support\ServiceProvider;

class CutoffServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('sukohi/cutoff');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */

	public function register()
	{
		$this->app['cutoff'] = $this->app->share(function($app)
		{
			return new Cutoff;
		});
	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['cutoff'];
	}

}
