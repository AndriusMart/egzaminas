@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-back">
                    <h2>Change Category</h2>
                </div>
                </div>
                <div class="card-body">
                    <form action="{{route('c_update', $category)}}" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Title</span>
                            <input type="text" name="title" class="form-control" value="{{old('title',$category->title)}}">
                        </div>
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-secondary mt-4">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection