<?php

namespace App\Http\Controllers;

use App\Http\Requests\Song\SongStoreRequest;
use App\Http\Requests\Song\SongUpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Repositories\SongRepository;

class SongController extends BaseController
{

    public function __construct(SongRepository $song)
    {
        $this->song = $song;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongStoreRequest $request)
    {
        $data = $request->except('_token');
        if($song = $this->song->create($data)){
            return $this->success([
                'message' => 'Song added Successfully ',
                'data' => new SongResource($song)
            ]);
         }

         return $this->error('Opps Something went wrong pls check the form ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SongUpdateRequest $request, Song $song)
    {
        
        $data = $request->except('_token');
        if($song->update($data)){
            return $this->success([
                'message' => 'Song update Successfully ',
                'data' => new SongResource($song)
            ]);
         }

         return $this->error('Opps Something went wrong pls check the form ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();
            return $this->success([
                'message' => 'Song deleted Successfully ',
                'data' => new SongResource($song)
            ]);
    }
}
