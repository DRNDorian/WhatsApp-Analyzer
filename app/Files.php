<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'user_files';
    public $fillable = [
        'user_id',
        'file_name',
        'availability'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'file_name' => 'string',
        'availability' => 'string',
    ];
}
