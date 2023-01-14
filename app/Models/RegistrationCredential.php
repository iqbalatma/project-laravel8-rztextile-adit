<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationCredential extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["credential", "role_id", "is_active"];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
