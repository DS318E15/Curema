<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }
}
