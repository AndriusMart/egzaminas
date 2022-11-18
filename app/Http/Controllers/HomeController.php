<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{



    public function homeList(Request $request)
    {
        $books = Book::where('id', '>', '0');
        if ($request->subCat || $request->cat || $request->sort) {
            if ($request->cat) {
                $books = $books->where('category_id', 'like', '%' . $request->cat  . '%');
            }

            if ($request->sort == 'price_asc') {
                $books = $books->orderBy('pages', 'asc');
            } else if ($request->sort == 'price_desc') {
                $books = $books->orderBy('pages', 'desc');
            }
            if ($request->sort == 'rate_asc') {
                $books = $books->orderBy('rating', 'asc');
            } else if ($request->sort == 'rate_desc') {
                $books = $books->orderBy('rating', 'desc');
            } else if ($request->sort == 'title_asc') {
                $books = $books->orderBy('title', 'asc');
            } else if ($request->sort == 'title_desc') {
                $books = $books->orderBy('title', 'desc');
            }
        }
        $perPage = match ($request->per_page) {
            '5' => 5,
            '11' => 11,
            '20' => 20,
            default => 11
        };

        if ($request->s) {
            $books = $books->where('title', 'like', '%' . $request->s . '%');
        }


        return view('home.index', [
            'books' => $books->orderBy('title', 'asc')->paginate($perPage)->withQueryString(),
            'categories' => Category::orderBy('title', 'desc')->get(),
            'cat' => $request->cat ?? '0',
            'sort' => $request->sort ?? '0',
            'orders' => Order::orderBy('updated_at', 'desc')->get(),
            'likes' => Like::orderBy('updated_at', 'desc')->get(),
            'sortSelect' => Book::SORT_SELECT,
            's' => $request->s ?? '',
            'perPage' => $request->per_page
        ]);
    }
    public function rate(Request $request, Book $book)
    {
        $votes = json_decode($book->votes ?? json_encode([]));
        if (in_array(Auth::user()->id, $votes)) {
            return redirect()->back()->with('not', 'You already rated this item');
        }
        $votes[] = Auth::user()->id;
        $book->votes = json_encode($votes);
        $book->rating_sum = $book->rating_sum + $request->rate;
        $book->rating_count++;
        $book->rating = $book->rating_sum / $book->rating_count;
        $book->save();
        return redirect()->back()->with('ok', 'Thanks for rating this item');
    }


}
