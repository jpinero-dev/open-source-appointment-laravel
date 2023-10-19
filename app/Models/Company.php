<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Company extends Model
{
    protected $fillable = [
        'identification',
        'name', 'address', 'phone', 'state', 'logo', 'description',
        'website', 'facebook', 'instagram', 'linkedin', 'tiktok', 'user_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    


}