<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsBlock extends Model
{
    protected $fillable = ['page', 'section', 'data'];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }
}
