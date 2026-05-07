<?php

namespace AbdurRahaman\Icon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Icon extends Model
{
    use HasFactory;

    /**
     * Table name (important for packages)
     */
    protected $table = 'icons';

    /**
     * Mass assignable fields
     */
    protected $guarded = [  ];

    /**
     * Optional: type casting
     */
    protected $casts = [
        'id' => 'integer',
        'icon' => 'string', 
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    ];
}