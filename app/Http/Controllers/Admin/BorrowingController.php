<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $details = BorrowingDetail::with(['borrowing.user', 'book'])
            ->latest()
            ->paginate(15);
            
        return view('dashboard.role.admin.borrowings.index', compact('details'));
    }

    public function markReturned(BorrowingDetail $detail)
    {
        if ($detail->status === 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($detail) {
            $detail->update(['status' => 'returned']);
            
            // Check if all details for this borrowing are returned
            $borrowing = $detail->borrowing;
            $allReturned = $borrowing->details()->where('status', '!=', 'returned')->doesntExist();
            
            if ($allReturned) {
                $borrowing->update(['status' => 'returned']);
            }

            // Increase book stock
            if ($detail->book) {
                $detail->book->increment('stock');
            }
        });

        return back()->with('success', 'Status peminjaman berhasil diperbarui menjadi RETURNED.');
    }
}
