<?php

namespace App\Models\User\Contents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Userable;

class Contents extends Model
{
    // �_���폜
    use SoftDeletes;

    // �ۑ����̃��[�U�[�֘A�f�[�^�̕ێ�
    use Userable;

    // ���t�^�̏ꍇ�A$dates �ɃJ�������w�肵�Ă����B
    protected $dates = ['deleted_at'];
}
