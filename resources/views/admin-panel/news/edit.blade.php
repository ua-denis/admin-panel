@extends('layouts.base-layout')

@section('content')
    <div class="container my-4">
        <h2 class="my-4 text-center text-uppercase fs-3">Edit News Item</h2>

        <form action="{{ route('news.update', $news) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="headline" class="form-label">Headline</label>
                <input type="text" class="form-control" id="headline" name="headline" value="{{ $news->headline }}" required>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3" required>{{ $news->body }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="regenerate_photo" name="new_photo">
                <label class="form-check-label" for="regenerate_photo">Regenerate photo</label>
            </div>

            <button type="submit" class="btn btn-outline-primary">Update</button>
        </form>
    </div>
@endsection