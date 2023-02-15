<?php

namespace App\Policies;


use App\Models\Chapter;
use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/** 
* ** DEMO-LARAVEL **
* Modello di policy per il modello Chapter
* e usa il trait HandlesAuthorization
* decide chi può efffetuare le operazioni tipiche su un modello di dati
*/
class ChapterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Chapter $chapter)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user, Book $book = null)
    {
        // recupero il book dal router
        $book = ($book)?$book:request()->route()->parameter('book');
        if(!$user)
            return false;
        if(!$book)
            return false;
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Chapter $chapter = null,  Book $book = null)
    {
        $user_id = null;
        if($chapter)
            $user_id = $chapter->book->user_id;
        if($book)
            $user_id = $book->user_id;
        
        if(!$user)
            return false;
        if(!$user_id)
            return false;
        return $user->id === $user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Chapter $chapter = null,  Book $book = null)
    {
        $user_id = null;
        if($chapter)
            $user_id = $chapter->book->user_id;
        if($book)
            $user_id = $book->user_id;
        
        if(!$user)
            return false;
        if(!$user_id)
            return false;
        return $user->id === $user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Chapter $chapter)
    {
        $user_id = null;
        if($chapter)
            $user_id = $chapter->book->user_id;
        
        if(!$user)
            return false;
        if(!$user_id)
            return false;
        return $user->id === $user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Chapter $chapter)
    {
        $user_id = null;
        if($chapter)
            $user_id = $chapter->book->user_id;
        
        if(!$user)
            return false;
        if(!$user_id)
            return false;
        return $user->id === $user_id;
    }
}
