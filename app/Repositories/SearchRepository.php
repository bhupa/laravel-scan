<?php


namespace App\Repositories;

use Spotify;

class SearchRepository extends Repository
{
    

    public function artist($results){
        $art =[];
        foreach($results as $result){
           $art[] = [
               'external_urls'=> $result['external_urls']['spotify'],
                'id' => $result['id'],
                 'genres' => $result['genres'],
                 'images' => $result['images'],
                 'name' => $result['name'],
                 'followers' => $result['followers']['total'],
           ];
       
        }
        return $art;

   }
   public function album($results){
       $art =[];
       foreach($results as $result){
          $art[] = [
              'album_type' =>$result['album_type'],
              'artists' =>$result['artists'],
              'external_urls'=> $result['external_urls']['spotify'],
                'id' => $result['id'],
                 'release_date' => $result['release_date'],
                 'images' => $result['images'],
                 'total_tracks' => $result['total_tracks'],
                 'name' => $result['name'],
                 'type' => $result['type'],
          ];
      
       }
       return $art;

  }
  public function track($results){
   $art =[];
   foreach($results as $result){
      $art[] = [
          'album_type' =>$result['album']['album_type'],
          'artists' =>$result['album']['artists'],
          'external_urls'=> $result['album']['external_urls']['spotify'],
            'id' => $result['album']['id'],
             'release_date' => $result['album']['release_date'],
             'images' => $result['album']['images'],
             'total_tracks' => $result['album']['total_tracks'],
             'name' => $result['album']['name'],
             'type' => $result['album']['type'],
      ];
  
   }
   return $art;

}
public function getArtAlbum($results){
    $art =[];
    foreach($results as $result){
     
       $art[] = [
           'album_type' =>$result['album_type'],
           'album_group' =>$result['album_group'],
           'artists' =>$result['artists'],
           'external_urls'=> $result['external_urls']['spotify'],
             'id' => $result['id'],
              'release_date' => $result['release_date'],
              'images' => $result['images'],
              'total_tracks' => $result['total_tracks'],
              'name' => $result['name'],
              'type' => $result['type'],
       ];
   
    }
    return $art;

}
public function trackByAlbum($results){
    $art =[];
    foreach($results as $result){
       $art[] = [
           'album_type' =>$result['album_type'],
           'artists' =>$result['artists'],
           'external_urls'=> $result['external_urls']['spotify'],
             'id' => $result['id'],
              'release_date' => $result['release_date'],
              'images' => $result['images'],
              'total_tracks' => $result['total_tracks'],
              'name' => $result['name'],
              'label' => $result['label'],
              'popularity' => $result['popularity'],
              'tracks' => $this->getTrack($result['tracks']['items']),
       ];
   
    }
    return $art;
}
public function getTrack($results){
    $art =[];
    foreach($results as $result){
    
       $art[] = [
           'disc_number' =>$result['disc_number'],
           'duration_ms' =>$result['duration_ms'],
           'external_urls'=> $result['external_urls']['spotify'],
             'id' => $result['id'],
              'type' => $result['type'],
              'preview_url' => $result['preview_url'],
              'track_number' => $result['track_number'],
              'name' => $result['name'],
       ];
   
    }
    return $art;
}
}