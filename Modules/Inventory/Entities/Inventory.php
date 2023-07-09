<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Combo\Entities\ComboItem;
use Modules\InventoryImage\Entities\InventoryImage;
use Modules\Order\Entities\OrderItem;
use Modules\Product\Entities\Product;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')
            ->with('category', 'subCategory', 'variant', 'variantOption', 'segment', 'pack');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderItems()
    {
        return $this->belongsTo(OrderItem::class, 'inventory_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comboItems()
    {
        return $this->belongsTo(ComboItem::class, 'inventory_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryVariants()
    {
        return $this->hasMany(InventoryVariant::class, 'inventory_id', 'id')->with('variant', 'variantOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventoryImages()
    {
        return $this->hasMany(InventoryImage::class, 'inventory_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InventoryFactory::new();
    }
}
