<?php

namespace Modules\Combo\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ComboCategory\Entities\ComboCategory;
use Modules\ComboImage\Entities\ComboImage;

/**
 * @method static findOrFail($id)
 */
class Combo extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comboCategory()
    {
        return $this->belongsTo(ComboCategory::class, 'combo_category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comboItems()
    {
        return $this->hasMany(ComboItem::class, 'combo_id', 'id')->with('inventory','inventoryVariants');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comboImages()
    {
        return $this->hasMany(ComboImage::class, 'combo_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Combo\Database\factories\ComboFactory::new();
    }
}
