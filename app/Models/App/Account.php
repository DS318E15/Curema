<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }
}
