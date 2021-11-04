<?php


namespace App\Repositories;

use App\Models\Event;
use DB;

class EventRepository extends Repository
{
    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    public function getEvents($latitude ,$longitude){

        
        $events          =       DB::table("event");

        $events          =       $events->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $events          =       $events->having('distance', '<', 10);
        $events          =       $events->orderBy('distance', 'asc');

        $events          =       $events->get();

        return $events;
    }

}