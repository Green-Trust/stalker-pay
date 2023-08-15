<?php

namespace App\Providers;

use App\Repository\UserActivationCodeRepository;
use App\Repository\UserRepository;
use App\StalkerPay\User\Repository\UserRepositoryInterface;
use App\StalkerPay\UserActivationCode\Repository\UserActivationCodeRepositoryInterface;
use App\StalkerPay\UserActivationCode\Service\UserActivationCodeTtlChecker;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserActivationCodeRepositoryInterface::class, UserActivationCodeRepository::class);

        $this->app->when(UserActivationCodeTtlChecker::class)
            ->needs('userActivationCodeReplyTtlMinutes')
            ->giveConfig('user.activation_code.reply_ttl_minutes');
        $this->app->when(UserActivationCodeTtlChecker::class)
            ->needs('userActivationCodeTtlMinutes')
            ->giveConfig('user.activation_code.activation_ttl_minutes');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {}
}
