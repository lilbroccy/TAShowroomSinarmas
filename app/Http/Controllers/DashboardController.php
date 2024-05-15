<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarUnit;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Sales;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $month = $request->input('month', $currentMonth);
        $year = $request->input('year', $currentYear);

        $sales = Sales::whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->get();

        $totalOmzet = 0;
        foreach ($sales as $sale) {
            $totalOmzet += $sale->carUnit->price;
        }
        
        $totalSales = $sales->count();
        $totalUser = User::where('role', 'User')->count();
        $totalUnits = CarUnit::where('status', 'Tersedia')->count();

        return view('tampilan-admin.dashboard', compact('totalUnits', 'totalSales', 'totalOmzet', 'totalUser', 'month', 'year'));
    }
}