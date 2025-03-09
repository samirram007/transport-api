<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_current',
        'is_active',
        'previous_fiscal_year_id',
        'next_fiscal_year_id',
     ];
     public function previous_fiscal_year() {
        return $this->belongsTo(FiscalYear::class, 'previous_fiscal_year_id');
     }
     public function next_fiscal_year() {
        return $this->belongsTo(FiscalYear::class, 'next_fiscal_year_id');
     }

}
