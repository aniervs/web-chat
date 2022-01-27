<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('edit-user', function (User $user, User $user2) {
            return $user->id == $user2->id || $user->is_admin;
        });
        Gate::define('delete-user', function (User $user, User $user2) {
            return $user->id == $user2->id || $user->is_admin;
        });

        Gate::define('edit-message', function (User $user, Message $message) {
            return $user->id == $message->sender_id || $user->id == $message->receiver_id;
        });
        Gate::define('delete-message', function (User $user, Message $message) {
            return $user->id == $message->sender_id || $user->id == $message->receiver_id;
        });
    }
}
