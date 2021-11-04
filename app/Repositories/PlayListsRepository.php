<?php


namespace App\Repositories;

use App\Models\PlayLists;

class PlayListsRepository extends Repository
{
    public function __construct(PlayLists $play)
    {
        $this->model = $play;
    }

}