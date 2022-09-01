<?php

namespace MortenScheel\LaravelMacros;

use Illuminate\Support\ServiceProvider;
use MortenScheel\LaravelMacros\Mixins\CarbonMixin;
use MortenScheel\LaravelMacros\Mixins\CollectionMixin;
use MortenScheel\LaravelMacros\Mixins\CommandMixin;
use MortenScheel\LaravelMacros\Mixins\FilesystemMixin;
use MortenScheel\LaravelMacros\Mixins\QueryBuilderMixin;
use MortenScheel\LaravelMacros\Mixins\ResponseMixin;
use MortenScheel\LaravelMacros\Mixins\StrMixin;

class LaravelMacrosServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMacros();
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-macros.php' => config_path('laravel-macros.php'),
            ], 'laravel-macros');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-macros.php', 'laravel-macros');
    }

    private function registerMacros()
    {
        try {
            \Illuminate\Support\Collection::mixin(new CollectionMixin);
            \Illuminate\Support\Carbon::mixin(new CarbonMixin);
            \Illuminate\Database\Query\Builder::mixin(new QueryBuilderMixin);
            \Illuminate\Database\Eloquent\Builder::mixin(new QueryBuilderMixin);
            \Illuminate\Filesystem\Filesystem::mixin(new FilesystemMixin);
            \File::mixin(new FilesystemMixin);
            \Illuminate\Http\Response::mixin(new ResponseMixin);
            \Response::mixin(new ResponseMixin);
            \Illuminate\Support\Str::mixin(new StrMixin);
            \Illuminate\Console\Command::mixin(new CommandMixin);
        } catch (\ReflectionException $e) {
        }
    }
}
