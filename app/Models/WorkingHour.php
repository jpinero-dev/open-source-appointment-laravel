<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = [
        'company_id', 'day_of_week', 'start_time', 'end_time',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}