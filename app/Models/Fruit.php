<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fruit extends Model
{
    use HasFactory;
    
    protected $appends = [
        'name',
        'category_id',
        'unit',
        'price',
        'created_at',
        'updated_at',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(FruitCategory::class, 'category_id', 'id');
    }
}
