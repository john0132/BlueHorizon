<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Models\Country;
use Modules\Settings\Models\CountryTranslation;
use Modules\Settings\Models\Language;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Define base countries
            $countries = [
                [
                    'code' => 'EG',
                    'flag' => null,
                    'phone_code' => '20',
                    'translations' => [
                        'en' => 'Egypt',
                        'ar' => 'مصر',
                        'de' => 'Ägypten',
                    ],
                ],
                [
                    'code' => 'US',
                    'flag' => null,
                    'phone_code' => '1',
                    'translations' => [
                        'en' => 'United States',
                        'ar' => 'الولايات المتحدة',
                        'de' => 'Vereinigte Staaten',
                    ],
                ],
                [
                    'code' => 'DE',
                    'flag' => null,
                    'phone_code' => '49',
                    'translations' => [
                        'en' => 'Germany',
                        'ar' => 'ألمانيا',
                        'de' => 'Deutschland',
                    ],
                ],
            ];

            // Load available languages keyed by locale
            $languages = Language::query()->get(['id', 'locale'])->keyBy('locale');

            foreach ($countries as $c) {
                // Create or fetch country by code
                $country = Country::query()->firstOrCreate(
                    ['code' => $c['code']],
                    [
                        'flag' => $c['flag'],
                        'phone_code' => $c['phone_code'],
                    ]
                );

                // Create translations only for existing languages
                foreach ($languages as $locale => $lang) {
                    $name = $c['translations'][$locale] ?? $c['translations']['en'] ?? null;
                    if (!$name) {
                        continue;
                    }

                    CountryTranslation::query()->firstOrCreate(
                        [
                            'language_id' => $lang->id,
                            'country_id' => $country->id,
                        ],
                        [
                            'name' => $name,
                        ]
                    );
                }
            }
        });
    }
}
