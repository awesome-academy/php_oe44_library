<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Collection;

class CBooksController extends Controller
{
    public function index(Request $request)
    {   
        if($request->category == 'all' || !isset($request->category))
        {
            $books = Book::paginate(config('app.limit_client'));
        } else {
            $category = Category::where('name', $request->category)->first();
            if($category->childrent()->get()->count() > 0){
                $books = new Collection();
                foreach($category->childrent as $child)
                {
                    $books = $books->merge($child->books()->get());
                }

                $books = new \Illuminate\Pagination\LengthAwarePaginator(
                    $books->forPage($request->page, config('app.limit_client')), 
                    $books->count(),  
                    config('app.limit_client'),
                    $request->page,
                    ['path' => url('all-books/'.$category->name)]
                );
            } else {
                $books = $category->books()->paginate(config('app.limit_client'));
            }
        }
        $categories = Category::all();
        
        return view('client.books.index', compact('books', 'categories'));
    }

}
