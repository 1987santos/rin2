<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            $notifications = [];
            if(auth()->user())
            {
                $query =  User::where('id', auth()->user()->id)->where('notification', 1)->first();
                if($query)
                {
                    $notifications =  $query->unreadNotifications->where('expiry_date', '>', NOW());
                }
            }
            
            $view->with('loggedin_user_notifications', $notifications);
        });
    }
}
