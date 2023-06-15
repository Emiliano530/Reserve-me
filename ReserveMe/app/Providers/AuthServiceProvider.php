<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Policies\AdminAccessPolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate as FacadesGate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ]; 

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies(); 

        FacadesGate::define('view-admin', [AdminAccessPolicy::class, 'viewAdmin']);
    }
}
