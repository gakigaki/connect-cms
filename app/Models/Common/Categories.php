<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * create()��update()�œ��͂��󂯕t���� �z���C�g���X�g
     */
    protected $fillable = ['display_sequence', 'category', 'color', 'background_color'];

}
