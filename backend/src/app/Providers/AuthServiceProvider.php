<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Book;
use App\Policies\BookPolicy;
use App\Models\Chapter;
use App\Policies\ChapterPolicy;
/** 
* ** DEMO-LARAVEL **
* classe AuthServiceProvider
* implementta ServiceProvider(AuthServiceProvider)
* registra le policies utilizzate
*/
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Chapter::class => ChapterPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
