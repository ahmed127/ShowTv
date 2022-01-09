<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $tables = 'shows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'price',
        'status'
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
        'type'          => 'integer',
        'title'         => 'string',
        'description'   => 'string',
        'price'         => 'integer',
        'status'        => 'integer',
    ];

    public function getTypeNameAttribute()
    {
        return $this->type == 1? 'Series': 'TV';
    }

    public function getStatusNameAttribute()
    {
        return $this->status == 1? 'Active':'Inactive';
    }

    public function getAmountAttribute()
    {
        return $this->price < 1? 'Free': $this->price . ' $';
    }

    /**
     * The episodes that belong to the user.
     */
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function times()
    {
        return $this->hasMany(ShowTime::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'show_followers', 'show_id', 'user_id');
    }

}
