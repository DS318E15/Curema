<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Opportunity extends Model
{
    protected $guarded = [];

    public function change($type)
    {
        Change::create([
            "opportunity_id" => $this->id,
            "user_id" => Auth::user()->id,
            "type" => $type,
        ]);
    }

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change')->orderBy('updated_at', 'DESC')->take(5);
    }

    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }

    public function account()
    {
        return $this->belongsTo('Curema\Models\App\Account');
    }

    public function opportunityStage()
    {
        return $this->belongsTo('Curema\Models\App\OpportunityStage');
    }
}
