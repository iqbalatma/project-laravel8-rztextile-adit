<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RollTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "type", "quantity_roll", "quantity_unit", "capital", "profit", "roll_id", "invoice_id", "user_id"
    ];

    public function roll()
    {
        return $this->belongsTo(Roll::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
