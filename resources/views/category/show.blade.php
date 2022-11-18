@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>Category</h2>
                </div>
                <div class="card-body">
                    <div class="category">
                        <h5>{{$category->title}}:</h5>
                    </div>
                    <ul class="list-group">
                        @forelse($category->getBooks as $book)
                        <li class="list-group-item">
                            <a style="text-decoration: none" href="{{route('b_show', $book->id)}}">
                            <h2><span>title: </span>{{$book->title}}</h2>
                            <h4><span>ISBN: </span>{{$book->isbn}}</h4>
                        </li>
                        @empty
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection