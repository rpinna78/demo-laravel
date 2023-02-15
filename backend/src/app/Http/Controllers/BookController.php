<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


use App\Models\Book;
use App\Models\Image;
use App\Models\Custom\Acl;
use App\Enums\BookPrivacyEnum;
use App\Enums\BookStatusEnum;
use App\Helpers\UtilHelper;
use App\Http\Requests\CreateBookRequest;
use App\Services\UploadService;


/** 
* ** DEMO-LARAVEL **
* Controller che si occupa dei libri
*/
class BookController extends Controller
{
   
    public function __construct()
    {
        $this->authorizeResource(Book::class, 'book');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->jsonOK(Book::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $image_id = UploadService::upload($request,'cover');
        $book = new Book();
        $book->title = $request->title;
        if($request->privacy)
        {
            $book->privacy = $request->privacy;
        }
        if($request->status)
        {
            $book->status = $request->status;
        }
        if($image_id)
        {
            $book->image_id = $image_id;
        }
        $book->user_id = $request->user()->id;
        if($book->save()){
            return response()->jsonOK($book,[__('demoLaravel.book_saved')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->jsonOK($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $reload_book = false;
        $image_id = UploadService::upload($request,'cover');
        $book->title = $request->title;
        if($request->privacy)
        {
            $book->privacy = $request->privacy;
        }
        if($request->status)
        {
            $book->status = $request->status;
        }
        if($image_id)
        {
            $book->image_id = $image_id;
            // se aggiorno cover devo ricaricare le info aggiornate
            $reload_book = true;
        }
        if($book->save()){
            if($reload_book)
            {
                $book = BOOK::find($book->id);
            }
            return response()->jsonOK($book,[__('demoLaravel.book_updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if($book->delete()){
            return response()->jsonOK($book,[__('demoLaravel.book_deleted')]);
        }
    }

    /**
     * return combo privacy
     *
     * @return \Illuminate\Http\Response
     */
    public function comboPrivacy()
    {
        return response()->jsonOK(  
            UtilHelper::makeCombo(array_column(BookPrivacyEnum::cases(), 'value'))
            );
    }

     /**
     * return combo privacy
     *
     * @return \Illuminate\Http\Response
     */
    public function comboStatus()
    {
        return response()->jsonOK(  
            UtilHelper::makeCombo(array_column(BookStatusEnum::cases(), 'value'))
            );
    }


    /**
     * Display acl.
     *
     * @return \Illuminate\Http\Response
     */
    public function acl(Request $request, int $book_id=null)
    {
        $acl = new Acl();
        $params = [Book::class];
        if($book_id)
        {
            $book = Book::findOrFail($book_id);
            $params = [ Book::class, $book];
        }
        $acl->create = Gate::inspect('create', $params)->allowed();
        $acl->update = Gate::inspect('update', $params)->allowed();
        $acl->read = Gate::inspect('viewAny', $params)->allowed();
        $acl->delete = Gate::inspect('delete', $params)->allowed();
        return response()->jsonOK($acl);
    }

}
