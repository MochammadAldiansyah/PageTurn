<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowingDetail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'active_borrowings' => BorrowingDetail::whereIn('status', ['active', 'overdue'])->count(),
            'overdue_borrowings' => BorrowingDetail::where('status', 'overdue')->count(),
            'total_users' => User::whereHas('roles', function($q) { $q->where('name', 'user'); })->count(),
        ];

        $recentBorrowings = BorrowingDetail::with(['borrowing.user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.role.admin.dashboard', compact('stats', 'recentBorrowings'));
    }
}
