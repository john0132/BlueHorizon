<?php

namespace Modules\Settings\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Settings\Database\Factories\AreaTranslationFactory;

class AreaTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AreaTranslationFactory
    // {
    //     // return AreaTranslationFactory::new();
    // }
}
