<?php

namespace App\Providers\Model;

use App\Models\Submission;
use App\Observers\SubmissionObserver;
use Illuminate\Support\ServiceProvider;

class SubmissionModelProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Submission::observe(SubmissionObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
