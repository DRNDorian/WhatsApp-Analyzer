<?php

namespace App;

use App\Jobs\SendDataBd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Messages extends Model
{
    protected $cache;
    protected $table = 'messages';
    public $fillable = [
        'date',
        'time',
        'user',
        'message',
        'user_id',
        'group_id'
    ];
    protected $casts = [
        'id' => 'integer',
        'date' => 'string',
        'time' => 'string',
        'user' => 'string',
        'message' => 'string',
        'user_id' => 'integer',
        'group_id' => 'string'
    ];

    public function storeBase($id)
    {
        dispatch(new SendDataBd($id));
    }
    public function __construct()
    {
        $this->cache = new Cache();
    }
}
