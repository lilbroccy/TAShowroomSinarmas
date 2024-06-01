<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarUnit;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Sale;
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

    // Penjualan biasa
    $sales = Sale::whereHas('carUnit', function ($query) {
                        $query->where('type', 'Bukan Titipan');
                    })
                    ->whereYear('date', $year)
                    ->whereMonth('date', $month)
                    ->get();

    // Penjualan titipan
    $salesTitipan = Sale::whereHas('carUnit', function ($query) {
                            $query->where('type', 'Titipan');
                        })
                        ->whereYear('date', $year)
                        ->whereMonth('date', $month)
                        ->get();

    $totalOmzet = 0;
    foreach ($sales as $sale) {
        $totalOmzet += $sale->carUnit->price;
    }
    
    $totalSales = $sales->count();
    $totalUser = User::where('role', 'User')->count();
    $totalUnits = CarUnit::where('status', 'Tersedia')->count();

    // Total penjualan titipan
    $totalSalesTitipan = $salesTitipan->count();

    // Total unit titipan
    $totalUnitsTitipan = CarUnit::where('type', 'Titipan')->where('status', 'Tersedia')->count();
    $totalReqUnitsTitipan = CarUnit::where('type', 'Titipan')->where('type_status', 'Menunggu Verifikasi')->count();
    // Total fee
    $totalFeeTitipan = 0;
    foreach ($salesTitipan as $sale) {
        $totalFeeTitipan += $sale->carUnit->fee;
    }

    return view('tampilan-admin.dashboard', compact('totalUnits', 'totalSales', 'totalOmzet', 'totalUser', 'month', 'year', 'totalSalesTitipan', 'totalUnitsTitipan', 'totalFeeTitipan', 'totalReqUnitsTitipan'));
}

}