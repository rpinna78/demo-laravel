<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
/** 
* ** DEMO-LARAVEL **
* classe UploadService
* che effettua un upload secondo i parametri in ingresso
*/
class UploadService
{
    static public function upload(Request $request,string $key='upload',string $path='public/uploads')
    {
        if($request->hasFile($key))
        {
            $file = $request->file($key);
            if( ! Storage::exists($path))
            {
                Storage::makeDirectory($path);
            } 
            $name =uniqid($key.'_'.time());
            $ext =  $file->guessExtension();
            $mime = $file->getClientMimeType();
            $filename =  $name.".".$ext;
            $url = Storage::putFileAs($path, $file, $filename);
            $image = new Image();
            $image->url = $url;
            $image->save();
            $image_id = $image->id;
            return $image_id;
        }
        return null;
    }
}





