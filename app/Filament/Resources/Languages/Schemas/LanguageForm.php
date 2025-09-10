<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Toggle::make('is_active')
                        ->required(),
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('locale')
                        ->required(),
                ])->columnSpan(1),

            ])->columns(2);
    }
}
