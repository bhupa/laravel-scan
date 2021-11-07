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
        $data = [
        'events'=>$events,
        'user_play_lists'=>auth()->user()->playlists
        ];
        return $this->success($data,'Lists of playlists and events');
    }

    public function eventPercentage(Request $request){

        $data = $request->except('_token');

       
        $playlistId = auth()->user()->playlists()->pluck('playlist_id')->toArray();
        $counts = count($playlistId );
        $event = $this->event->whereIn('id',$request->event_id)->get();
       
        $events = $event->map(function($item)use($counts, $playlistId ){
           
            $playId = $item->playlists->pluck('id')->toArray();
            $count = array_diff( $playlistId,$playId);
            $data = $item;
            $data['percentage'] =(($counts - count($count))*100)/$counts;
            return  $data;
        });
        

        return $this->success($events,'Percentage of the event that match with playlists');
    }
}
