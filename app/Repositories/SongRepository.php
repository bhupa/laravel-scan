<?php


namespace App\Repositories;

use App\Models\Song;

class SongRepository extends Repository
{
    public function __construct(Song $song)
    {
        $this->model = $song;
    }

}