<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // �V�X�e���Ǘ��҂̂݋���
        Gate::define('system', function ($user) {
            return ($user->role == 1);
        });
        // �T�C�g�Ǘ��҂̂݋���
        Gate::define('site-admin', function ($user) {
            return ($user->role == 2);
        });
        // ���[�U�Ǘ��҂̂݋���
        Gate::define('user-admin', function ($user) {
            return ($user->role == 3);
        });
        // �^�p�Ǘ��҂̂݋���
        Gate::define('manager', function ($user) {
            return ($user->role == 10);
        });
        // ���F�҂̂݋���
        Gate::define('approver', function ($user) {
            return ($user->role == 11);
        });
        // �ҏW�҂̂݋���
        Gate::define('editor', function ($user) {
            return ($user->role == 12);
        });

        // �V�X�e���Ǘ��ҁ����[�U�Ǘ��҂̂݋���
        Gate::define('system_user-admin', function ($user) {
            return ($user->role == 1 || $user->role == 3);
        });
    }
}
