<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('Curema\Models\User')->orderBy('updated_at', 'DESC');
    }

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change');
    }

}
