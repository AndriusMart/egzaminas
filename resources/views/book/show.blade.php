@extends('layouts.app')
@section('content')

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header-back">
                            <h2>Book</h2>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="content">
                            <div class="show-l">
                                <div class="show-info">

                                    <div class="line"><span>title: </span>
                                        <h5>{{$book->title}}</h5>
                                    </div>
                                    <div class="line"><span>ISBN: </span>
                                        <h5>{{$book->isbn}}</h5>
                                    </div>
                                    <div class="line"><small>category: </small>
                                        <h5>{{$book->getCategory->title}}</h5>
                                    </div>
                                    <div class="line"><small>pages: </small>
                                        <h5>{{$book->pages}}</h5>
                                    </div>
                                    <div class="line"><small>rating: </small>
                                        <h5>{{$book->rating ?? 'X'}}</h5>
                                    </div>
                                </div>
                                <div>
                                    @if($book->getPhotos()->count())
                                    @forelse($book->getPhotos as $photo)
                                    <img src="{{$photo->url}}" class="show-img">
                                    @empty
                                    <h3>No Photos</h3>
                                    @endforelse
                                    @else
                                    <img src="<?= asset('images/nophoto.jpg') ?>" class="show-img" />
                                    @endif
                                </div>
                            </div>
                            <h2 class="title mt-5">About!</h2>
                                    <div class="line">
                                        <p>{{$book->about}}</p>
                                    </div>
                        </div>
                        @php
                        $votes = json_decode($book->votes ?? json_encode([]));
                        @endphp
                        @if(in_array(Auth::user()->id, $votes))
                        <div>You already rated this item</div>

                        @else
                        <form action="{{route('rate', $book)}}" method="post">
                            <select name="rate">
                                @foreach(range(1, 10) as $value)
                                <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info">Rate</button>
                        </form>
                        @endif


                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
@endsection
