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

    public function opportunity()
    {
        return $this->belongsTo('Curema\Models\App\Opportunity');
    }

    public function contact()
    {
        return $this->belongsTo('Curema\Models\App\Contact');
    }

    public function ticket()
    {
        return $this->belongsTo('Curema\Models\App\Ticket');
    }

    public function call()
    {
        return $this->belongsTo('Curema\Models\App\Call');
    }

    public function email()
    {
        return $this->belongsTo('Curema\Models\App\Email');
    }
}
