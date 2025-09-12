<?php

namespace Modules\Settings\Filament\Resources\Countries\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Settings\Filament\Resources\Countries\CountryResource;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;
}
