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
     * ���[�U�[���w�肳�ꂽ������ێ����Ă��邩�`�F�b�N����B
     *
     * @return boolean
     */
    public function check_authority($user, $authority)
    {
        // ���O�C�����Ă��Ȃ��ꍇ�͌����Ȃ�
        if (empty($user)) {
            return false;
        }

        // �w�肳�ꂽ�������܂ރ��[�������[�v����B
        foreach (config('cc_role.CC_AUTHORITY')[$authority] as $role) {
            // ���[�U�̕ێ����Ă��郍�[�������[�v
            foreach ($user['user_rolses'] as $target) {
                // �^�[�Q�b�g���������[�v
                foreach ($target as $user_role => $user_role_value) {
                    // �K�v�ȃ��[����ێ����Ă���ꍇ�́A��������Ƃ��� true ��Ԃ��B
                    if ($role == $user_role && $user_role_value) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * ���[�U�[���w�肳�ꂽ������ێ����Ă��邩�`�F�b�N����B
     *
     * @return boolean
     */
    public function check_role($user, $role)
    {
        // ���O�C�����Ă��Ȃ��ꍇ�͌����Ȃ�
        if (empty($user)) {
            return false;
        }

        // ���[�U�̕ێ����Ă��郍�[�������[�v
        foreach ($user['user_rolses'] as $target) {
            // �^�[�Q�b�g���������[�v
            foreach ($target as $user_role => $user_role_value) {
                // �K�v�ȃ��[����ێ����Ă���ꍇ�́A��������Ƃ��� true ��Ԃ��B
                if ($role == $user_role && $user_role_value) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // �F�T�[�r�X(Gate)���p�̏���
        $this->registerPolicies();

        // *** ���[������m�F

        // �L���C���i���f���[�^�j
        Gate::define('role_article', function ($user, $plugin_name = null, $post = null) {
            return $this->check_role($user, 'role_article');
        });


        // *** �L���̌�������m�F

        // �L���ǉ�
        Gate::define('posts.create', function ($user, $plugin_name = null, $post = null) {
            return $this->check_authority($user, 'posts.create');
        });

        // �L���ύX
        Gate::define('posts.update', function ($user, $plugin_name = null, $post = null) {
            return $this->check_authority($user, 'posts.update');
        });

        // �L���폜
        Gate::define('posts.delete', function ($user, $plugin_name = null, $post = null) {
            return $this->check_authority($user, 'posts.delete');
        });

        // �L�����F
        Gate::define('posts.approval', function ($user, $plugin_name = null, $post = null) {
            return $this->check_authority($user, 'posts.approval');
        });

        // *** �V�X�e����������m�F

        // �V�X�e���Ǘ��Ҍ����̗L���m�F
        Gate::define(config('cc_role.ROLE_SYSTEM_MANAGER'), function ($user) {
//print_r("cc_role.ROLE_SYSTEM_MANAGER");
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
