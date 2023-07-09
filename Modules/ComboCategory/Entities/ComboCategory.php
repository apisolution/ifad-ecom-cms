<?php

namespace Modules\ComboCategory\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Combo\Entities\Combo;

class ComboCategory extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function combos()
    {
        return $this->hasMany(Combo::class, 'combo_category_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\ComboCategory\Database\factories\ComboCategoryFactory::new();
    }
}
