<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;

class HomeController extends BaseController
{
    

    public function __construct(EventRepository $event)
    {
        $this->event = $event;
    }

    public function index(){
        $lat = '27.243031';
        $lang = '85.157568';

        $events = $this->event->getEvents($lat ,$lang);
        return $this->success([
            'message' => 'Event Lists',
            'data' => $events
        ]);
    }
}
