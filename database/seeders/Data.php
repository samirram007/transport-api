<?php
namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;
class Data extends Seeder
{
    public function run()
    {

        $months = array(
            array(
                "id" => 1,
                "name" => "January",
                "short_name" => "JAN",
                "number" => 1,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => "2024-06-06 08:20:03",
                "updated_at" => "2024-06-06 08:20:04",
            ),
            array(
                "id" => 2,
                "name" => "February",
                "short_name" => "FEB",
                "number" => 2,
                "no_of_days" => 28,
                "is_february" => 1,
                "created_at" => "2024-06-06 08:20:03",
                "updated_at" => "2024-06-06 08:20:04",
            ),
            array(
                "id" => 3,
                "name" => "March",
                "short_name" => "MAR",
                "number" => 3,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => "2024-06-06 08:20:03",
                "updated_at" => "2024-06-06 08:20:04",
            ),
            array(
                "id" => 4,
                "name" => "April",
                "short_name" => "APR",
                "number" => 4,
                "no_of_days" => 30,
                "is_february" => 0,
                "created_at" => "2024-06-06 08:20:03",
                "updated_at" => "2024-06-06 08:20:04",
            ),
            array(
                "id" => 5,
                "name" => "May",
                "short_name" => "MAY",
                "number" => 5,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 6,
                "name" => "June",
                "short_name" => "JUN",
                "number" => 6,
                "no_of_days" => 30,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 7,
                "name" => "July",
                "short_name" => "JUL",
                "number" => 7,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 8,
                "name" => "August",
                "short_name" => "AUG",
                "number" => 8,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 9,
                "name" => "September",
                "short_name" => "SEP",
                "number" => 9,
                "no_of_days" => 30,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 10,
                "name" => "October",
                "short_name" => "OCT",
                "number" => 10,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 11,
                "name" => "November",
                "short_name" => "NOV",
                "number" => 11,
                "no_of_days" => 30,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
            array(
                "id" => 12,
                "name" => "December",
                "short_name" => "DEC",
                "number" => 12,
                "no_of_days" => 31,
                "is_february" => 0,
                "created_at" => null,
                "updated_at" => null,
            ),
        );

        foreach ($months as $month) {
            Month::updateOrCreate(
                [
                    'id' => $month['id'],
                ],
                $month
            );
        }
    }
}
// Compare this snippet from database/migrations/2024_03_12_212203_create_months_table.php:
