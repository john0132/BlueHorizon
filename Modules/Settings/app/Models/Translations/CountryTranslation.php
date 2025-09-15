<?php

namespace Modules\Settings\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Settings\Database\Factories\CountryTranslationFactory;

class CountryTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'language_id',
        'country_id',
    ];

    // protected static function newFactory(): CountryTranslationFactory
    // {
    //     // return CountryTranslationFactory::new();
    // }
}
