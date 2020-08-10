<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user-avatar', ['filename' => $image->user->image]) }}" alt="" class="avatar"/>
            </div>
        @endif
        <div class="data-user">
            <a href="{{ route('user-profile', ['id' => $image->user->id]) }}" class="text-dark" style="text-decoration:none">
                {{ '@'.$image->user->nick }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image-detail', ['id' => $image->id]) }}">
                <img src="{{ route('image-file', ['filename' => $image->image_path]) }}" alt=""/>
            </a>
        </div>
        
        <div class="description">
            <span class="date">{{ \FormatTime::LongTimeFilter($image->created_at) }}</span>
            <p>{{ $image->description }}</p>
        </div>

        <div class="likes">
            {{ count($image->likes) }}
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
                @if($like->user_id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if($user_like)
                <img id="{{$image->id}}" src="{{ asset('img/red-heart.png') }}" alt="" class="btn-dislike"/>
            @else
                <img id="{{$image->id}}" src="{{ asset('img/grey-heart.png') }}" alt="" class="btn-like"/>
            @endif
        </div>
        
        <div class="comments">
            <a href="{{ route('image-detail', ['id' => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>
    </div>
</div>