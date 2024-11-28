<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $books = Books::all(); // Daftar buku
        return view('reviewer.createReviews', compact('books'));
    }
    
    public function create($id)
    {
        $book = Books::findOrFail($id);
        return view('reviewer.createReview', compact('book'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'book_id' => 'required|exists:books,id',
        'review' => 'required|string',
        'tags' => 'required|array|min:1', // Pastikan tags adalah array dan minimal 1 tag
        'tags.*' => 'string', // Setiap tag harus berupa string
    ]);

    Review::create([
        'book_id' => $validated['book_id'],
        'user_id' => auth()->id(),
        'review' => $validated['review'],
        'tags' => $validated['tags'], // Menyimpan tags sebagai string
    ]);

    return redirect()->route('buku')->with('success', 'Review berhasil disimpan.');
}

    public function show($id)
    {
        $reviews = Review::where('book_id', $id)->get();

        return view('reviewer.ReviewerShow', compact('reviews'));
    }

    public function showBooksByTag($tag)
    {
        $reviews = Review::whereJsonContains('tags', $tag)  
                        ->with(['book']) 
                        ->get();
                      
        $books = $reviews->map(function ($review) {
            return $review->book;
        })->unique('id');  
    

        return view('reviewer.booksByTag', compact('books', 'tag'));
    }
    

}