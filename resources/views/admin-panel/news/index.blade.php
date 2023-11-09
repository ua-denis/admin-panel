@extends('layouts.base-layout')

@section('content')
    <div class="my-4">
        <a href="{{ route('news.create') }}" class="btn btn-primary">Create News</a>
    </div>

    @include('components.news-list', compact('news'))
@endsection