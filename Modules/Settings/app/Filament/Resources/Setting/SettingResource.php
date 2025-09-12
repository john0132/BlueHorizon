<?php

namespace Modules\Settings\Filament\Resources\Setting;

use Modules\Settings\Filament\Resources\Setting\Pages\CreateSetting;
use Modules\Settings\Filament\Resources\Setting\Pages\EditSetting;
use Modules\Settings\Filament\Resources\Setting\Pages\ListSettings;
use Modules\Settings\Filament\Resources\Setting\Schemas\SettingForm;
use Modules\Settings\Filament\Resources\Setting\Tables\SettingsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Settings\Models\Setting;
use UnitEnum;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $recordTitleAttribute = 'Setting';

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
