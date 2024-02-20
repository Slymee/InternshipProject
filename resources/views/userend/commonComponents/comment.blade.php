
<div class="comment">
    <span class="comment-user">{{ $comment->user->name }}</span>
    <p>{{ $comment->comment }}

    @if ($comment->getImagePath())
            @foreach ($comment->getImagePath() as $imagePath)
                <img src="{{ asset('storage/' . $imagePath) }}" alt="Comment Image" class="comment-image">
            @endforeach
    @endif
    </p>

{{--    @if ($comment->replies->count())--}}
{{--        <div class="replies">--}}
{{--            @foreach ($comment->replies as $reply)--}}
{{--                @include('userend.commonComponents.comment', ['comment' => $reply])--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @endif--}}
</div>
