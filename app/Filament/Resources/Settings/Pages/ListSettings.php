<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Models\Setting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        $setting = Setting::first();
        if ($setting) {
            redirect()->route('filament.admin.resources.settings.edit', [
                'record' => $setting->getKey(),
            ]);
        }
        else{
            redirect()->route('filament.admin.resources.settings.create');
        }
    }

}
