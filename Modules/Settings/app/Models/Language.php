<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
      'locale',
      'name',
      'is_active'
    ];
}
