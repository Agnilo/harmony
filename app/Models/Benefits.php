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

    public function index()
    {
        $benefits = Benefits::all(); // Fetch all benefits from the database

        return view('benefits', compact('benefits')); // Pass benefits data to the view
    }
}
