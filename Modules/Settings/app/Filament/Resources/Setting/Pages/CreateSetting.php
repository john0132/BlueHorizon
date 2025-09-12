<?php

namespace Modules\Settings\Filament\Resources\Setting\Pages;

use Modules\Settings\Filament\Resources\Setting\SettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Create'),
        ];
    }
}
