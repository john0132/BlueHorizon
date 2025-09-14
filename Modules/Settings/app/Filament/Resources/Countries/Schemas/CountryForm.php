<?php

namespace Modules\Settings\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    Group::make()
                        ->relationship('translation')
                        ->schema([
                            TextInput::make('name')->required(),
                    ]),
                    TextInput::make('code')->required(),
                    TextInput::make('flag'),
                    TextInput::make('phone_code'),
                ])->columnSpan(1)
            ])->columns(2);
    }
}
