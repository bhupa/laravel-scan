<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spotify;
use App\Repositories\SearchRepository;

class SearchController extends BaseController
{
    public function __construct(SearchRepository $searchs)
    {
        $this->searchs = $searchs;
    }

    public function search(Request $request){
       
        if($request->type == 'track'){
        $results =   Spotify::searchTracks($request->name)->get('tracks');
        $data['type'] = 'tracks';
       
        $output = $this->searchs->track(collect($results['items']));
        }elseif($request->type == 'album'){
            $results =   Spotify::searchAlbums($request->name)->get();
            $data['type'] = 'album';
            $output =  $this->searchs->album(collect($results['albums']['items']));
        }else{
            $results = Spotify::searchArtists($request->name)->get();
            $data['type'] = 'artist';
            $output =  $this->searchs->artist(collect($results['artists']['items']));
            
        }
        $data['item']=$output;
        return $this->success($data,'Lists');
    }

   


public function getByArtist(Request $request){

    if($request->type == 'album'){
        $palylist = Spotify::artistAlbums($request->id)->get();
        $palylists = $this->searchs->getArtAlbum($palylist['items']);
    }elseif($request->type == 'track'){
    $palylists =  Spotify::albums($request->id)->get();
    }
    return $this->success($palylists,'Lists');
}

    public function  getPlaylistsByAlbum(Request $request){
        
        $palylist =  Spotify::albums($request->id)->get();
       
        $palylists = $this->searchs->trackByAlbum( $palylist['albums']);
        return $this->success($palylists,'Lists');
    }

   

    

    public function getPlaylistByTrackId($id){
       
       
        $palylists = Spotify::track($id)->get();
        return $this->success($palylists,'Lists');
    }
    public function getPlaylistById($id){
        $palylists = Spotify::playlist($id)->get();
        return $this->success($palylists,'Lists');
    }
}