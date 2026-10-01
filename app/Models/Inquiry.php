<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'source', 'name', 'email', 'phone', 'business', 'country', 'inquiry', 'message',
    ];
}
