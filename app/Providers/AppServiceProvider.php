<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Laravel\Horizon\Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);

        \Carbon\Carbon::setLocale('zh');

        Horizon::routeSlackNotificationsTo('slack-webhook-url');
        Horizon::routeSmsNotificationsTo('1555666777');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
