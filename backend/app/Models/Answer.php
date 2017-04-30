<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Answer extends Model
{
    protected $table = 'answers';

    public $timestamps = false;

    protected $fillable = [
        'answer', 'state', 'questionID'
    ];
}
