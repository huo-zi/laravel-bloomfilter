<?php

namespace BloomFilter;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function register()
    {
        $this->app->singleton(BloomFilter::class, function ($app) {
            return new BloomFilter(new Hashing($this->config('algos', null)));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/bloomfilter.php' => config_path('bloomfilter.php'),
        ], 'config');
    }

    private function config($key, $default = null) {
        return config('bloomfilter.' . $key, $default);
    }
}
