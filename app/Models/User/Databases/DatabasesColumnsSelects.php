<?php

namespace App\Models\User\Databases;

use Illuminate\Database\Eloquent\Model;

class DatabasesColumnsSelects extends Model
{
    // �X�V���鍀�ڂ̒�`
    protected $fillable = ['databases_columns_id', 'value', 'display_sequence', 'created_at', 'updated_at'];
}
