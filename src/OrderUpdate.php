<?php

namespace Ronappleton\SseExample;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 *
 * @property int $order_id
 * @property Carbon $updated_at
 *
 * @method static UpdatedSince(Carbon $when);
 */
class OrderUpdate extends Model
{
    protected $fillable = [
        'order_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeUpdatedSince(Builder $query, Carbon $when)
    {
        return $this->query->where('updated_at', '>', $when);
    }
}
