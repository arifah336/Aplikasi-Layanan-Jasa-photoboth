<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Photo;
use App\Models\Message;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransactions = Payment::count();
        $totalRevenue = Payment::sum('amount');

        $chartData = Photo::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $messages = Message::latest()->take(5)->get();

        // ✅ Tambahan: Donasi 7 hari terakhir
        $weeklyDonations = Payment::where('payment_date', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(payment_date) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact(
            'totalTransactions', 'totalRevenue',
            'chartData', 'messages', 'weeklyDonations'
        ));
    }
}