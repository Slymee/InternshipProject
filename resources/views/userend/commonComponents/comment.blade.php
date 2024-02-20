
<div class="comment">
    <span class="comment-user">{{ $comment->user->name }}</span>
    <p>{{ $comment->comment }}</p>

{{--    @if($comment->imagePicture)--}}
{{--        <img src="asset/.{{ $comment->imagePicture->image_path }}" alt="" srcset="" class="comment-image">--}}
{{--    @endif--}}

    @if ($comment->replies->count())
        <div class="replies">
            @foreach ($comment->replies as $reply)
                @include('userend.commonComponents.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
