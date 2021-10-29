<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayLists extends Model
{
    use HasFactory;

    protected $table='playlists';

    protected $fillable=[
        'title',
        'value',
        'type',
        'created_by',
        'status'
    ];

    public function author(){
        return $this->belongsTo(User::class,'created_by');
    }
}
