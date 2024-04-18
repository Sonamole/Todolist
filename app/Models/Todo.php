<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'user_id',
        'completed',

    ];

    public function categorys()
    {
        return $this->belongsTo(category::class, 'category');
    }
}
