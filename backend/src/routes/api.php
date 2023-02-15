<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\OptionalAuthSanctum;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\MediaContoller;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
    Route::apiResource è comoda per creare n route con una sola riga 
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Autenticazione con Sanctum */
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
// Chiamata che recupera utente se loggato
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// sanctum in caso di non autorizzato cerca la route login
// molto semplicemente rispondiamo con un 401 tramite AuthController
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('login');

Route::get('/acl/books', [BookController::class, 'acl'])->middleware(OptionalAuthSanctum::class);
Route::get('/acl/books/{book_id}', [BookController::class, 'acl'])->middleware(OptionalAuthSanctum::class);
Route::get('/acl/books/{book_id}/chapters', [ChapterController::class, 'acl'])->middleware(OptionalAuthSanctum::class);
Route::get('/acl/books/{book_id}/chapters/{chapter_id}', [ChapterController::class, 'acl'])->middleware(OptionalAuthSanctum::class);

// apiResource è interessante per creare n route con una unica riga 
Route::apiResource('books', BookController::class)->middleware(OptionalAuthSanctum::class);
Route::apiResource('books.chapters', ChapterController::class)->middleware(OptionalAuthSanctum::class)->shallow();
Route::post('/books/{book}/chapters/reorder', [ChapterController::class, 'reorder'])->middleware(OptionalAuthSanctum::class);
Route::apiResource('books.chapters.images', ImageController::class)->middleware(OptionalAuthSanctum::class)->shallow();
Route::apiResource('books.chapters.videos', VideoController::class)->middleware(OptionalAuthSanctum::class)->shallow();
Route::get('/chapters/{chapter}/medias', [MediaContoller::class, 'index'])->middleware(OptionalAuthSanctum::class);


Route::get('/combo/books/privacy', [BookController::class, 'comboPrivacy'] )->middleware(OptionalAuthSanctum::class);
Route::get('/combo/books/status', [BookController::class, 'comboStatus'] )->middleware(OptionalAuthSanctum::class);

Route::get('/settings', [SettingController::class, 'index']);