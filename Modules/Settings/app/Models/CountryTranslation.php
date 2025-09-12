<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\CountryTranslationFactory;

class CountryTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name'
    ];

    // protected static function newFactory(): CountryTranslationFactory
    // {
    //     // return CountryTranslationFactory::new();
    // }
}
