<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Función que me devuelve mi query paginado y dode yo le indico dentro de paginate(n)
        //la cantidad de N elementos que quiero que muestre
        //para el llevar la pagina siguiente lo realiza a traves de ?page=n en la URL que activa este evento
        $images = Image::orderBy('id', 'desc')->paginate(5);

        return view('home', [
            'images' => $images
        ]);
    }
}
