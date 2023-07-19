<?php

namespace App\Providers;

use App\Console\Commands\StandardizeSurchargeCommand;
use Illuminate\Support\ServiceProvider;
use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;
use Src\SurchargeMS\Surcharge\Infrastructure\Repositories\EloquentSurchargeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /** "In this case, the bind() method of the Laravel service container ($this->app)
         * is being used to link the SurchargeRepositoryContract interface
         * with the concrete implementation EloquentSurchargeRepository."
         */
        $this->app->bind(SurchargeRepositoryContract::class, EloquentSurchargeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                StandardizeSurchargeCommand::class,
            ]);
        }
    }
}
