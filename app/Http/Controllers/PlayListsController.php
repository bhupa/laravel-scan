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
        $playlists = $this->play->orderBy('created_at','desc')->get();
        return $this->success([
            'message' => 'Play Lists',
            'data' =>  PlayListsResource::collection( $playlists)
        ]);
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

      

        if($request->type == 'file'){
            $disk = Storage::disk('public');
            $uploadpath = strtolower( 'playlists' . "/");
            $image = $request->value;
            $file_extension = $image->getClientOriginalExtension();
           
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            $path = $uploadpath . substr(md5(mt_rand()), 0, 7) . $filename . "-" . time() . "." . $file_extension;
            $disk->put($path, file_get_contents($image->getRealPath()));
            $data['value'] = $disk->url($path);
        }
        $data['created_by'] = auth()->Id();
        $data['status'] = $request->status ? 1:0;
     
        if($play = $this->play->create($data)){
            return $this->success([
                'message' => 'Play Lists Store Successfully ',
                'data' => new PlayListsResource($play)
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
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token');



        if($request->type == 'file'){
            $disk = Storage::disk('public');
            $uploadpath = strtolower( 'playlists' . "/");
            $image = $request->value;
            $file_extension = $image->getClientOriginalExtension();
           
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            $path = $uploadpath . substr(md5(mt_rand()), 0, 7) . $filename . "-" . time() . "." . $file_extension;
            $disk->put($path, file_get_contents($image->getRealPath()));
            $data['value'] = $disk->url($path);
        }
        $data['created_by'] = auth()->Id();
        $data['status'] = $request->status ? 1:0;
     
        $play = $this->play->find($id);
        if($play->update($data)){
            return $this->success([
                'message' => 'Play Lists update Successfully ',
                'data' => new PlayListsResource($play)
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
    public function destroy($id)
    {
  
        $play = $this->play->find($id);
        $play->delete();
        return $this->success([
            'message' => 'Play Lists delete Successfully ',
            
        ]);
    }
}
