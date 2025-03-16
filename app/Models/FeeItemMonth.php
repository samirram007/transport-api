<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class FeeItemMonth extends Model
{
    use  HasFactory;
    protected $fillable = [
        'fee_id',
        'fee_item_id',
        'rider_id',
        'year',
        'month_id',
        'is_waived',
        'amount',
    ];
    public function fee_item()
    {
        return $this->belongsTo(FeeItem::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    protected $casts = [
        'is_waived' => 'boolean',
        'amount' => 'float',
    ];
}
