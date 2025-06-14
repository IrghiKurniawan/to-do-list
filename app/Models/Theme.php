<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'primary_color',
        'background_color',
        'text_color',
        'is_dark',
    ];
}
