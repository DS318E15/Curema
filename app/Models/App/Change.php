<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo('Curema\Models\App\Account')
            ->withTrashed();
    }

    public function call()
    {
        return $this->belongsTo('Curema\Models\App\Call')
            ->withTrashed();
    }

    public function contact()
    {
        return $this->belongsTo('Curema\Models\App\Contact')
            ->withTrashed();
    }

    public function email()
    {
        return $this->belongsTo('Curema\Models\App\Email')
            ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User')
            ->withTrashed();
    }

    public function lead()
    {
        return $this->belongsTo('Curema\Models\App\Lead')
            ->withTrashed();
    }

    public function opportunity()
    {
        return $this->belongsTo('Curema\Models\App\Opportunity')
            ->withTrashed();
    }

    public function ticket()
    {
        return $this->belongsTo('Curema\Models\App\Ticket')
            ->withTrashed();
    }
}
