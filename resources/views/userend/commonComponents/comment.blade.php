
<div class="comment">
    <span class="comment-user">{{ $comment->user->name }}</span>
    <p>{{ $comment->comment }}

    @if ($comment->getImagePath())
            @foreach ($comment->getImagePath() as $imagePath)
                <img src="{{ asset('storage/' . $imagePath) }}" alt="Comment Image" class="comment-image">
            @endforeach
    @endif
    </p>
    <span class="reply-button" onclick="toggleComment({{ $comment->id }})">Reply</span>
    <div class="reply-comment" id="reply-comment-{{ $comment->id }}">
        <form action="{{ route('post-comment') }}" method="POST">
            @csrf

            <input type="hidden" value="{{ auth()->id() }}" name="user_id">
            <input type="hidden" value="{{ $product->id }}" name="product_id">
            <input type="hidden" value="{{ $comment->id }}" name="parent_id">

            <label for="comment_reply">Comment: </label>
            <input type="text" name="comment" id="comment_reply"/>
            <input type="submit" value="Reply">
        </form>
    </div>

    @if ($comment->replies->count())
        <div class="replies">
            @foreach ($comment->replies as $reply)
                @include('userend.commonComponents.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
