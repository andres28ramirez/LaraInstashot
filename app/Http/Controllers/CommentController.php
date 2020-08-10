<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //VALIDACIONES
        $validate = $this->validate($request, [
            'content' => 'string|required',
            'image_id' => 'int|required',
        ]);

        //RECOGO LOS VALORES
        $user     = \Auth::user();
        $user_id  = $user->id;
        $content  = $request->input('content');
        $image_id = $request->input('image_id');
        
        //ASIGNO LOS VALORES EN LA INSTANCIA
        $comment = new Comment();
        $comment->image_id = $image_id;
        $comment->user_id  = $user_id;
        $comment->content  = $content;
        
        //GRABAMOS LOS DATOS
        $comment->save();

        //REDIRECCIÓN
        return redirect()->route('image-detail', ['id' => $image_id])->with('message', 'Comentario Subido Correctamente');
    }

    public function delete($id){
        //CONSEGUIR DATOS DEL USUARIO IDENTIFICADO
        $user = \Auth::user();

        //CONSEGUIR EL OBJETO DEL COMENTARIO
        $comment = Comment::find($id);

        //COMPROBAR SI SOY EL DUEÑO DEL COMENTARIO O DE LA IMAGEN
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            //REDIRECCIÓN
            return redirect()->route('image-detail', ['id' => $comment->image_id])->with('message', 'Comentario Borrado Correctamente');
        }
        else{
            //REDIRECCIÓN
            return redirect()->route('image-detail', ['id' => $comment->image_id])->with('message', 'No puedes eliminar el comentario');
        }
    }
}
