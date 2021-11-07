<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table='event';

    protected $fillable = [
        'longitude',
        'latitude',
        'event_date',
        'created_by',
        'name'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'event_date'
    ];

    public function playlists(){
        return $this->belongsToMany(Playlists::class,'event_playlists','event_id','playlist_id')->with(['songs']);
    }
}
