<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_number',
        'name',
        'email',
        'password',
        'address',
        'phone',
        'role_id',
        'is_active',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function invoiceCustomer()
    {
        return $this->hasMany(Invoice::class, "customer_id", "id");
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function roll_transaction()
    {
        return $this->hasMany(RollTransaction::class);
    }
    public function latestInvoiceCustomer()
    {
        return $this->hasOne(Invoice::class, "customer_id", "id")->latest();
    }
}
