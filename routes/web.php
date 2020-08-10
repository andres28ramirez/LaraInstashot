<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use App\Image;

Route::get('/', function () {

    /* //SACA TODAS LAS IMAGENES QUE TIENE EN LA BD (un select *)
    $images = Image::all();
    
    foreach($images as $image){
        //var_dump($image);
        echo $image->image_path."<br>";
        echo $image->user->name.' '.$image->user->surname."<br>";

        //SI TIENE CONTENIDO MUESTRA COMENTARIOS
        if(count($image->comments) >= 1){
            echo "<strong>COMENTARIOS</strong><br>";
            foreach($image->comments as $comment){
                echo "Comentario por: ".$comment->user->name.' '.$comment->user->surname."<br>";
                echo $comment->content."<br>";
            }
        }

        //SI TIENE CONTENIDO MUESTRA LIKES
        echo 'LIKES: '.count($image->likes);

        echo "<hr>";
    }

    die(); */

    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix'=>'user'],function(){
    Route::get('configuracion', 'UserController@config')->name('config');
    Route::post('update', 'UserController@update')->name('user-update');

    Route::get('avatar/{filename}', 'UserController@getImage')->name('user-avatar');
    Route::get('profile/{id}', 'UserController@profile')->name('user-profile');
    Route::get('people/{search?}', 'UserController@index')->name('people');
});

Route::group(['prefix'=>'image'],function(){
    Route::get('subir', 'ImageController@create')->name('image-create');
    Route::post('save', 'ImageController@save')->name('image-save');

    Route::get('file/{filename}', 'ImageController@getImage')->name('image-file');
    Route::get('detail/{id}', 'ImageController@detail')->name('image-detail');
    Route::get('delete/{id}', 'ImageController@delete')->name('image-delete');

    Route::get('config/{id}', 'ImageController@edit')->name('image-config');
    Route::post('update', 'ImageController@update')->name('image-update');
    
    Route::post('comment', 'CommentController@save')->name('comment-save');
    Route::get('comment-delete/{id}', 'CommentController@delete')->name('comment-delete');

    Route::get('like/{image_id}', 'LikeController@like')->name('image-like');
    Route::get('dislike/{image_id}', 'LikeController@dislike')->name('image-dislike');
});

Route::get('/likes', 'LikeController@index')->name('likes');





