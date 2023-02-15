<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/** 
* ** DEMO-LARAVEL **
* Controller che si occupa delle settings
*/
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = [
            'assets'=>
            [
                'public'=>[
                    'uploads'=>asset('public/uploads')
                ]
            ]
        ];
        return response()->jsonOK($settings);
    }
}
