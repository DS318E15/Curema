<?php

namespace Curema\Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['price'];

    public function user()
    {
        return $this->belongsTo('Curema\Models\User');
    }
}
