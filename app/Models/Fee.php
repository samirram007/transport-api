<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use  HasFactory;
    protected $fillable = [
        'fee_no',
        'fee_date',
        'rider_id',
        'fiscal_year_id',
        'pickup_slot_id',
        'drop_slot_id',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'payment_mode',
        'is_deleted',
        'note',


    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function pickup_slot() {
        return $this->belongsTo(Slot::class);
    }
    public function drop_slot() {
        return $this->belongsTo(Slot::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class, 'rider_id', 'id');
    }


    public function rider_snapshot() {
        return $this->belongsTo(RiderSnapshot::class )->withDefault('rider');
    }
    public function fiscal_year() {
        return $this->belongsTo(FiscalYear::class);
    }

    public function fee_items(){
        return $this->hasMany(FeeItem::class, 'fee_id', 'id');
    }
    public function fee_item_months(){
        return $this->hasManyThrough(
            FeeItemMonth::class,  // Final model
            FeeItem::class,       // Intermediate model
            'fee_id',             // Foreign key on FeeItem table linking to Fee
            'fee_item_id',        // Foreign key on FeeItemMonth table linking to FeeItem
            'id',                 // Local key on Fee table
            'id'                  // Local key on FeeItem table
        );
    }


}
