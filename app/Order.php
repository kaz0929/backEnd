<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $user_id
 * @property string $recipient_name
 * @property string $recipient_phone
 * @property string $recipient_address
 * @property string $shipment_time
 * @property int $total_price
 * @property string $shipment_status
 * @property string $payment_status
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'recipient_name', 'recipient_phone', 'recipient_address', 'shipment_time', 'total_price', 'shipment_status', 'payment_status', 'created_at', 'updated_at'];

    public function order_datails()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
