<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //relacion One to Many - Uno a Muchos
    //Un unico modelo va poder tener muchos comentarios
    public function comments(){
        //En los parametros se le indica con que objeto quiero que se relacione
        //Fijese que lo relacione con el Modelo de Comentarios
        //Esto me devolvera el array de objetos de los comentarios
        //Ojo la relación la hara por si solo tomando el ID de la imagen y buscara con esa ID en el comentario
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //Relacion One to Many - Uno a Muchos
    //Un unico modelo va poder tener muchos likes
    public function likes(){
        //En los parametros se le indica con que objeto quiero que se relacione
        //Fijese que lo relacione con el Modelo de Likes
        //Esto me devolvera el array de objetos de los Likes
        //Ojo la relación la hara por si solo tomando el ID de la imagen y buscara con esa ID en los Likes
        return $this->hasMany('App\Like');
    }

    //Relacion Many to One - Muchos a Uno
    public function user(){
        //En los parametros se le indica con que objeto quiero que se relacione y cual es la clave foranea
        //Fijese que lo relacione con el Modelo de User
        //Esto me devolvera el objeto que es el usuario de la imagen
        //Ojo la relación la hara por si solo tomando el user_id de la imagen y buscara con esa id en los ususarios
        return $this->belongsTo('App\User', 'user_id');
    }
}
