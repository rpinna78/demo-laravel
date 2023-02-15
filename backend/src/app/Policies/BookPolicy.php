<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/** 
* ** DEMO-LARAVEL **
* Modello di policy per il modello Book
* e usa il trait HandlesAuthorization
* decide chi può efffetuare le operazioni tipiche su un modello di dati
*/
class BookPolicy
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
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Book $book)
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
        if(!$user)
            return false;
        if(!$book)
            return true;
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user = null , Book $book = null)
    {
        if(!$user)
            return false;
        if(!$book)
            return true;
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Book $book = null)
    {
        if(!$user)
            return false;
        if(!$book)
            return true;
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(?User $user, Book $book)
    {
        if(!$user)
            return false;
        if(!$book)
            return true;
        return $user->id === $book->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(?User $user, Book $book)
    {
        if(!$user)
            return false;
        if(!$book)
            return true;
        return $user->id === $book->user_id;
    }

}
