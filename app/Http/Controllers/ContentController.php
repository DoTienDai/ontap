<?php

namespace App\Http\Controllers;


use App\Models\Posts;

/**
 * CRUD User controller
 */
class ContentController extends Controller
{

    /**
     * List of users
     */
    public function listbaiviet()
    {
        
            $baiviet = Posts::all();
            //$users = User::all();
            return view('content.listbaiviet',['baiviet' => $baiviet]);
        

       
    }
    
}