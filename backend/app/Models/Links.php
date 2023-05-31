<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Links extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'title',
        'slug',
        'clicks',
        'status'
    ];
}
