<?php

namespace App\Providers;

use App\Contracts\TranslatorInterface;
use App\Services\Translator\EnglishTranslator;
use App\Services\Translator\VietnameseTranslator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /***
        singleton(): giúp dùng cùng một instance trong toàn app
        bindIf(): chỉ bind nếu chưa được bind trước đó
        ***/

        # Trước khi tối ưu dùng bindif() và singleton()
        // $this->app->bind(TranslatorInterface::class, function () {
        //     return match (config('app.locale')) {
        //         'vi' => new VietnameseTranslator(),
        //         'en' => new EnglishTranslator(),
        //     };
        // });

        # sau khi tối ưu
        $this->app->singleton(TranslatorInterface::class, function ($app) {
            return match ($app->getLocale()) {
                'vi' => new VietnameseTranslator(),
                'en' => new EnglishTranslator(),
                default => new EnglishTranslator(),
            };
        });

        // Optional binding, only if not already bound
        $this->app->bindIf(TranslatorInterface::class, function () {
            return new EnglishTranslator();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
