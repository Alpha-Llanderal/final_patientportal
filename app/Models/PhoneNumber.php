<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'phoneNumber'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}