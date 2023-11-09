<div class="d-flex justify-content-center my-4">
    {{ $news->links() }}
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($news as $newsItem)
        <div class="col">
            <div class="card h-100">
                <img src="{{ $newsItem->photo }}" class="card-img-top img-thumbnail" alt="{{ $newsItem->headline }}">
                <div class="card-body">
                    <h5 class="card-title text-center fs-4">{{ $newsItem->headline }}</h5>
                    <p class="card-text">{{ Str::limit($newsItem->body, 100) }}</p>
                    @if(Auth::user()->is_admin)
                    <div class="btn-wrap my-4">
                        <a href="{{ route('news.edit', $newsItem) }}" class="btn btn-outline-info">Edit</a>
                        <form action="{{ route('news.destroy', $newsItem) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center my-4">
    {{ $news->links() }}
</div>