<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlayLists extends Model
{
    use HasFactory;

    protected $table='';
    protected $fillable=[
        'playlist_id',
        'user_id_id',
    ];

    public function playlist(){
        return $this->belongsTo(PlayLists::class,'playlist_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
