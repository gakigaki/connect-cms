<?php

namespace App\Models\User\Codestudies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Userable;

class Codestudies extends Model
{
    // �_���폜
    use SoftDeletes;

    // �ۑ����̃��[�U�[�֘A�f�[�^�̕ێ�
    use Userable;
}
