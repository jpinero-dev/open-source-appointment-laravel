<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'company_id', 'name', 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}