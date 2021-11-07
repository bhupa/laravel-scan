<?php

namespace App\Http\Controllers;

use App\Http\Requests\Playlists\StoreRequest;
use App\Http\Requests\Playlists\UpdateRequest;
use App\Http\Resources\PlayListsResource;
use App\Models\PlayLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PlayListsRepository;

class PlayListsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PlayListsRepository $play)
    {
        $this->play =  $play;
    }
    public function index()
    {
        $playlists = $this->play->where('created_by',auth()->id())->orderBy('created_at','desc')->get();
        $output = PlayListsResource::collection( $playlists);
        return $this->success($output, 'PlayLists Lists');
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
    public function store(StoreRequest $request)
    {
       
        $data = $request->except('_token');

        $data['created_by'] = auth()->Id();
        $data['status'] = $request->status ? 1:0;
     
        if($play = $this->play->create($data)){
           
            $output = new PlayListsResource($play);
            return $this->success( $output, 'Play Lists added Successfully');
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
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['created_by'] = auth()->Id();
        $data['status'] = $request->status ? 1:0;
     
        $play = $this->play->find($id);
        if($play->update($data)){
            $output = new PlayListsResource($play);
            return $this->success($output,'Play Lists update Successfully ');
         }

         return $this->error('Opps Something went wrong pls check the form ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
        $play = $this->play->find($id);
        $play->delete();
        return $this->success('Play Lists delete Successfully');
    }
}
