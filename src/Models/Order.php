<?php

namespace RonAppleton\SseExample\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = [
        'editing_at',
    ];

    protected $casts = [
        'editing_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}