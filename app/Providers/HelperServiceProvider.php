<?php

namespace App\Providers;
use App\Models\Show;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->share([
            'fiveRandomShows' => Show::where('type', 2)->inRandomOrder()->limit(5)->get(),
        ]);
    }
}
