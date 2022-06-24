<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->registerPolicies();
    
        VerifyEmail::toMailUsing(function ($notifiable, $url) {

            if(Auth::user() != null){
                $user = Auth::user();
            }
            else{
                $user = User::latest()->first();
            };
            return (new MailMessage)->subject('Vérification de votre email')->view('custom-mail', compact('user', 'url'));

        });

        Gate::define('is_client', function(User $user) {
            return $user->isClient();
        });

        Gate::define('is_validate', function(User $user) {
            return $user->isValidate();
        });
    }
}
