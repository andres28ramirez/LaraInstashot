<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null){
        
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('surname', 'LIKE', '%'.$search.'%')
                        ->orderBy('id','desc')
                        ->paginate(5);
        }
        else{
            $users = User::orderBy('id','desc')->paginate(5);
        }

        return view('user.index',[
            'users' => $users
        ]);
    }
    
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //CONSEGUIR EL USUARIO IDENTIFICADO
        $user = \Auth::user();
        $id   = $user->id;

        //VALIDACIONES DE FORMULARIO
        /* $validate = $this->validate($request, [
            REGLAS DEL REQUEST
            unique:users //UNICO EN LA TABLA DE USUARIOS DEL DATO QUE LLEGA
            required //DATO REQUERIDO
            string //QUE SEA DATO TIPO STRING
            max:n //MAXIMO DE N CARACTERES
            email // QUE SEA UN EMAIL
            confirmed //EN CASO DE CONTRASEÑAS QUE COMPARTAN MISMOS VALORES
            min:n //MINIMO DE N CARACTERES
            unique:users,nick,id //CAMPO UNICO EN LA TABLA PERO EXISTE LA EXCEPCIÓN SI ES EL MISMO VALOR DEL MISMO USUARIO
        ]); */

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $name    = $request->input('name');
        $surname = $request->input('surname');
        $nick    = $request->input('nick');
        $email   = $request->input('email');
        
        //Subir la Imagen
        $image_path = $request->file('image_path');

        //Revisa si me llego imagen y hago todo lo siguiente
        if($image_path){
            //getClientOriginalName(); devuelve el nombre del fichero original
            //time() hace que el nombre sea unico
            //Ponerle un nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Esta clase es para seleccionar el disco, mandarle imagen y que la ubique en donde esta grabada en el temporal
            //En resumen graba la imagen del fichero temporal al disco que le indiquemos
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //Acomodamos el valor del path del avatar en el objeto del usuario
            $user->image = $image_path_name;
        }

        //Asignar nuestro valores nuevos al objeto de usuario (actualizarlos)
        $user->name    = $name;
        $user->surname = $surname;
        $user->nick    = $nick;
        $user->email   = $email; 

        //Actualizar los datos del usuario en la Base de Datos
        $user->update();

        return redirect()->route('config')->with('message', 'Datos Actualizados Correctamente');
    }

    public function getImage($filename){
        //Todo esto para retornar el archivo de la imagen
        //el método get seria obtener la imagen la cual el nombre que llegara por $filename
        //es el de la ruta que hayamos grabado dentro de la BD
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){

        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }
}
