<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'is_done',
        'due_date',
    ];
}
