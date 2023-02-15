<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\Chapter;
use App\Models\Book;
use App\Models\Custom\Acl;

/** 
* ** DEMO-LARAVEL **
* Controller che si occupa dei capitoli
*/
class ChapterController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Chapter::class, 'chapter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        return response()->jsonOK(Chapter::where('book_id', $book->id)->orderBy('order', 'asc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $order=intval(Chapter::where('book_id', $book->id)->max('order'));
        $chapter = new Chapter();
        $chapter->section = $request->section;
        $chapter->short = $request->short;
        $chapter->long = $request->long;
        $chapter->book_id = $book->id;
        $chapter->order = ++$order;
        if($chapter->save()){
            return response()->jsonOK($chapter,[__('demoLaravel.chapter_saved')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        return response()->jsonOK($chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        $chapter->section = $request->section;
        $chapter->short = $request->short;
        $chapter->long = $request->long;
        if($chapter->save()){
            return response()->jsonOK($chapter,[__('demoLaravel.chapter_updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        if($chapter->delete()){
            return response()->jsonOK($chapter,[__('demoLaravel.chapter_deleted')]);
        }
    }

    /**
     * Reorder
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request, Book $book)
    {
        // controllo se sei autorizzato        
        $this->authorize('update', [Chapter::class, null, $book]);

        $chaptersRequest = collect($request->chapters)->pluck('id');
        $differentItems = $chaptersRequest->diff(collect($book->chapters->pluck('id')));
        if($differentItems->count()>0)
        {
            return response()->jsonKO([__('demoLaravel.chapter_reorder_ko')],400);
        }

        // salvataggio
        DB::transaction(function () use ($request, $book) {
            $chaptersRequest = collect($request->chapters);
            $chapters=Chapter::where('book_id', $book->id)->orderBy('order', 'asc')->get();
            foreach ($chapters as $chapter) {
                $order = $chaptersRequest->firstWhere('id',$chapter->id)['order'];
                $chapter->order = $order;
                $chapter->save();
            }
        });
        $chapters=Chapter::where('book_id', $book->id)->orderBy('order', 'asc')->get();
        return response()->jsonOK($chapters,[__('demoLaravel.chapter_reorder_ok')]);
    }


    /**
     * Display acl.
     *
     * @return \Illuminate\Http\Response
     */
    public function acl(int $book_id=null, int $chapter_id=null)
    {
        $acl = new Acl();
        $error = true;
        if($book_id)
        {
            $book = Book::findOrFail($book_id);
            $error = false;
            $params = [Chapter::class, null , $book];
            if($chapter_id)
            {
                $chapter = Chapter::findOrFail($chapter_id);
                $params = [ Chapter::class, $chapter];
                if( $chapter->book_id !== $book->id)
                {
                    $error = true;
                }
            }
        }
        if($error)
        {
            return response()->jsonKO([__('demoLaravel.chapter_acl_chapters')], 400);
        }
        $acl->create = Gate::inspect('create', [Chapter::class,$book])->allowed();
        $acl->update = Gate::inspect('update', $params)->allowed();
        $acl->read = Gate::inspect('viewAny', $params)->allowed();
        $acl->delete = Gate::inspect('delete', $params)->allowed();
        return response()->jsonOK($acl);
    }

}
