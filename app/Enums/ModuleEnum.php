<?php

namespace App\Enums;

enum ModuleEnum: string
{
    case USER = 'user';
    case GUEST = 'guest';
    case HOSTEL = 'hostel';

    public function label(): string
    {
        return match ($this) {
            self::USER => 'User',
            self::GUEST => 'Guest',
            self::HOSTEL => 'Hostel',

        };
    }

    public static function default(): string
    {
        return ModuleEnum::USER->value;
    }

    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($items, ModuleEnum $item) {
            $items[$item->value] = $item->name;

            return $items;
        }, []);
    }

    public static function dataLabels(): array
    {
        return array_reduce(self::cases(), function ($items, ModuleEnum $item) {
            $items[$item->value] = $item->name;

            return $items;
        }, []);
    }
}
