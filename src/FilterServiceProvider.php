<?php

namespace Suenerds\NovaSearchableBelongsToFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-searchable-belongs-to-filter', __DIR__.'/../dist/js/filter.js');
            Nova::style('nova-searchable-belongs-to-filter', __DIR__.'/../dist/css/filter.css');
        });

        Nova::router()
            ->group(function ($router) {
                $router->get('nova-searchable-belongs-to-filter', function (Request $request) {
                    return inertia('NovaSearchableBelongsToFilter');
                });
            });
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
