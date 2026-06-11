<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $allBorrowings = BorrowingDetail::with(['book', 'borrowing'])
            ->whereHas('borrowing', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->latest()
            ->get();

        // Automatically update status to overdue if return date passed
        foreach ($allBorrowings as $detail) {
            if ($detail->status === 'active' && $detail->return_date < now()->startOfDay()) {
                $detail->update(['status' => 'overdue']);
                $detail->status = 'overdue';
            }
        }

        $activeBorrowings = $allBorrowings->whereIn('status', ['active', 'overdue']);
        $historyBorrowings = $allBorrowings->where('status', 'returned')->take(5);

        $stats = [
            'active_count' => $activeBorrowings->count(),
            'due_soon_count' => $activeBorrowings->where('return_date', '<=', now()->addDays(3))->count(),
            'total_borrowed' => $allBorrowings->count()
        ];

        return view('dashboard.role.user.dashboard', compact('activeBorrowings', 'historyBorrowings', 'stats'));
    }
}
