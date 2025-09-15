<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Settings\Models\Translations\CityTranslation;

// use Modules\Settings\Database\Factories\CityFactory;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];


    public function translations(): HasMany
    {
        return $this->hasMany(CityTranslation::class);
    }
    public function translation(): HasOne
    {
        $contentLocale = session('content_locale', config('app.locale'));
        return $this->hasOne(CityTranslation::class)
            ->where('language_id', function ($query) use ($contentLocale) {
                $query->select('id')
                    ->from('languages')
                    ->where('locale', $contentLocale);
            });
    }
}
