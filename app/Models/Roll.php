<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code",
        "name",
        "quantity_roll",
        "quantity_unit",
        "qrcode",
        "basic_price",
        "selling_price",
        "qrcode_image",
        "unit_id"
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function roll_transaction()
    {
        return $this->hasMany(RollTransaction::class);
    }
}
