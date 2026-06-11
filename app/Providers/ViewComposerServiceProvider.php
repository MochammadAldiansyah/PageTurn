<?php

namespace App\Providers;

use App\Models\BorrowingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('dashboard.layouts.app', function ($view) {
            $overdueNotifications = collect();

            if (Auth::check() && Auth::user()->hasRole('user')) {
                $overdueNotifications = BorrowingDetail::with(['book', 'borrowing'])
                    ->whereHas('borrowing', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->where('status', 'active')
                    ->where('return_date', '<', now()->startOfDay())
                    ->get();

                // Auto-update status to overdue
                foreach ($overdueNotifications as $detail) {
                    $detail->update(['status' => 'overdue']);
                }

                // Also fetch already-overdue ones
                $alreadyOverdue = BorrowingDetail::with(['book', 'borrowing'])
                    ->whereHas('borrowing', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->where('status', 'overdue')
                    ->get();

                $overdueNotifications = $alreadyOverdue;
            }

            $view->with('globalOverdueNotifications', $overdueNotifications);
        });
    }

    public function register(): void
    {
        //
    }
}
