<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{

    protected $fillable = [
        'benefit_name',
        'description',
        'picture',
        'price',
        'introduction',
        'content',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_benefits');
    }
}
