<?php

namespace Modules\Settings\Filament\Resources\Currencies\Pages;

use Modules\Settings\Filament\Resources\Currencies\CurrencyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCurrency extends CreateRecord
{
    protected static string $resource = CurrencyResource::class;
}
