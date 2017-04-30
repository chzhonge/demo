<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Question extends Model
{
    protected $table = 'questions';

    public $timestamps = false;

    protected $fillable = [
        'question', 'played'
    ];
}
