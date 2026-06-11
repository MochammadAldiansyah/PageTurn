<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::all();
        
        return view('dashboard.role.user.catalog.index', compact('books', 'categories'));
    }

    public function borrowForm(Book $book)
    {
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis, tidak bisa dipinjam.');
        }

        return view('dashboard.role.user.catalog.borrow', compact('book'));
    }

    public function storeBorrow(Request $request, Book $book)
    {
        $request->validate([
            'return_date' => 'required|date|after:today',
            'address' => 'required|string|max:1000',
        ]);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis, tidak bisa dipinjam.');
        }

        DB::transaction(function () use ($request, $book) {
            // Create borrowing record
            $borrowing = Borrowing::create([
                'user_id' => Auth::id(),
                'borrow_date' => now(),
                'address' => $request->address,
                'status' => 'active',
            ]);

            // Create borrowing detail
            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book->id,
                'return_date' => $request->return_date,
                'status' => 'active',
            ]);

            // Decrease book stock
            $book->decrement('stock');
        });

        return redirect()->route('user.borrowings.index')->with('success', 'Buku berhasil dipinjam!');
    }
}
