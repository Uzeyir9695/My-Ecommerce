<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fullname', 'email', 'mobile', 'country', 'city', 'zipcode', 'aptnumber', 'landmark'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
