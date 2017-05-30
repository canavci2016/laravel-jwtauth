<?php

namespace Can\Jwt;

use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Gerçek dizindeki projedeki jwt dosyasına bakar
//        $this->mergeConfigFrom(config_path('jwt/jwt.php'),'jwtphp');

        //paket içindeki jwt dosyasına bakar
        $this->mergeConfigFrom(__DIR__.'/jwt/jwt.php','jwtphp');



        //jwt isimli klasör    config pathe jwt klasörü olarak gonderildi.
        $this->publishes([
            __DIR__.'/jwt' => config_path('jwt'),
        ]);

        $this->app->singleton('jwtAuth', function ($app) {
            return new JwtAuth();
        });

//        $this->app->make('')
    }
}
