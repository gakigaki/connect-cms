<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;

use Gate;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

//class AppServiceProvider extends ServiceProvider
class AppServiceProvider extends AuthServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // �F�T�[�r�X(Gate)���p�̏���
        $this->registerPolicies();

        // �V�X�e���Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_SYSTEM_MANAGER'), function ($user) {
            if ($user->role == config('cc_role.ROLE_SYSTEM_MANAGER')) {
                return true;
            }
            return false;
        });

        // �T�C�g�Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_SITE_MANAGER'), function ($user) {
            if ($user->role == config('cc_role.ROLE_SITE_MANAGER')) {
                return true;
            }
            return false;
        });

        // ���[�U�Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_USER_MANAGER'), function ($user) {
            if ($user->role == config('cc_role.ROLE_USER_MANAGER')) {
                return true;
            }
            return false;
        });

        // �y�[�W�Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_PAGE_MANAGER'), function ($user) {
            if ($user->role == config('cc_role.ROLE_PAGE_MANAGER')) {
                return true;
            }
            return false;
        });

        // �^�p�Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_OPERATION_MANAGER'), function ($user) {
            if ($user->role == config('cc_role.ROLE_OPERATION_MANAGER')) {
                return true;
            }
            return false;
        });

        return false;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
