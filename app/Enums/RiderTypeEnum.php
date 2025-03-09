<?php

namespace App\Enums;

enum RiderTypeEnum: string
{
    case STUDENT = 'student';
    case GUARDIAN = 'guardian';
    case TEACHER = 'teacher';
    case EMPLOYEE = 'employee';

    public function label(): string
    {
        return match ($this) {
            self::STUDENT => 'Student',
            self::GUARDIAN => 'Guardian',
            self::TEACHER => 'Teacher',
            self::EMPLOYEE => 'Employee',
        };
    }

    public static function default(): string
    {
        return RiderTypeEnum::STUDENT->value;
    }

    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($items, RiderTypeEnum $item) {
            $items[$item->value] = $item->label();

            return $items;
        }, []);
    }

    public static function dataLabels(): array
    {
        return array_reduce(self::cases(), function ($items, RiderTypeEnum $item) {
            $items[$item->value] = $item->name;

            return $items;
        }, []);
    }
}
