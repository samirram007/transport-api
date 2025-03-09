<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressTypeEnum;
use App\Enums\CasteEnum;
use App\Enums\GenderEnum;
use App\Enums\GuardianTypeEnum;
use App\Enums\LanguageEnum;
use App\Enums\NationalityEnum;
use App\Enums\ReligionEnum;
use App\Enums\RiderTypeEnum;
use App\Enums\RoomTypeEnum;
use App\Enums\SchoolTimeEnum;
use App\Enums\SectionEnum;
use App\Enums\SlotTypeEnum;
use App\Enums\StandardEnum;
use App\Enums\SubjectTypeEnum;
use App\Enums\UserStatusEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use PhpParser\PrettyPrinter\Standard;

class EnumController extends Controller
{
    public function address_type()
    {
        return response()->json(['data' => AddressTypeEnum::dataLabels()]);
    }
    public function gender()
    {
        return response()->json(['data' => GenderEnum::dataLabels()]);
    }
    public function nationality()
    {
        return response()->json(['data' => NationalityEnum::dataLabels()]);
    }
    public function language()
    {
        return response()->json(['data' => LanguageEnum::dataLabels()]);
    }
    public function religion()
    {
        return response()->json(['data' => ReligionEnum::dataLabels()]);
    }
    public function caste()
    {
        return response()->json(['data' => CasteEnum::dataLabels()]);
    }
    public function guardian_type()
    {
        return response()->json(['data' => GuardianTypeEnum::dataLabels()]);
    }
    public function subject_type()
    {
        return response()->json(['data' => SubjectTypeEnum::dataLabels()]);
    }
    public function room_type()
    {
        return response()->json(['data' => RoomTypeEnum::dataLabels()]);
    }
    public function user_status()
    {
        return response()->json(['data' => UserStatusEnum::dataLabels()]);
    }
    public function user_type()
    {
        return response()->json(['data' => UserTypeEnum::dataLabels()]);
    }
    public function slot_type()
    {
        return response()->json(['data' => SlotTypeEnum::dataLabels()]);
    }
    public function standard()
    {
        return response()->json(['data' => StandardEnum::dataLabels()]);
    }
    public function rider_type()
    {
        return response()->json(['data' => RiderTypeEnum::dataLabels()]);
    }
    public function section()
    {
        return response()->json(['data' => SectionEnum::dataLabels()]);
    }
    public function school_time()
    {
        return response()->json(['data' => SchoolTimeEnum::dataLabels()]);
    }
}
