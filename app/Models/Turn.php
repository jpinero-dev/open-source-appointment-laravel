<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;
use App\Models\Module;
use App\Models\TurnType;

class Turn extends Model
{
    protected $fillable = [
        'company_id', 'user_id', 'turn_type_id', 'module_id', 'start_datetime',
        'end_datetime', 'status', 'cancellation_reason',
        'number',
        'identification',
        'name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turnType()
    {
        return $this->belongsTo(TurnType::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}