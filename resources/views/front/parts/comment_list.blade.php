@foreach ($comments as $comment)
    <div class="media">
        <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}" class="mr-3" alt="...">
        <div class="media-body">
            <div class="d-flex justify-content-between">
                <h5 class="mt-0">{{ $comment->id }} - {{ $comment->user->name }}</h5>
                @if ($comment->user_id == Auth::id())
                <form action="{{ route('site.delete_comment', $comment->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </form>
                @endif

            </div>
            <small>{{ $comment->created_at->diffForHumans() }}</small>
            <p>{{ $comment->comment }}</p>
        </div>
    </div>
@endforeach
