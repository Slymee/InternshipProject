<!-- resources/views/comments/_comment.blade.php -->

<div class="comment">
    <p>{{ $comment->body }}</p>

    @if ($comment->replies->count())
        <div class="replies">
            @foreach ($comment->replies as $reply)
                @include('$commonComponents.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
