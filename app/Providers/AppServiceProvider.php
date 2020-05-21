<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
		\Collective\Html\FormFacade::macro('rawSubmitBtn', function($value = null, $options = array())
		{
			
			$submit = \Collective\Html\FormFacade::button('%s', array_merge ($options,['type' => 'submit'] ));

			return sprintf($submit, $value);
		});
    }
}
