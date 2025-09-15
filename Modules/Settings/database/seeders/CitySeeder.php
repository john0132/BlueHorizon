<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Models\City;
use Modules\Settings\Models\Country;
use Modules\Settings\Models\Language;
use Modules\Settings\Models\Translations\CityTranslation;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Predefined cities per country code
            $data = [
                'EG' => [
                    [
                        'shipping_rate' => 10.0,
                        'translations' => [
                            'en' => 'Alexandria',
                            'ar' => 'الإسكندرية',
                            'de' => 'Alexandria',
                        ],
                    ],
                    [
                        'shipping_rate' => 12.5,
                        'translations' => [
                            'en' => 'Port Said',
                            'ar' => 'بورسعيد',
                            'de' => 'Port Said',
                        ],
                    ],
                    [
                        'shipping_rate' => 11.0,
                        'translations' => [
                            'en' => 'Hurghada',
                            'ar' => 'الغردقة',
                            'de' => 'Hurghada',
                        ],
                    ],
                ],
                'US' => [
                    [
                        'shipping_rate' => 15.0,
                        'translations' => [
                            'en' => 'New York',
                            'ar' => 'نيويورك',
                            'de' => 'New York',
                        ],
                    ],
                    [
                        'shipping_rate' => 14.0,
                        'translations' => [
                            'en' => 'Los Angeles',
                            'ar' => 'لوس أنجلوس',
                            'de' => 'Los Angeles',
                        ],
                    ],
                    [
                        'shipping_rate' => 13.0,
                        'translations' => [
                            'en' => 'Chicago',
                            'ar' => 'شيكاغو',
                            'de' => 'Chicago',
                        ],
                    ],
                ],
                'DE' => [
                    [
                        'shipping_rate' => 9.0,
                        'translations' => [
                            'en' => 'Berlin',
                            'ar' => 'برلين',
                            'de' => 'Berlin',
                        ],
                    ],
                    [
                        'shipping_rate' => 9.5,
                        'translations' => [
                            'en' => 'Munich',
                            'ar' => 'ميونخ',
                            'de' => 'München',
                        ],
                    ],
                    [
                        'shipping_rate' => 8.5,
                        'translations' => [
                            'en' => 'Hamburg',
                            'ar' => 'هامبورغ',
                            'de' => 'Hamburg',
                        ],
                    ],
                ],
            ];

            // Languages keyed by locale
            $languages = Language::query()->get(['id', 'locale'])->keyBy('locale');

            foreach ($data as $countryCode => $cities) {
                $country = Country::query()->where('code', $countryCode)->first();
                if (!$country) {
                    continue; // Skip if country not seeded
                }

                foreach ($cities as $cityDef) {
                    // Pick a base locale available in both definition and DB languages
                    $baseLocale = null;
                    foreach (array_keys($cityDef['translations']) as $loc) {
                        if ($languages->has($loc)) {
                            $baseLocale = $loc;
                            break;
                        }
                    }

                    // If none match, just skip creating this city
                    if (!$baseLocale) {
                        continue;
                    }

                    $baseName = $cityDef['translations'][$baseLocale];
                    $baseLangId = $languages[$baseLocale]->id;

                    // Try to find existing city in this country by an existing translation match
                    $existingCity = City::query()
                        ->where('country_id', $country->id)
                        ->whereHas('translations', function ($q) use ($baseName, $baseLangId) {
                            $q->where('language_id', $baseLangId)->where('name', $baseName);
                        })
                        ->first();

                    if (!$existingCity) {
                        $existingCity = new City();
                        $existingCity->country_id = $country->id;
                        $existingCity->shipping_rate = (float) $cityDef['shipping_rate'];
                        $existingCity->save();
                    }

                    // Upsert translations for available languages only
                    foreach ($languages as $locale => $lang) {
                        $name = $cityDef['translations'][$locale] ?? $cityDef['translations']['en'] ?? null;
                        if (!$name) {
                            continue;
                        }

                        CityTranslation::query()->firstOrCreate(
                            [
                                'language_id' => $lang->id,
                                'city_id' => $existingCity->id,
                            ],
                            [
                                'name' => $name,
                            ]
                        );
                    }
                }
            }
        });
    }
}
