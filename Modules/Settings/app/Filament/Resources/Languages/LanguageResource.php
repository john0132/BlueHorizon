<?php

namespace Modules\Settings\Filament\Resources\Languages;


use App\Filament\Resources\Languages\Schemas\LanguageForm;
use Modules\Settings\Filament\Resources\Languages\Pages\CreateLanguage;
use Modules\Settings\Filament\Resources\Languages\Tables\LanguagesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Settings\Filament\Resources\Languages\Pages\EditLanguage;
use Modules\Settings\Filament\Resources\Languages\Pages\ListLanguages;
use Modules\Settings\Models\Language;
use UnitEnum;

class LanguageResource extends Resource
{
    protected static ?string $model = Language::class;
    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLanguage;

    protected static ?string $recordTitleAttribute = 'Language';

    protected static ?int $navigationSort = 2 ;

    public static function form(Schema $schema): Schema
    {
        return LanguageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LanguagesTable::configure($table);
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
            'index' => ListLanguages::route('/'),
            'create' => CreateLanguage::route('/create'),
            'edit' => EditLanguage::route('/{record}/edit'),
        ];
    }
}
