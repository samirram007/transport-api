<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class FeeItemMonth extends Model
{
    use  HasFactory;
    protected $fillable = [
        'fee_item_id',
        'year_id',
        'month_id',
        'amount',
    ];
    public function fee_item()
    {
        return $this->belongsTo(FeeItem::class);
    }

    public function feeItem()
    {
        return $this->belongsTo(FeeItem::class, 'fee_item_id', 'id');
    }
    public function month()
    {
        return $this->belongsTo(Month::class,'month_id');
    }
}
