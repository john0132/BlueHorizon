<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => 'EGP', 'symbol' => 'E£', 'rate' => 1, 'is_active' => true],
            ['code' => 'USD', 'symbol' => '$',  'rate' => 1, 'is_active' => true],
            ['code' => 'EUR', 'symbol' => '€',  'rate' => 1, 'is_active' => true],
        ];

        foreach ($currencies as $cur) {
            Currency::updateOrCreate(
                ['code' => $cur['code']],
                [
                    'symbol' => $cur['symbol'],
                    'rate' => $cur['rate'],
                    'is_active' => $cur['is_active'],
                ]
            );
        }
    }
}
