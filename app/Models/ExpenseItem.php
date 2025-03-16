<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_id',
        'expense_head_id',
        'amount',
        'is_deleted'
    ];
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }

    public function expense_head()
    {
        return $this->belongsTo(ExpenseHead::class, 'expense_head_id');
    }
}
