<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surcharge extends Model
{
    use HasFactory;

    protected $fillable = ['standard_surcharge_name_id'];

    public function standardSurchargeName(): BelongsTo
    {
        return $this->belongsTo(StandardSurchargeName::class);
    }

    public function rate(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function calculationType(): BelongsTo
    {
        return $this->belongsTo(CalculationType::class);
    }
}
