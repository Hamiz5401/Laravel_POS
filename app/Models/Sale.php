<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function sales_line_item(): HasMany {
        return $this->hasMany(SalesLineItem::class);
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class);
    }   
}
