<?php

namespace App\Enums;

enum SchoolTimeEnum: string
{
    case MORNING = 'morning';
    case DAY = 'day';


    public function label(): string
    {
        return match ($this) {
         self::DAY => 'Day',
         self::MORNING => 'Morning',
        };
    }

    public static function default(): string
    {
        return SchoolTimeEnum::MORNING->value;
    }

    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($items, SchoolTimeEnum $item) {
            $items[$item->value] = $item->label();

            return $items;
        }, []);
    }

    public static function dataLabels(): array
    {
        return array_reduce(self::cases(), function ($items, SchoolTimeEnum $item) {
            $items[$item->value] = $item->name;

            return $items;
        }, []);
    }
}
