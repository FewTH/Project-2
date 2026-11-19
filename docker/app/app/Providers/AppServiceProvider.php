<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reward;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
        View::share('rewards', Reward::orderByDesc('reward_id')->get());

        // ลิงก์เปลี่ยนหน้า (1 2 3 Next) ให้สร้างแบบเดียวกับลิงก์อื่นในเว็บ จะได้มี /random_reward ครบ
        Paginator::currentPathResolver(fn () => url(request()->path()));
    }
}
