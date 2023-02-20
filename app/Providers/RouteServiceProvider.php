<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /** @var string $apiNamespace */
    protected $apiNamespace = 'App\Http\Controllers\Api';


    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            $this->mapApiRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        // Route::group([
        //     'middleware' => ['api', 'api_version:v1'],
        //     'namespace'  => "{$this->apiNamespace}\V1",
        //     'prefix'     => 'api/v1',
        // ], function ($router) {
        //     require base_path('routes/api_v1.php');
        // });

        // Route::group([
        //     'middleware' => ['api', 'api_version:v2'],
        //     'namespace'  => "{$this->apiNamespace}\V2",
        //     'prefix'     => 'api/v2',
        // ], function ($router) {
        //     require base_path('routes/api_v2.php');
        // });

        Route::group([
            'middleware' => ['api', 'api_version:v3'],
            'namespace'  => "{$this->apiNamespace}\V3",
            'prefix'     => 'api/v3',
        ], function ($router) {
            require base_path('routes/api_v3.php');
        });
    }
}
