<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Document;
use App\Models\EducationBoard;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'registration_no',
        'registration_date',
        'registration_valid_date',
        'chassis_no',
        'engine_no',
        'color',
        'capacity',
        'insurance_id',
        'vehicle_type_id',

    ];

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }


}
