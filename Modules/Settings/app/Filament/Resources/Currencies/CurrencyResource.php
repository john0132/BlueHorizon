<?php

namespace Modules\Settings\Filament\Resources\Currencies;

use Modules\Settings\Filament\Resources\Currencies\Pages\CreateCurrency;
use Modules\Settings\Filament\Resources\Currencies\Pages\EditCurrency;
use Modules\Settings\Filament\Resources\Currencies\Pages\ListCurrencies;
use Modules\Settings\Filament\Resources\Currencies\Schemas\CurrencyForm;
use Modules\Settings\Filament\Resources\Currencies\Tables\CurrenciesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Modules\Settings\Models\Currency;
use UnitEnum;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrenciesTable::configure($table);
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
            'index' => ListCurrencies::route('/'),
            'create' => CreateCurrency::route('/create'),
            'edit' => EditCurrency::route('/{record}/edit'),
        ];
    }
}
