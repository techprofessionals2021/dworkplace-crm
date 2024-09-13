<?php

namespace App\Providers;

use App\Models\Project\Project;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Project::observe(ProjectObserver::class);
        
        Relation::enforceMorphMap([
            'project' => 'App\Models\Project\Project',
        ]);
    }
}
