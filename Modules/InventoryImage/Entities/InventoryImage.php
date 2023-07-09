<?php

namespace Modules\InventoryImage\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Entities\Inventory;

class InventoryImage extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\InventoryImage\Database\factories\InventoryImageFactory::new();
    }
}
