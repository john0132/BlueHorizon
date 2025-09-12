<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable =
        [
            'code',
            'symbol',
            'rate',
            'is_default',
            'is_active'
        ];
}
