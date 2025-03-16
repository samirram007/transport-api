<?php

namespace App\Models;

use App\Enums\RiderTypeEnum;
use App\Enums\SchoolTimeEnum;
use App\Enums\SectionEnum;
use App\Enums\StandardEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Rider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rider_snapshot_id',
        'code',
        'rider_type',
        'profile_document_id',
        'profile_info',
        'academic_info',
        'email',
        'contact_no',
        'address_id',
        'status',
        'emergency_contact_no',
        'guardian_info',
        'join_date',
        'dissociate_date',
        'is_active',
        'vehicle_id',
        'school_id',
        'school_time',
        'standard',
        'section',
        'roll_no',
        'pickup_slot_id',
        'drop_slot_id',
        'pickup_point_id',
        'drop_point_id',
        'pickup_time',
        'drop_time',
        'journey_type_id',
        'is_free',
        'monthly_charge',
        'is_idcard_printable',
        'idcard_print_count',
        'is_release_idcard_printable',
        'release_idcard_print_count',
        'next_fees_date',

    ];

    protected $casts = [
        'profile_info' => 'array',
        'academic_info' => 'array',
        'guardian_info' => 'array',
        'is_active' => 'boolean',
        'is_free' => 'boolean',
        'monthly_charge' => 'decimal:2',
        'is_idcard_printable' => 'boolean',
        'is_release_idcard_printable' => 'boolean',
        'rider_type' => RiderTypeEnum::class,
        'standard' => StandardEnum::class,
        'section' => SectionEnum::class,
        'school_time' => SchoolTimeEnum::class,
    ];
    protected $dates = [
        'join_date',
        'dissociate_date',
        'next_fees_date',
    ];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function profile_document()
    {
        return $this->belongsTo(Document::class, 'profile_document_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function pickup_slot(){
        return $this->belongsTo(Slot::class,'pickup_slot_id');
    }
    public function drop_slot(){
        return $this->belongsTo(Slot::class,'drop_slot_id');
    }


    public function fees()
    {
        return $this->hasMany(Fee::class, 'rider_id', 'id');
    }

    public function fee_item_months()
    {
        return $this->hasMany(FeeItemMonth::class,'rider_id','id');
    }
    public function rider_snapshots(){
        return $this->hasMany(RiderSnapshot::class);
    }
    public function rider_snapshot(){
        return $this->belongsTo(RiderSnapshot::class);
    }


    protected static function boot()
    {
        parent::boot();


        // Automatically set updated_by when updating
        // static::updating(function ($riderData) {
        //     // dd($riderData);
        //    $rider = self::find($riderData->id);

        //     $riderSnapShot = new RiderSnapshot();
        //     //copy all $riders values to rider_snapshot except the id
        //     $riderSnapShot->fill($rider->toArray());
        //     // dd( $riderSnapShot->toArray());
        //     $riderSnapShot->rider_id = $rider->id;
        //     $riderSnapShot->save();

        //     $riderData->rider_snapshot_id = $riderSnapShot->id;


        // });
        // Listen for the 'creating' event to set default values before a user is created
        // static::creating(function ($riderData) {
        //     // dd($riderData);
        //    $rider = self::find($riderData->id);

        //     $riderSnapShot = new RiderSnapshot();
        //     //copy all $riders values to rider_snapshot except the id
        //     $riderSnapShot->fill($rider->toArray());
        //     // dd( $riderSnapShot->toArray());
        //     $riderSnapShot->rider_id = $rider->id;
        //     $riderSnapShot->save();

        //     $riderData->rider_snapshot_id = $riderSnapShot->id;


        // });

        static::creating(function ($user) {
            $code = $user->code ?? Str::slug(static::setUnAttribute());
            $user->attributes['code'] = $code;

        });
        static::updating(function ($user) {
            if (empty($user->code)) {
                $user->code = Str::slug(static::setUnAttribute());
            }
        });

    }

    // protected static function setUsernameAttribute($value)
    protected static function setUnAttribute()
    {


        do {
            // Generate a random number
            $randomNumber = str_pad(mt_rand(1, 999999), 4, '0', STR_PAD_LEFT);
            // Append the random number to the base username
            $code = $randomNumber;
            // Check if the newly generated username exists
            $count = Rider::where('code', $code)->count();
        } while ($count > 0); // Loop until a unique username is found

        return $code;
    }

}
