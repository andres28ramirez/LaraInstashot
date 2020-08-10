var url = "http://localhost/Laravel/proyecto-laravel/public/"; 

window.addEventListener("load", function(){
    
    $(".btn-like").css("cursor","pointer");
    $(".btn-dislike").css("cursor","pointer");

    function like(){
        //Boton de like
        //El unbind lo que hace es arreglarte los llamados al click parra que sea una sola vez
        $(".btn-like").unbind('click').click(function(){
            $(this).addClass("btn-dislike").removeClass("btn-like");
            $(this).attr("src",url+"img/red-heart.png");

            //Petición de ajax para que ejecute el evento de like
            var image_id = $(this).attr("id");
            $.ajax({
                url: url+'image/like/'+image_id,
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log("Has dado like con exito");   
                    }
                    else{
                        console.log("Error al dar like");
                    }
                }
            });

            dislike();
        });
    }
    like();

    function dislike(){
        //Boton de dislike
        //El unbind lo que hace es arreglarte los llamados al click parra que sea una sola vez
        $(".btn-dislike").unbind('click').click(function(){
            $(this).addClass("btn-like").removeClass("btn-dislike");
            $(this).attr("src",url+"img/grey-heart.png");

            //Petición de ajax para que ejecute el evento de like
            var image_id = $(this).attr("id");
            $.ajax({
                url: url+'image/dislike/'+image_id,
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log("Has dado dislike con exito");   
                    }
                    else{
                        console.log("Error al dar dislike");
                    }
                }
            });

            like();
        });
    }
    dislike();

    //BUSCADOR
    $('#buscador').submit(function(){
        //CAPTURO EL EVENTO SUBMIT
        //MODIFICO EL VALOR DE LA URL DENTRO DEL ACTION
        $(this).attr('action',url+'user/people/'+$('#buscador #search').val());
    });

});