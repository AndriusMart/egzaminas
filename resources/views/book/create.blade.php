@extends('layouts.app')

@section('content')
<div  class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>New Hotel</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('b_store')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Titile</span>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">ISBN</span>
                            <input type="text" name="isbn" class="form-control" value="{{old('isbn')}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">About</span>
                            <input type="text" name="about" class="form-control" value="{{old('about')}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Pages</span>
                            <input type="text" name="pages" class="form-control" value="{{old('pages')}}">
                        </div>
                        <select name="category_id" class="form-select mt-3">
                            <option value="0">Choose category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id == old('category_id')) selected
                                @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                        <div class="input-group mt-3">
                            <span class="input-group-text">Book photo</span>
                            <input type="file" name="photo[]" multiple class="form-control">
                        </div>
                        
                        @csrf
                        <button type="submit" class="btn btn-secondary mt-4">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection