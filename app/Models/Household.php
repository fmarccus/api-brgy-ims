<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
