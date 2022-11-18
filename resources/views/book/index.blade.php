@extends('layouts.app')

@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>books</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($books as $book)
                        <li class="list-group-item">
                            <div class="hotels-list">
                                <div class="content">
                                    <h2><span>Title: </span>{{$book->title}}</h2>
                                    <h4><span>ISBN: </span>{{$book->isbn}}</h4>
                                    <h4><span>pages: </span>{{$book->pages}}</h4>
                                    <h5>
                                        <span>Category: </span>
                                        <a href="{{route('c_show', $book->getCategory->id)}}">
                                            {{$book->getCategory->title}}
                                        </a>
                                    </h5>
                                    @if($book->getPhotos()->count())
                                    <h5><a href="{{$book->lastImageUrl()}}" target="_BLANK">Photos: [{{$book->getPhotos()->count()}}]</a> </h5>
                                    @endif
                                </div>
                                <div class="buttons">
                                    <a href="{{route('b_show', $book)}}" class="btn btn-info">Show</a>
                                    @if(Auth::user()->role >=10)
                                    <a href="{{route('b_edit', $book)}}" class="btn btn-success">Edit</a>
                                    <form action="{{route('b_delete', $book)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No books found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection