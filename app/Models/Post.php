<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'profession_id',
        'email',
        'image',
        'message',
        'duration',
    ];
    protected $primaryKey = 'id';

    protected $nullable = [
        'publication',
    ];

    // Post.php
public function profession()
{
    return $this->belongsTo(Profession::class);
}

}
