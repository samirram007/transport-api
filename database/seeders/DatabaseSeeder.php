<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\AddressTypeEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Country::create([
            'id' => 1,
            'name' => 'India',
            'code' => 'IN',
            'number_code' => 91,

        ]);
        \App\Models\State::create([
            'id' => 1,
            'name' => 'West Bengal',
            'code' => 'WB',
            'country_id' => 1,
            'number_code' => 26,

        ]);
        \App\Models\User::create([
            'name' => 'Admin User',
            'user_type' => UserTypeEnum::ADMIN,
            'username' => 'ADMIN00000',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::create([
            'name' => 'Manager User',
            'user_type' => UserTypeEnum::MANAGER,
            'username' => 'MANAGER000',
            'email' => 'manager@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\Address::create([
            'id' => 1,
            'address_type' => AddressTypeEnum::PERMANENT,
            'address_line_1' => 'Street 1',
            'address_line_2' => 'Street 2',
            'city' => 'Kolkata',
            'post_office' => 'Kolkata',
            'rail_station' => 'Kolkata',
            'pincode' => '700001',
            'state_id' => 1,
            'country_id' => 1,
        ]);
        \App\Models\Organization::create([
            'id' => 1,
            'name' => "Navajyoti Vidyapith Transport",
            'address_id' => 1
        ]);
        \App\Models\FiscalYear::create([
            'id' => 2025,
            'name' => "2025",
            'start_date' => '2025-04-01',
            'end_date' => '2026-03-31',
            'is_active' => true,
            'is_current' => true,
        ]);
        \App\Models\School::create([
            'id' => 1,
            'name' => "Navajyoti Vidyapith",
            'address_id' => 1
        ]);
        \App\Models\School::create([
            'id' => 2,
            'name' => "NAVA PRABHAT SHISHU SHIKHSHA NIKITEN",
            'address_id' => 1
        ]);
        \App\Models\UserInitialValue::create([
            'id' => 2,
            'user_id' => 1,
            'key' => "fiscalYearId",
            'value' => 2025
        ]);
        \App\Models\VehicleType::create([
            'id' => 1,
            'name' => "Bus",
        ]);
        \App\Models\Vehicle::create([
            'id' => 1,
            'name' => "School Bus",
            'vehicle_type_id' => 1,
        ]);
        \App\Models\Slot::create([
            'id' => 1,
            'name' => "Morning Slot",
            'vehicle_id' => 1,
            'slot_type' => 'pickup',
            'capacity' => 50,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);
        \App\Models\Slot::create([
            'id' => 2,
            'name' => "Day Slot",
            'vehicle_id' => 1,
            'slot_type' => 'pickup',
            'capacity' => 50,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);
        \App\Models\Rider::create([
            'id' => 1,
            'rider_snapshot_id' => 1,
            'name' => "Rider 1",
            'school_id' => 1,
            'vehicle_id' => 1,
            'standard' => 'nursery1',
            'section' => 'a',
            'roll_no' => '1',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 500,
        ]);
        \App\Models\RiderSnapshot::create([
            'id' => 1,
            'rider_id' => 1,
            'name' => "Rider 1",
            'school_id' => 1,
            'vehicle_id' => 1,
            'standard' => 'nursery1',
            'section' => 'a',
            'roll_no' => '1',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 500,
        ]);

        \App\Models\Rider::create([
            'id' => 2,
            'rider_snapshot_id' => 2,
            'name' => "Student 2",
            'school_id' => 2,
            'vehicle_id' => 1,
            'standard' => 'one',
            'section' => 'a',
            'roll_no' => '12',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 1000,
        ]);
        \App\Models\RiderSnapshot::create([
            'id' => 2,
            'rider_id' => 2,
            'name' => "Student 2",
            'school_id' => 2,
            'vehicle_id' => 1,
            'standard' => 'one',
            'section' => 'a',
            'roll_no' => '12',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 1000,
        ]);

        \App\Models\Rider::create([
            'id' => 3,
            'rider_snapshot_id'=> 3,
            'name' => "Student Das",
            'school_id' => 1,
            'vehicle_id' => 1,
            'standard' => 'two',
            'section' => 'a',
            'roll_no' => '17',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 700,
        ]);
        \App\Models\RiderSnapshot::create([
            'id' => 3,
            'rider_id' => 3,
            'name' => "Student Das",
            'school_id' => 1,
            'vehicle_id' => 1,
            'standard' => 'two',
            'section' => 'a',
            'roll_no' => '17',
            'pickup_slot_id' => 1,
            'drop_slot_id' => 2,
            'monthly_charge' => 700,
        ]);
        \App\Models\IncomeGroup::create([
            'id' => 1,
            'name' => "Direct Income",
        ]);
        \App\Models\IncomeGroup::create([
            'id' => 2,
            'name' => "Indirect Income",
        ]);
        \App\Models\FeeHead::create([
            'id' => 1,
            'name' => "Transport Fee",
            'income_group_id' => 1,
        ]);
        \App\Models\FeeHead::create([
            'id' => 2,
            'name' => "Penalty Fee",
            'income_group_id' => 2,
        ]);
        \App\Models\Fee::create([
            'id' => 1,
            'fee_no' => "1001",
            'fee_date' => '2025-03-01',
            'rider_id' => 1,
            'rider_snapshot_id' => 1,
            'fiscal_year_id' => 2025,
            'total_amount' => 700,
            'paid_amount' => 700,
            'balance_amount' => 0,
            'payment_mode' => 'cash',
        ]);
        \App\Models\FeeItem::create([
            'id' => 1,
            'fee_id' => 1,
            'fee_head_id' => 1,
            'quantity' => 1,
            'amount' => 700,
            'total_amount' => 700,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 1,
            'fee_id' => 1,
            'rider_id' => 1,
            'fee_item_id' => 1,
            'year' => 2025,
            'month_id' => 1,
            'amount' => 700,
        ]);


        \App\Models\Fee::create([
            'id' => 2,
            'fee_no' => "1002",
            'fee_date' => '2025-03-02',
            'rider_id' => 2,
            'rider_snapshot_id' => 2,
            'fiscal_year_id' => 2025,
            'total_amount' => 2000,
            'paid_amount' => 2000,
            'balance_amount' => 0,
            'payment_mode' => 'cash',
        ]);

        \App\Models\FeeItem::create([
            'id' => 2,
            'fee_id' => 2,
            'fee_head_id' => 1,
            'quantity' => 2,
            'amount' => 1000,
            'total_amount' => 2000,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 2,
            'fee_id' => 2,
            'rider_id' => 2,
            'fee_item_id' => 2,
            'year' => 2025,
            'month_id' => 1,
            'amount' => 1000,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 3,
            'fee_id' => 2,
            'rider_id' => 2,
            'fee_item_id' => 2,
            'year' => 2025,
            'month_id' => 2,
            'amount' => 1000,
        ]);

        \App\Models\Fee::create([
            'id' => 3,
            'fee_no' => "1003",
            'fee_date' => '2025-03-05',
            'rider_id' => 3,
            'rider_snapshot_id' => 3,
            'fiscal_year_id' => 2025,
            'total_amount' => 2100,
            'paid_amount' => 2100,
            'balance_amount' => 0,
            'payment_mode' => 'cash',
        ]);

        \App\Models\FeeItem::create([
            'id' => 3,
            'fee_id' => 3,
            'fee_head_id' => 1,
            'quantity' => 3,
            'amount' => 700,
            'total_amount' => 2100,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 4,
            'fee_id' => 3,
            'rider_id' => 3,
            'fee_item_id' => 3,
            'year' => 2025,
            'month_id' => 1,
            'amount' => 700,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 5,
            'fee_id' => 3,
            'rider_id' => 3,
            'fee_item_id' => 3,
            'year' => 2025,
            'month_id' => 2,
            'amount' => 700,
        ]);
        \App\Models\FeeItemMonth::create([
            'id' => 6,
            'fee_id' => 3,
            'rider_id' => 3,
            'fee_item_id' => 3,
            'year' => 2025,
            'month_id' => 3,
            'amount' => 700,
        ]);

        \App\Models\ExpenseGroup::create([
            'id' => 1,
            'name' => "Direct Expense",
        ]);
        \App\Models\ExpenseGroup::create([
            'id' => 2,
            'name' => "Indirect Expense",
        ]);
        \App\Models\ExpenseHead::create([
            'id' => 1,
            'name' => "Salary",
            'expense_group_id' => 1,
        ]);
        \App\Models\ExpenseHead::create([
            'id' => 2,
            'name' => "Bus Maintenance",
            'expense_group_id' => 2,

        ]);

        \App\Models\Expense::create([
            'id' => 1,
            'expense_no' => "E01001",
            'voucher_no' => "E01001",
            'expense_date' => '2025-03-01',
            'fiscal_year_id' => 2025,
            'total_amount' => 700,
            'payment_mode' => 'cash',
            'note'=>'Seeding Note 1'
        ]);
        \App\Models\ExpenseItem::create([
            'id' => 1,
            'expense_id' => 1,
            'expense_head_id' => 1,
            'amount' => 700,
        ]);
        \App\Models\Expense::create([
            'id' => 2,
            'expense_no' => "E01002",
            'voucher_no' => "E01002",
            'expense_date' => '2025-03-04',
            'fiscal_year_id' => 2025,
            'total_amount' => 2000,
            'payment_mode' => 'cash',
            'note'=>'Seeding Note 2'

        ]);
        \App\Models\ExpenseItem::create([
            'id' => 2,
            'expense_id' => 2,
            'expense_head_id' => 2,
            'amount' => 2000,
        ]);


        $this->call([
            Data::class
        ]);


    }


}
