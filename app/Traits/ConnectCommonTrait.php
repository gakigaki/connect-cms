<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Core\Plugins;

trait ConnectCommonTrait
{
    /**
     * �����`�F�b�N
     * roll_or_auth : ���� or ����
     */
    public function can($roll_or_auth, $post = null, $plugin_name = null)
    {
        $args = null;
        if ( $post != null || $plugin_name != null ) {
            $args = [[$post, $plugin_name]];
        }

        if (!Auth::check() || !Auth::user()->can($roll_or_auth, $args)) {
            return $this->view_error("403_inframe");
        }
    }

    /**
     * �����`�F�b�N
     * roll_or_auth : ���� or ����
     */
    public function isCan($roll_or_auth, $post = null, $plugin_name = null)
    {
        $args = null;
        if ( $post != null || $plugin_name != null ) {
            $args = [[$post, $plugin_name]];
        }

        if (!Auth::check() || !Auth::user()->can($roll_or_auth, $args)) {
            return false;
        }
        return true;
    }

    /**
     * �G���[��ʂ̕\��
     *
     */
    public function view_error($error_code)
    {
        // �\���e���v���[�g���Ăяo���B
        return view('errors.' . $error_code);
    }

    /**
     * �v���O�C���ꗗ�̎擾
     *
     */
    public function getPlugins($arg_display_flag = true, $force_get = false)
    {
        // �v���O�C���ꗗ�̎擾
        $display_flag = ($arg_display_flag) ? 1 : 0;
        $plugins = Plugins::where('display_flag', $display_flag)->orderBy('display_sequence')->get();

        // �����I�ɔ�\���ɂ���v���O�C�������O
        if ( !$force_get ) {
            foreach($plugins as $plugin_loop_key => $plugin) {
                if ( in_array(mb_strtolower($plugin->plugin_name), config('connect.PLUGIN_FORCE_HIDDEN'))) {
                    $plugins->forget($plugin_loop_key);
                }
            }
        }
        return $plugins;
    }
}

