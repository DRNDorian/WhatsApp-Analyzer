<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;

class Group extends Model
{
    protected $table = 'user_group';
    public function files()
    {
        return $this->hasMany('App\Files', 'group_id', 'id');
    }
    public $fillable = [
        'user_id',
        'group_name'
    ];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'group_name' => 'string'
    ];
}
