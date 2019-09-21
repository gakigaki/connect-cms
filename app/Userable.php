<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * ���f���̕ۑ����Ɏ����I�Ƀ��[�U�[ID �⃆�[�U�[����ێ����邽�߂�trait
 * �g�p����ɂ́A���f����created_id�Acreated_name�Aupdated_id�Aupdated_name���`����use����B
 *
 * @author �i���@�� <nagahara@opensource-workshop.jp>
 * @copyright OpenSource-WorkShop Co.,Ltd. All Rights Reserved
 * @category Core
 * @package App
 */
trait Userable
{
    public static function bootUserable()
    {
        /**
         *  �I�u�W�F�N�gcreate ���̃C�x���g�n���h��
         */
        static::creating(function (Model $model) {
            $model->created_id   = Auth::user()->id;
            $model->created_name = Auth::user()->name;
        });

        /**
         *  �I�u�W�F�N�gupdate ���̃C�x���g�n���h��
         */
        static::updating(function (Model $model) {
            $model->updated_id   = Auth::user()->id;
            $model->updated_name = Auth::user()->name;

        });
    }
}
