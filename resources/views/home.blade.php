@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(session('message'))
                <h3 class="text-center alert alert-success">{{ session('message') }}</h3>
            @endif
            
            @foreach($images as $image)
                @include('includes.image',['image'=>$image])
            @endforeach

            <!-- PAGINACIÓN -->
            <div class="clear-fix justify-content-center">
                {{ $images->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection
