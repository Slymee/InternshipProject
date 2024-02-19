<!-- resources/views/comments/_comment.blade.php -->

<div class="comment">
    <p>{{ $comment->comment }}</p>

    @if ($comment->replies->count())
        <div class="replies">
            @foreach ($comment->replies as $reply)
                @include('userend.commonComponents.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
