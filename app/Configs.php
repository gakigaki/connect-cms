<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    /**
     * create()��update()�œ��͂��󂯕t���� �z���C�g���X�g
     */
    protected $fillable = ['name', 'value', 'category'];

}
