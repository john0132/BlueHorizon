<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Settings\Models\Translations\CountryTranslation;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'flag',
        'phone_code',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(CountryTranslation::class);
    }
    public function translation(): HasOne
    {
        $contentLocale = session('content_locale', config('app.locale'));
        return $this->hasOne(CountryTranslation::class)
            ->where('language_id', function ($query) use ($contentLocale) {
                $query->select('id')
                    ->from('languages')
                    ->where('locale', $contentLocale);
            });
    }

}
