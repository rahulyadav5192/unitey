<?php

namespace App\Providers;

use App\Cms\Catalog;
use App\Services\CmsStore;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('pages.*', function ($view) {
            $map = Catalog::viewMap();
            $slug = $map[$view->name()] ?? null;
            if (! $slug) {
                return;
            }

            $cms = app(CmsStore::class);
            $view->with('cms', $cms->page($slug));
            $view->with('site', $cms->page('site'));
            $view->with('companies', $cms->page('portfolio')['companies']['items'] ?? []);
        });
    }
}
