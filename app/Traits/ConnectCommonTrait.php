<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
}

