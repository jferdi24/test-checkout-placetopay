<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property string $code
 * @property string $status
 * @property int $customer_id
 * @property int $id
 * @property float $total
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $customer
 * @property Collection $items
 */
class Order extends Model
{
    use HasFactory;

    const STATUS_CREATED = 'CREATED';

    const STATUS_PAYED = 'PAYED';

    const STATUS_REJECTED = 'REJECTED';

    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'status',
        'total',
        'code',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function statusLabel(): string
    {
        $className = match ($this->status) {
            Order::STATUS_CREATED => 'bg-blue-100 text-blue-800',
            Order::STATUS_PAYED => 'bg-green-100 text-green-800',
            Order::STATUS_REJECTED => 'bg-red-100 text-red-800',
            default => '',
        };

        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full '.$className.'">'.
            $this->status.'</span>';
    }
}
