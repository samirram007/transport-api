<?php
namespace App\Enums;

enum SectionEnum: string {

    case A = 'a';
    case B = 'b';

    public function label(): string
    {
        return match ($this) {
            self::A => 'A',
            self::B => 'B',
        };
    }
    public static function default(): string
    {
        return SectionEnum::A->value;
    }
    public static function labels(): array
    {
        return array_reduce(self::cases(), function ($items, SectionEnum $item) {
            $items[$item->value] = $item->name;
            return $items;
        }, []);
    }
    public static function dataLabels(): array
    {
        return array_reduce(self::cases(), function ($items, SectionEnum $item) {
            $items[$item->value] = $item->name;
            // $items[$item->label()] = $item->name;
            return $items;
        }, []);
    }
}
