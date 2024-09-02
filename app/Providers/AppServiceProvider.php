<?php

namespace App\Providers;

use App\Contracts\PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(PDF::class, new class implements PDF
        {
            public function render(string $name, string $view, array $data = [])
            {
                return \Spatie\LaravelPdf\Support\pdf()
                    ->view($view, $data)
                    ->name($name);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        if (config('app.env') === 'production') {
            URl::forceScheme('https');
        }
    }
}
