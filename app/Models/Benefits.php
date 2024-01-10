<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    public function benefits()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'benefit_name',
        'description',
        'picture',
        'price',
    ];

}
