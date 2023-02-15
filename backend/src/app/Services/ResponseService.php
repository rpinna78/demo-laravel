<?php

namespace App\Services;

use Illuminate\Support\Facades\Response;
use App\Helpers\ResponseJsonHelper;

/** 
* ** DEMO-LARAVEL **
* classe class ResponseService
* iniziallizza le macro per per le riposte che vengonon utilizzate nei controller
* si appoggia a ResponseJsonHelper per descrivere il comportamento delle macro
*/
class ResponseService
{
    /**
     * 
     *
     * @return
     */
    static public function init()
    {
        Response::macro('jsonOK', function ($content=null, $messages=[], $code=null) {
            if(!$code){
                $code = 200;
            }
            return ResponseService::jsonOK($content, $messages, $code);
        });

        Response::macro('jsonKO', function ($messages=[], $code=null, $content=null) {
            if(!$code){
                $code = 500;
            }
            return ResponseService::jsonKO($messages, $code, $content);
        });
    }

    static public function jsonOK($content, $messages, $code)
    {
        $response = new ResponseJsonHelper();
        $response->status = true;
        $response->content = $content;
        $response->addMessages($messages);
        return Response::json($response, $code);
    }

    static public function jsonKO($messages, $code,$content=null)
    {
        $response = new ResponseJsonHelper();
        $response->status = false;
        if($content)
        {
            $response->content = $content;
        }
        $response->addMessages($messages,true);
        return Response::json($response, $code);
    }

}

