<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StandardSurchargeName extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function surcharge(): HasMany
    {
       return  $this->hasMany(Surcharge::class);
    }

}
