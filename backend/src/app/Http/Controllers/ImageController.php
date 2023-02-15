<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Image;
use App\Models\Chapter;
use App\Models\Book;

/** 
* ** DEMO-LARAVEL **
* Controller che si occupa di immagini
*/
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book, Chapter $chapter)
    {
        return response()->jsonOK(
            DB::table('media')->where('chapter_id', $chapter->id)->where('mediable_type','App\Models\Image')->join('images', 'media.mediable_id', '=', 'images.id')->get()
        );
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
            $image = new Image();
            $image->url = $request->url;
            $image->save();
            $image->media()->create(['chapter_id'=>$chapter->id,'media_title'=>$request->title]);
        });
        return response()->jsonOK(null,['Immagine salvata correttamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
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
    public function update(Request $request, Image $image)
    {
        DB::transaction(function () use ($request, $image) {
            $image->url = $request->url;
            $image->save();
            $media = $image->media()->get()->first();
            $media->media_title = $request->title;
            $media->save();
        });
        return response()->jsonOK(null,['Immagine aggiornata correttamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        DB::transaction(function () use ($image) {
            $media = $image->media()->get()->first();
            $media->destroy($media->id);
            $image->destroy($image->id);
        });
        return response()->jsonOK(null,['Immagine elminata correttamente']);
    }
}
