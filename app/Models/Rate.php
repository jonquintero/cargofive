<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['surcharge_id', 'carrier_id', 'amount', 'currency'];


    public function surcharge(): BelongsTo
    {
        return $this->belongsTo(Surcharge::class,  'id', 'surcharge_id');
    }

    public function carrier(): BelongsTo
    {
        return $this->belongsTo(Carrier::class);
    }
}
