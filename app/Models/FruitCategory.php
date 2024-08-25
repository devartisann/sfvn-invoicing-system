<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FruitCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parent_id',
        'name',
        'created_at',
        'updated_at',
    ];
    
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
