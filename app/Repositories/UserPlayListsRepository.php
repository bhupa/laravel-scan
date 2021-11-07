<?php


namespace App\Repositories;

use App\Models\UserPlayLists;

class UserPlayListsRepository extends Repository
{
    public function __construct(UserPlayLists $playlists)
    {
        $this->model = $playlists;
    }

}