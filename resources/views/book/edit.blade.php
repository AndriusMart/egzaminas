@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Update Book</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('b_update', $book)}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value="{{old('title', $book->title)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">ISBN</span>
                            <input type="text" name="isbn" class="form-control" value="{{old('isbn', $book->isbn)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">About</span>
                            <input type="text" name="about" class="form-control" value="{{old('about', $book->about)}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Pages</span>
                            <input type="text" name="pages" class="form-control" value="{{old('pages', $book->pages)}}">
                        </div>
                        <div class="input-group mt-3">
                            <span class="input-group-text">Photo</span>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        <div class="img-small-ch mt-3">
                            @forelse($book->getPhotos as $photo)
                            <div class="img">
                                <label for="{{$photo->id}}-del-photo">X</label>
                                <input type="checkbox" value="{{$photo->id}}" id="{{$photo->id}}-del-photo" name="delete_photo[]">
                                <img src="{{$photo->url}}">
                            </div>
                            @empty
                            <h2>No photos yet.</h2>
                            @endforelse
                        </div>

                        <select name="category_id" class="form-select mt-3">
                            <option value="0">Choose category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id == old('category_id', $book->category_id)) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-secondary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection