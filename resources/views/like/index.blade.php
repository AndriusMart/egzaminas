@extends('layouts.app')
@section('content')
<div class="container --content">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>My liked books</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($likes as $like)

                        @if(Auth::user()->name == $like->getUsers->name)
                        <li class="list-group-item">
                            <div class="hotels-list">
                                <div class="content">
                                    <h4><span>Hotel: </span>{{$like->getBooks->title}}</h4>
                                    <h4><span>ISNB: </span>{{$like->getBooks->isbn}}</h4>
                                </div>
                                <div class="buttons">
                                    <form action="{{route('l_delete', $like)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Unlike</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endif
                        @empty
                        <li class="list-group-item">No likes found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection