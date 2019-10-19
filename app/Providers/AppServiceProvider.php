<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\TopicObserver;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        if($this->app->environment() !== 'production'){
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

            if (app()->isLocal()) {
                $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
            }
        }
    }


    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);

        \Horizon::auth(function ($request){
            // 是否是站长
            return \Auth::user()->hasRole('Founder');
        });
    }
}
