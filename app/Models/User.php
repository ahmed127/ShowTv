<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $tables = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'email',
        'wallet',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setImageAttribute($value)
    {
        $imageName = time().'.'.$value->extension();

        $value->move(public_path('uploads_images'), $imageName);

        $this->attributes['image'] = $imageName;
    }

    public function setPasswordAttribute($value)
    {
    	if ($value) $this->attributes['password'] = bcrypt($value);
    }

    public function getMyMoneyAttribute($value)
    {
        return $this->wallet + optional($this->gift)->amount??0;
    }

    public function gift()
    {
        return $this->hasOne(Gift::class)->where('expired_at', '>=', now());
    }

    /**
     * The purchases that belong to the user.
     */
    public function purchases()
    {
        return $this->belongsToMany(Show::class, 'purchases', 'user_id', 'show_id');
    }

}
