<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'sex',
        'occupation',
        'POF',
        'status',
        'remarks',
         // Add '_token' to the fillable array
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
