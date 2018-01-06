<?php

namespace Baraear\Documentable;

use Illuminate\Support\ServiceProvider;

class DocumentableServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DocumentableObserver::class, function() {
            return new DocumentableObserver();
        });
    }

}
