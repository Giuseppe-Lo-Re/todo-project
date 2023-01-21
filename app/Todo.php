<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'order_position',
        'description',
        'user_id'
    ];

    // Define relation type
    public function user() {

        return $this->belongsTo('App\User');
    }
}
