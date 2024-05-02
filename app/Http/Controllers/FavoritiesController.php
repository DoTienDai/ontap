<?php

namespace App\Http\Controllers;


use App\Models\Favorities;

/**
 * CRUD User controller
 */
class FavoritiesController extends Controller
{

    /**
     * List of users
     */
    public function listdanhsach()
    {
        
            $sothich = Favorities::all();
            //$users = User::all();
            return view('sothich.listdanhsach',['sothich' => $sothich]);
        

       
    }
   
    
}