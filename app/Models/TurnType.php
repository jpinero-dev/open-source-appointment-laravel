<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class TurnType extends Model
{
    protected $fillable = [
        'company_id', 'prefix', 'number', 'name', 'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}