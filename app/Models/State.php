<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state_code',
        'country_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
