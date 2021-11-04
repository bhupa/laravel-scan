<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $tabl ='songs';

    protected $fillable=[
        'playlist_id',
        'unique_id',
        'status',
        'name'
    ];

    public function playlist(){
        return $this->belongsTo(PlayLists::class,'playlist_id');
    }
}
