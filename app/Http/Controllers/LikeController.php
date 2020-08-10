<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id){
        //RECOGO LA ID DEL USUARIO Y INSTANCIO EL OBJEOT DE LIKE
        $user = \Auth::user();
        $like = new Like();

        //REVISO SI YA TIENE LIKE
        $revision = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if($revision == 0){
            //SETTEO LOS VALORES
            $like->image_id = (int)$image_id;
            $like->user_id = $user->id;

            //GUARDO EL LIKE
            $like->save();

            //JSON PORQUE ESTO SE EJECUTA CON AJAX
            return response()->json([
                'like' => $like
            ]);
        }
        else{
            //JSON PORQUE ESTO SE EJECUTA CON AJAX
            return response()->json([
                'message' => "El like ya existe"
            ]);
        }
    }

    public function dislike($image_id){
        //RECOGO LA ID DEL USUARIO Y INSTANCIO EL OBJEOT DE LIKE
        $user = \Auth::user();

        //REVISO SI YA TIENE LIKE
        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();

        if($like){

            //BORRO EL LIKE
            $like->delete();

            //JSON PORQUE ESTO SE EJECUTA CON AJAX
            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike correctamente'
            ]);
        }
        else{
            //JSON PORQUE ESTO SE EJECUTA CON AJAX
            return response()->json([
                'message' => "La persona no posee likes colocados"
            ]);
        }
    }

    public function index(){
        
        $user = \Auth::user();

        $likes = Like::where('user_id',$user->id)->orderBy('id', 'desc')->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }
}
