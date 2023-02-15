<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Video;
use App\Models\Chapter;
use App\Models\Book;


/** 
* ** DEMO-LARAVEL **
* Controller che si occupa dei video
*/
class VideoController extends Controller
{
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
    public function store(Request $request, Book $book, Chapter $chapter)
    {
        DB::transaction(function () use ($request, $chapter) {
            $video = new Video();
            $video->url = $request->url;
            $video->save();
            $video->media()->create(['chapter_id'=>$chapter->id,'media_title'=>$request->title]);
        });
        return response()->jsonOK(null,['Video salvata correttamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        DB::transaction(function () use ($request, $video) {
            $video->url = $request->url;
            $video->save();
            $media = $video->media()->get()->first();
            $media->media_title = $request->title;
            $media->save();
        });
        return response()->jsonOK(null,['Video aggiornato correttamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        DB::transaction(function () use ($video) {
            $media = $video->media()->get()->first();
            $media->destroy($media->id);
            $video->destroy($video->id);
        });
        return response()->jsonOK(null,['Video elminato correttamente']);
    }
}
