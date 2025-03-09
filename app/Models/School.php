<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Document;
use App\Models\EducationBoard;
use App\Models\SchoolType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class School extends Model
{
    use   HasFactory;
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
