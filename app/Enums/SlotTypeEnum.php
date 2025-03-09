<?php
namespace App\Enums;


enum SlotTypeEnum:string
{
    case PICKUP = 'pickup';
    case DROP='drop';

    public function label(): string
    {
        return match($this){
            self::PICKUP => 'Pickup',
            self::DROP => 'Drop',

        };
    }
    public static function default(): string
    {
        return  SlotTypeEnum::PICKUP->value;
    }
    public static function labels():array
    {
        return array_reduce(self::cases(),function($items, SlotTypeEnum $item){
            $items[$item->value] = $item->label();
            return $items;
        },[]);
    }
    public static function dataLabels():array
    {
        return array_reduce(self::cases(),function($items, SlotTypeEnum $item){
            $items[$item->value] = $item->name;
            return $items;
        },[]);
    }
}

