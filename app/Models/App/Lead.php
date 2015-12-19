<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change')->orderBy('updated_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }
}
