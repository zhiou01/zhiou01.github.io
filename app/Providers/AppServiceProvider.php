<?php

namespace App\Providers;

use App\Http\Controllers\Data;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindLinkedinService();
    }

    /**
     * Bind linkedin service to the container.
     */
    protected function bindLinkedinService()
    {
        app()->bind('linkedin', function () {
            $linkedIn = new LinkedIn(Data::get('liClientId'), Data::get('liClientSecret'));

            return $linkedIn->setAccessToken(Data::get('liAccessToken'));
        });
    }
}
