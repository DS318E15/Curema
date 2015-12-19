<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo('Curema\Models\App\Account');
    }

    public function call()
    {
        return $this->belongsTo('Curema\Models\App\Call');
    }

    public function contact()
    {
        return $this->belongsTo('Curema\Models\App\Contact');
    }

    public function email()
    {
        return $this->belongsTo('Curema\Models\App\Email');
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }

    public function lead()
    {
        return $this->belongsTo('Curema\Models\App\Lead');
    }

    public function opportunity()
    {
        return $this->belongsTo('Curema\Models\App\Opportunity');
    }

    public function ticket()
    {
        return $this->belongsTo('Curema\Models\App\Ticket');
    }
}
