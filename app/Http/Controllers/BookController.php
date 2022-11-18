<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Like;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'books' => Book::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'pages' => 'required|numeric',
                'isbn' => 'required|min:4',
                'about' => 'required|min:20',
            ],
        );


        Book::create([
            'title' => $request->title,
            'pages' => $request->pages,
            'isbn' => $request->isbn,
            'about' => $request->about,
            'category_id' => $request->category_id,
        ])->addImages($request->file('photo'));

        return redirect()->route('b_index')->with('ok', 'New book created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view(
            'book.show',
            [
                'book' => $book,
                'orders' => Order::orderBy('updated_at', 'desc')->get(),
                'likes' => Like::orderBy('updated_at', 'desc')->get(),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view(
            'book.edit',
            [
                'book' => $book,
                'categories' => Category::orderBy('updated_at', 'desc')->get(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate(
            [
                'title' => 'required|min:3',
                'pages' => 'required|numeric',
                'isbn' => 'required|min:4',
                'photo.*' => 'sometimes|required|mimes:jpg|max:5000',
                'about' => 'required|min:20',
            ],
        );


        $book->update([
            'title' => $request->title,
            'pages' => $request->pages,
            'isbn' => $request->isbn,
            'about' => $request->about,
            'category_id' => $request->category_id,
        ]);
        $book->removeImages($request->delete_photo)->addImages($request->file('photo'));

        return redirect()->route('b_index')->with('ok', 'New book created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if($book->getPhotos()->count()){
            $delIds = $book->getPhotos()->pluck('id')->all();
            $book->removeImages($delIds);
        }

        $book->delete();
        return redirect()->route('b_index')->with('ok', 'deleted');
    }
    }

