<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class CBooksController extends Controller
{
    public function index(Request $request)
    {   
        if(!isset($request->category))
        {
            $request->category = 'all';
        }
        if($request->category == 'all')
        {
            $books = (new Book)->paginate(config('app.limit_client'));
        } else {
            $category = (new Category)->where('name', $request->category)->first();
            $books = $category->books()->paginate(config('app.limit_client'));
        }
    
        $categories = (new Category)->all();

        return view('client.books.index', compact('books', 'categories'));
    }

}
