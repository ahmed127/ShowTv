<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $tables = 'episodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'show_id',
        'thumbnail',
        'title',
        'description',
        'duration',
        'day',
        'hour',
        'video'
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
        'show_id'     => 'integer',
        'thumbnail'   => 'string',
        'title'       => 'string',
        'description' => 'string',
        'duration'    => 'string',
        'day'         => 'string',
        'hour'        => 'string',
        'video'       => 'string'
    ];

    public function setThumbnailAttribute($value)
    {
        $imageName = time().'.'.$value->extension();
        $path = public_path('uploads_images');
        $value->move($path, $imageName);

        $this->attributes['thumbnail'] = $imageName;
    }

    public function setVideoAttribute($value)
    {
        $videoName = time().'.'.$value->extension();

        $value->move(public_path('uploads_videos'), $videoName);

        $this->attributes['video'] = $videoName;
    }

    public function show()
    {
        return $this->belongsTo(Show::class, 'show_id', 'id');
    }

    public function rates()
    {
        return $this->hasMany(EpisodeRate::class);
    }

    public function likes()
    {
        return $this->hasMany(EpisodeRate::class)->where('type', 1);
    }

    public function dislikes()
    {
        return $this->hasMany(EpisodeRate::class)->where('type', 0);
    }
}
