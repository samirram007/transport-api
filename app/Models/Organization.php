<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'address_id',
        'contact_no',
        'email',
        'website',
        'logo_image_id',

    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function logo_image()
    {
        return $this->belongsTo(Document::class);
    }
}