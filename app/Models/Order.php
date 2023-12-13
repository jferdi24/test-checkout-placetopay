<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function statusLabel()
    {
        $className = '';

        if ($this->status == Order::STATUS_CREATED) {
            $className = 'bg-blue-100 text-blue-800';
        }

        if ($this->status == Order::STATUS_PAYED) {
            $className = 'bg-green-100 text-green-800';
        }

        if ($this->status == Order::STATUS_REJECTED) {
            $className = 'bg-red-100 text-red-800';
        }

        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full '.$className.'">'.
            $this->status.'</span>';
    }
}
