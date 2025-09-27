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
            ['name' => 'Egyptian Pound','code' => 'EGP', 'symbol' => 'E£', 'rate' => 1, 'is_active' => true],
            ['name' => 'United States Dollar','code' => 'USD', 'symbol' => '$',  'rate' => 1, 'is_active' => true],
            ['name' => 'Euro','code' => 'EUR', 'symbol' => '€',  'rate' => 1, 'is_active' => true],
        ];

        foreach ($currencies as $cur) {
            Currency::updateOrCreate(
                [
                'code' => $cur['code'],
                'name' => $cur['name']
                ],
                [
                    'symbol' => $cur['symbol'],
                    'rate' => $cur['rate'],
                    'is_active' => $cur['is_active'],
                ]
            );
        }
    }
}
