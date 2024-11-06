<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// app/Models/Phone.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['phone_number', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}