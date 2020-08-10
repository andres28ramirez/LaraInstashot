<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){
        
        //VALIDACIONES
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image',
            //mimes:jpg,jpeg,png,gif = que image
        ]);

        $description = $request->input('description');
        $image_path  = $request->file('image_path');
            
        //CONSEGUIR EL USUARIO IDENTIFICADO
        $user = \Auth::user();
        $id   = $user->id;

        //Asignar los valores al nuevo objeto de imagen
        $image = new Image();
        $image->user_id     = $id;
        $image->description = $description;

        //Revisa si me llego imagen y hago todo lo siguiente
        if($image_path){
            //getClientOriginalName(); devuelve el nombre del fichero original
            //time() hace que el nombre sea unico
            //Ponerle un nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Esta clase es para seleccionar el disco, mandarle imagen y que la ubique en donde esta grabada en el temporal
            //En resumen graba la imagen del fichero temporal al disco que le indiquemos
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            
            $image->image_path = $image_path_name;
        }

        //Grabamos la Imagen
        $image->save();

        return redirect()->route('home')->with('message', 'Imagen Subida Correctamente');

    }

    public function getImage($filename){
        //Todo esto para retornar el archivo de la imagen
        //el método get seria obtener la imagen la cual el nombre que llegara por $filename
        //es el de la ruta que hayamos grabado dentro de la BD
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        //$id va ser el id de la imagen que deseo
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id){

        $user = \Auth::user();

        //INSTANCIO LA IMAGEN JUNTO A SUS COMENTARIOS Y LIKES
        $image = Image::find($id);
        $likes = Like::where('image_id',$id)->get();
        $comments = Comment::where('image_id',$id)->get();

        //VALIDO
        if($user && $image && $image->user->id == $user->id){
            //Eliminar comentarios
            if($comments && count($comments)>=1){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //Eliminar likes
            if($likes && count($likes)>=1){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            //Eliminar los ficheros de la imagen como tal
            Storage::disk('images')->delete($image->image_path);

            //Eliminar la Imagen
            $image->delete();

            //Redirección
            return redirect()->route('home')->with('message', 'Imagen Eliminada Correctamente');
        }
        else{
            //Redirección
            return redirect()->route('home')->with('message', 'Error al Eliminar la Imagen');
        }
    }

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if($image && $user && $image->user->id == $user->id){
            return view('image.edit',[
                'image' => $image
            ]);
        }
        else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        //VALIDACIONES
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image',
            //mimes:jpg,jpeg,png,gif = que image
        ]);

        $description = $request->input('description');
        $image_path  = $request->file('image_path');
        $id          = $request->input('image_id');
            
        //CONSEGUIR EL OBJETO DE LA IMAGEN
        $image = Image::find($id);

        //SETEO LOS VALORES
        $image->description = $description;

        //Revisa si me llego imagen y hago todo lo siguiente
        if($image_path){
            //getClientOriginalName(); devuelve el nombre del fichero original
            //time() hace que el nombre sea unico
            //Ponerle un nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Esta clase es para seleccionar el disco, mandarle imagen y que la ubique en donde esta grabada en el temporal
            //En resumen graba la imagen del fichero temporal al disco que le indiquemos
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            //Eliminar los ficheros de la imagen como tal
            Storage::disk('images')->delete($image->image_path);
            
            //Setteamos la nueva imagen
            $image->image_path = $image_path_name;
        }

        //Grabamos los cambios realizados
        $image->update();

        return redirect()->route('image-detail',['id' => $id])->with('message', 'Imagen Editada Correctamente');
    }
}
