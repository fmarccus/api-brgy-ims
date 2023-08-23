<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
    // protected $fillable = [
    //     'household_id',
    //     'first_name',
    //     'middle_name',
    //     'last_name',
    //     'birth_date',
    //     'sex',
    //     'pregnant',
    //     'civil_status',
    //     'religion',
    //     'contact',
    //     'nationality',
    //     'household_head',
    //     'bona_fide',
    //     'resident_six_months',
    //     'solo_parent',
    //     'voter',
    //     'pwd',
    //     'disability',
    //     'studying',
    //     'highest_education',
    //     'employed',
    //     'job_title',
    //     'income',
    //     'income_classification'
    // ];
}
