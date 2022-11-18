@extends('layouts.app')

@section('content')
<h1 class="title mid"><span>All</span>Hotels</h1>
<div class="items bg-foto">
    <div class="col-9 bg-foto">
        <div class="list-items">
            <div class="filter">
                <div class="card filter">
                    <span class="fs-5 fw-semibold">Filter</span>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('home')}}" method="get">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <small>Categories</small>
                                                <select name="cat" class="form-select mt-1">
                                                    <option value="0">All</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($cat==$category->id)
                                                        selected @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <small>Order By</small>
                                                <select name="sort" class="form-select mt-1">
                                                    @foreach($sortSelect as $option)
                                                    <option value="{{$option[0]}}" @if($sort==$option[0]) selected
                                                        @endif>{{$option[1]}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <small>Items per page</small>
                                                <select name="per_page" class="form-select mt-1">
                                                    <option value="11" @if('11'==$perPage) selected @endif>11
                                                    </option>
                                                    <option value="5" @if('5'==$perPage) selected @endif>5</option>
                                                    <option value="20" @if('20'==$perPage) selected @endif>20
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-8">
                                                <button type="submit" class="input-group-text mt-1">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <span class="fs-5 fw-semibold">Search</span>
                            <div class="col-12  mt-1">
                                <form action="{{route('home')}}" method="get">
                                    <div class="input-group mb-3">
                                        <input type="text" name="s" class="form-control" value="{{$s}}">
                                        <button type="submit" class="input-group-text">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @forelse($books as $book)
            <div class="">
                <div class="  carousel-border">
                    <div class="card">
                        <div class="card-img ">

                            @if($book->getPhotos()->count())
                            @forelse($book->getPhotos as $photo)
                            <img src="{{$photo->url}}" class="img-fluid">
                            @empty
                            <h3>No Photos</h3>
                            @endforelse
                            @else
                            <img src="<?= asset('images/nophoto.jpg') ?>" class="img-fluid" />
                            @endif
                        </div>
                        <div class="carusel-tag ">
                            <h3>{{$book->title}}</h3>
                            <h3>rating:{{$book->rating ?? 'X'}} <i class="fa fa-star"></i></h3>
                            <h3>{{$book->getCategory->title}}</h3>
                            <p>ISBN{{$book->isbn}}</p>
                            <p>pages:{{$book->pages}}</p>
                        </div>
                        <div class="buy-see overlay">
                            {{-- order --}}
                            @php
                            $ord = 0
                            @endphp
                            @if($orders->first() !== null)
                            @forelse($orders as $order)
                            @if($order->book_id == $book->id)
                            <div style="display: none">
                            </div>
                            @if($order->book_id !== $book->id)
                            @php
                            $ord++
                            @endphp
                            {{dump($ord)}}
                            @endif
                            <h1>gg</h1>
                            @endif
                            @empty
                            <h3>no orders</h3>
                            @endforelse
                            <form action="{{route('o_store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                <input type="hidden" value="{{ $book->id}}" name="book_id">
                                @csrf
                                <button type="submit" class="order">Order</button>
                            </form>
                            <a href="{{route('b_show', $book)}}" class="order">Show</a>

                            @else
                            <form action="{{route('o_store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                <input type="hidden" value="{{ $book->id}}" name="book_id">
                                @csrf
                                <button type="submit" class="order">Order</button>
                            </form>
                            <a href="{{route('b_show', $book)}}" class="order">Show</a>
                            @endif

                            {{-- like --}}
                            @if($likes->first() !== null)
                            @forelse($likes as $like)
                            @if(Auth::user()->name == $like->getUsers->name)
                            @if($like->book_id == $book->id)
                            <h3>You already liked this book</h3>
                            @endif
                            @endif
                            @empty
                            <h3>no likes</h3>
                            @endforelse
                            <form action="{{route('l_store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                <input type="hidden" value="{{ $book->id}}" name="book_id">
                                @csrf
                                <button type="submit" class="order">Like</button>
                            </form>
                            @else
                            <form action="{{route('l_store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                <input type="hidden" value="{{ $book->id}}" name="book_id">
                                @csrf
                                <button type="submit" class="order">like</button>
                            </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <h1 class="list-group-item">No items found</h1>
            @endforelse
        </div>
        <div class=" mt-3">
            {{ $books->links() }}
        </div>
    </div>
</div>
</body>
@endsection