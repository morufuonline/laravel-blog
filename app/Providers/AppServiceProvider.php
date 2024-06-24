<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Helpers\GeneralHelper;
use App\View\Components\AdminAppLayout;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        view()->share('gen_helper', GeneralHelper::class);
        Route::pattern('id', '[0-9]+');
        Route::pattern('post', '[0-9]+');
        Route::bind('poster', function (string $value) {
            return Post::where('id', $value)->where('user_id', auth()->id())->firstOrFail();
        });
        Blade::component('admin-app-layout', AdminAppLayout::class);
    }
}
