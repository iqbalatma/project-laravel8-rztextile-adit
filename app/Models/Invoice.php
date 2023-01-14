<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "code", "total_capital", "total_bill", "total_profit", "total_paid_amount","bill_left", "is_paid_off", "customer_id", "user_id"
    ];


    public function customer()
    {
        return $this->belongsTo(User::class, "customer_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function roll_transaction()
    {
        return $this->hasMany(RollTransaction::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
