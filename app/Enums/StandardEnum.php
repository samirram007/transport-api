<?php
namespace App\Enums;

enum StandardEnum: string {

    case Nursery1 = 'nursery1';
    case Nursery2 = 'nursery2';
    case LKG = 'lkg';
    case UKG = 'ukg';
    case One = 'one';
    case Two = 'two';
    case Three = 'three';
    case Four = 'four';
    case Five = 'five';
    case Six = 'six';
    case Seven = 'seven';
    case Eight = 'eight';
    case Nine = 'nine';
    case Ten = 'ten';



    public function label(): string
    {
        return match ($this) {
            self::Nursery1 => 'Nursery 1',
            self::Nursery2 => 'Nursery 2',
            self::LKG => 'LKG',
            self::UKG => 'UKG',
            self::One => 'One',
            self::Two => 'Two',
            self::Three => 'Three',
            self::Four => 'Four',
            self::Five => 'Five',
            self::Six => 'Six',
            self::Seven => 'Seven',
            self::Eight => 'Eight',
            self::Nine => 'Nine',
            self::Ten => 'Ten',
        };
    }
    public static function default(): string
    {
        return StandardEnum::Nursery1->value;
    }
    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($items, StandardEnum $item) {
            $items[$item->value] = $item->name;
            return $items;
        }, []);
    }
    public static function dataLabels(): array
    {
        return array_reduce(self::cases(), function ($items, StandardEnum $item) {
            $items[$item->value] = $item->name;
            // $items[$item->label()] = $item->name;
            return $items;
        }, []);
    }
}
