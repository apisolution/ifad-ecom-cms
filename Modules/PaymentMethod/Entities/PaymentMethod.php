<?php

namespace Modules\PaymentMethod\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Order\Entities\Order;

class PaymentMethod extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\PaymentMethod\Database\factories\PaymentMethodFactory::new();
    }
}
