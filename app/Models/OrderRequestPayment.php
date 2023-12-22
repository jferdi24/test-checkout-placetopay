<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $order_id
 * @property int $ending
 * @property string $request_id
 * @property string $process_url
 * @property string $response
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OrderRequestPayment extends Model
{
    protected $table = 'orders_requests_payments';

    protected $fillable = [
        'order_id',
        'request_id',
        'process_url',
        'response',
        'ending',
    ];
}
