<?php

namespace Modules\Combo\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Combo\Entities\Combo;

class ComboImage extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function combo()
    {
        return $this->belongsTo(Combo::class, 'combo_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\ComboImage\Database\factories\ComboImageFactory::new();
    }
}
