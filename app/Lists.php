<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['list_title', 'list_notes', 'added_by'];

    public $with = ['user'];

    public function user() {
        return $this->belongsTo('App\User', 'added_by');
    }
}
