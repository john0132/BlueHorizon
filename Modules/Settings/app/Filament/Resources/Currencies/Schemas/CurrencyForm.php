<?php

namespace Modules\Settings\Filament\Resources\Currencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Toggle::make('is_active')
                        ->label('Active')
                        ->required(),
                    Toggle::make('is_default')
                        ->label('Default Currency')
                        ->required(),
                    TextInput::make('code')
                        ->required(),
                    TextInput::make('symbol')
                        ->required(),
                    TextInput::make('rate')
                        ->required()
                        ->numeric()
                        ->default(1),

                ])->columnSpan(1),

            ])->columns(2);
    }
}
