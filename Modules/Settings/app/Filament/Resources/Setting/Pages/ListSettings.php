<?php

namespace Modules\Settings\Filament\Resources\Setting\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Settings\Filament\Resources\Setting\SettingResource;
use Modules\Settings\Models\Setting;

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
            $this->redirect(SettingResource::getUrl('edit', [
                'record' => $setting->getKey(),
            ]));
        } else {
            $this->redirect(SettingResource::getUrl('create'));
        }
    }

}
