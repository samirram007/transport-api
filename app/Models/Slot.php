<?php

namespace App\Models;

use App\Enums\SlotTypeEnum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slot extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slot_type',
        'vehicle_id',
        'team_id',
        'capacity',
        'start_time',
        'end_time',
        'is_active'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'slot_type' => SlotTypeEnum::class,
    ];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
