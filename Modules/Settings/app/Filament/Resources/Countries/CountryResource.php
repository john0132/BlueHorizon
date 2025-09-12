<?php

namespace Modules\Settings\Filament\Resources\Countries;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Settings\Filament\Resources\Countries\Pages\CreateCountry;
use Modules\Settings\Filament\Resources\Countries\Pages\EditCountry;
use Modules\Settings\Filament\Resources\Countries\Pages\ListCountries;
use Modules\Settings\Filament\Resources\Countries\Schemas\CountryForm;
use Modules\Settings\Filament\Resources\Countries\Tables\CountriesTable;
use Modules\Settings\Models\Country;
use UnitEnum;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
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
            'index' => ListCountries::route('/'),
            'create' => CreateCountry::route('/create'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
