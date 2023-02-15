<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Media;
use App\Models\Image;
use App\Models\Chapter;
use App\Models\Book;

/** 
* ** DEMO-LARAVEL **
* Controller che si occupa dei media
*/
class MediaContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Chapter $chapter)
    {
        return response()->jsonOK(
            DB::table('media')->where('chapter_id', $chapter->id)
           ->leftJoin('images', function ($join) {
                $join->on('media.mediable_id', '=', 'images.id')
                 ->where('media.mediable_type', '=', 'App\Models\Image');
            })
            ->leftJoin('videos', function ($join) {
                $join->on('media.mediable_id', '=', 'videos.id')
                ->where('media.mediable_type', '=', 'App\Models\Video');
            })
            ->select('media.id as id', 
                     'media.mediable_type as mediable_type', 
                     'videos.url as videos_url',
                     'videos.id as videos_id',    
                     'images.url as images_url',
                     'images.id as images_id',    
                     )
            ->get()
        );
    }

}
