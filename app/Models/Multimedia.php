<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = [
        'company_id', 'type', 'url',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}