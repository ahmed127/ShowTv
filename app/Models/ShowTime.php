<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowTime extends Model
{
    use HasFactory;

    protected $tables = 'show_times';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'show_id',
        'day',
        'hour',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'show_id'   => 'integer',
        'day'       => 'string',
        'hour'      => 'string'
    ];

    public $timestamps = false;

}
