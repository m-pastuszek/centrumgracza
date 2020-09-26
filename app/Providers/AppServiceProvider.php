<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
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
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        setlocale(LC_TIME, "pl_PL");
        Carbon::setLocale('pl');

        Carbon::macro('toPolishString', function () {
            return sprintf("%d %s %d",
                $this->day,
                [
                    1 => 'stycznia', 2 => 'lutego', 3 => 'marca',
                    4 => 'kwietnia', 5 => 'maja', 6 => 'czerwca',
                    7 => 'lipca', 8 => 'sierpnia', 9 => 'września',
                    10 => 'października', 11 => 'listopada', 12 => 'grudnia',
                ][$this->month],
                $this->year
            );
        });
    }
}
