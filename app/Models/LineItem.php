<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    use HasFactory;

    public function sale(): BelongsTo {
        return $this->belongsTo(Sale::class);
    }
}
