@extends('layouts.base-layout')

@section('content')
    <div class="container my-4">
        <h2 class="my-4 text-center text-uppercase fs-3">Create News Item</h2>

        <form action="{{ route('news.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="headline" class="form-label">Headline</label>
                <input type="text" class="form-control" id="headline" name="headline" required>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
@endsection