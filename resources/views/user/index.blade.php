@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h1>People</h1>

            <form method="get" action="{{route('people')}}" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
            <hr>

            <?php $contador = 0; ?>
            @foreach($users as $user)
                <?php $contador++ ?>
                <div class="profile-user">
                    @if($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user-avatar', ['filename' => $user->image]) }}" alt="" class="avatar"/>
                        </div>
                    @endif

                    <div class="user-info">
                        <h2>{{ '@'.$user->nick }}</h2>
                        <h3>{{ $user->name.' '.$user->surname }}</h3>
                        <p>
                            En instagram desde: {{ \FormatTime::LongTimeFilter($user->created_at) }}
                        </p>
                        <a href="{{ route('user-profile', ['id' => $user->id]) }}" class="btn btn-success">Ver Perfil</a>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                </div>
            @endforeach

            @if($contador==0)
                <div class="">
                    <h2>No se encuentran Usuarios con la busqueda seleccionada</h2>
                </div>
            @endif

            <!-- PAGINACIÓN -->
            <div class="clear-fix justify-content-center">
                {{ $users->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection
