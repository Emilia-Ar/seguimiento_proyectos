<?php
namespace App\Providers;

use App\Models\Proyecto;
use App\Policies\ProyectoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Proyecto::class => ProyectoPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}