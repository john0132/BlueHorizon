<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Models\Area;
use Modules\Settings\Models\City;
use Modules\Settings\Models\Language;
use Modules\Settings\Models\Translations\AreaTranslation;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Define 3 default areas per city with sample rates and translations
            $areasTemplate = [
                [
                    'rate' => 5.0,
                    'translations' => [
                        'en' => 'Downtown',
                        'ar' => 'وسط البلد',
                        'de' => 'Stadtzentrum',
                    ],
                ],
                [
                    'rate' => 4.0,
                    'translations' => [
                        'en' => 'Suburbs',
                        'ar' => 'الضواحي',
                        'de' => 'Vororte',
                    ],
                ],
                [
                    'rate' => 6.0,
                    'translations' => [
                        'en' => 'Industrial Zone',
                        'ar' => 'المنطقة الصناعية',
                        'de' => 'Industriegebiet',
                    ],
                ],
            ];

            // Languages keyed by locale (only active languages are considered if such a column exists)
            $languages = Language::query()->get(['id', 'locale'])->keyBy('locale');

            // Iterate all cities and ensure 3 areas each
            $cities = City::query()->get(['id']);
            foreach ($cities as $city) {
                foreach ($areasTemplate as $areaDef) {
                    // Choose a base locale present in both template and DB
                    $baseLocale = null;
                    foreach (array_keys($areaDef['translations']) as $loc) {
                        if ($languages->has($loc)) {
                            $baseLocale = $loc;
                            break;
                        }
                    }

                    if (!$baseLocale) {
                        // No matching language in DB; skip this area for this city
                        continue;
                    }

                    $baseName = $areaDef['translations'][$baseLocale];
                    $baseLangId = $languages[$baseLocale]->id;

                    // Find existing area in this city by matching an existing translation
                    $area = Area::query()
                        ->where('city_id', $city->id)
                        ->whereHas('translations', function ($q) use ($baseName, $baseLangId) {
                            $q->where('language_id', $baseLangId)->where('name', $baseName);
                        })
                        ->first();

                    if (!$area) {
                        $area = new Area();
                        $area->city_id = $city->id;
                        $area->rate = (float) $areaDef['rate'];
                        $area->save();
                    }

                    // Upsert translations for available languages only
                    foreach ($languages as $locale => $lang) {
                        $name = $areaDef['translations'][$locale] ?? $areaDef['translations']['en'] ?? null;
                        if (!$name) {
                            continue;
                        }

                        AreaTranslation::query()->firstOrCreate(
                            [
                                'language_id' => $lang->id,
                                'area_id' => $area->id,
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
