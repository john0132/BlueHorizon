<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'locale' => 'en', 'is_active' => true],
            ['name' => 'Arabic',  'locale' => 'ar', 'is_active' => true],
            ['name' => 'German',   'locale' => 'du', 'is_active' => true],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(
                ['locale' => $lang['locale']],
                ['name' => $lang['name'], 'is_active' => $lang['is_active']]
            );
        }
    }
}
