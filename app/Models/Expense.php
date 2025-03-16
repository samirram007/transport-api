<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Expense extends Model
{
    use  HasFactory;
    protected $fillable = [
        'expense_no',
        'voucher_no',
        'expense_date',
        'fiscal_year_id',
        'total_amount',
        'payment_mode',
        'is_deleted',
        'note',
        'document_id',

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
    public function fiscal_year() {
        return $this->belongsTo(FiscalYear::class);
    }



    public function expense_items(){
        return $this->hasMany(ExpenseItem::class);
    }

}
