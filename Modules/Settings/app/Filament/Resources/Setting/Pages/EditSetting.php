<?php

namespace Modules\Settings\Filament\Resources\Setting\Pages;

use Modules\Settings\Filament\Resources\Setting\SettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
