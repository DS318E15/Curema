<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $guarded = [];

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change')->orderBy('updated_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User')->orderBy('updated_at', 'DESC');;
    }

    public function account()
    {
        return $this->belongsTo('Curema\Models\App\Account')->orderBy('updated_at', 'DESC');;
    }

    public function opportunityStage()
    {
        return $this->belongsTo('Curema\Models\App\OpportunityStage')->orderBy('updated_at', 'DESC');;
    }
}
