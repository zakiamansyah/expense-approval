<?php

namespace App\Providers;

use App\Repositories\ApprovalRepository;
use App\Repositories\ApprovalRepositoryInterface;
use App\Repositories\ApprovalStageRepository;
use App\Repositories\ApprovalStageRepositoryInterface;
use App\Repositories\ApproverRepository;
use App\Repositories\ApproverRepositoryInterface;
use App\Repositories\ExpenseRepository;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApproverRepositoryInterface::class, ApproverRepository::class);
        $this->app->bind(ApprovalStageRepositoryInterface::class, ApprovalStageRepository::class);
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
        $this->app->bind(ApprovalRepositoryInterface::class, ApprovalRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
