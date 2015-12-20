<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change')
            ->orderBy('updated_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User')
            ->withTrashed()
            ->orderBy('updated_at', 'DESC');
    }

    public function account()
    {
        return $this->belongsTo('Curema\Models\App\Account')
            ->withTrashed()
            ->orderBy('updated_at', 'DESC');
    }

    public function lead()
    {
        return $this->belongsTo('Curema\Models\App\Lead')
            ->withTrashed()
            ->orderBy('updated_at', 'DESC');
    }

    public function contact()
    {
        return $this->belongsTo('Curema\Models\App\Contact')
            ->withTrashed()
            ->orderBy('updated_at', 'DESC');
    }
}
