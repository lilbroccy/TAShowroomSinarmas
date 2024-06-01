<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\CheckUnit;
use App\Models\User;
use App\Models\CarUnit;
use Auth;
use Log;

class SaleController extends Controller
{

    public function index(){
        $carUnits = CarUnit::where('type', 'Bukan Titipan')->get();
        $sales = Sale::whereHas('carUnit', function($query) {
            $query->where('type', '=', 'Bukan Titipan');
        })->get();
        return view('tampilan-admin.table-sales', compact('sales', 'carUnits'));
    }

    public function indexTitipan(){
        $carUnits = CarUnit::where('type', 'Titipan')->get();
        $sales = Sale::whereHas('carUnit', function($query) {
            $query->where('type', '=', 'Titipan');
        })->get();
        return view('tampilan-admin.table-sales-titipan', compact('sales', 'carUnits'));
    }

    public function save(Request $request)
{
    $request->validate([
        'checkUnitId' => 'required',
        'paymentMethod' => 'required'
    ]);

    Log::info('Request data:', $request->all());

    try {
        $checkUnit = CheckUnit::findOrFail($request->checkUnitId);
        Log::info('Found CheckUnit:', $checkUnit->toArray());

        $checkUnit->status = 'Selesai';
        $checkUnit->car_status = 'Terjual';
        $checkUnit->last_edit_by = Auth::id();
        $checkUnit->updated_at = Carbon::now()->addHours(7);

        $checkUnit->save();
        Log::info('CheckUnit updated:', $checkUnit->toArray());

        $relatedCheckUnits = CheckUnit::where('car_unit_id', $checkUnit->car_unit_id)->get();
        Log::info('Related CheckUnits:', $relatedCheckUnits->toArray());

        foreach ($relatedCheckUnits as $relatedCheckUnit) {
            if ($relatedCheckUnit->id !== $checkUnit->id && 
                ($relatedCheckUnit->status == 'Menunggu Verifikasi' || $relatedCheckUnit->status == 'Disetujui')) {
                
                $relatedCheckUnit->status = 'Dibatalkan Oleh Sistem';
                // $relatedCheckUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual';
                $relatedCheckUnit->last_edit_by = Auth::id();
                $relatedCheckUnit->updated_at = Carbon::now()->addHours(7);

                $relatedCheckUnit->save();
                Log::info('Related CheckUnit updated:', $relatedCheckUnit->toArray());
            }
        }

        $sale = new Sale();
        $sale->check_unit_id = $checkUnit->id;
        $sale->car_unit_id = $checkUnit->car_unit_id;
        $sale->payment_method = $request->paymentMethod;
        $sale->date = now();
        $sale->last_edit_by = Auth::id();

        if ($checkUnit->user) {
            $sale->user_id = $checkUnit->user_id;
            $sale->customer_name = $checkUnit->user->name;
            $sale->customer_phone = $checkUnit->user->phone;
        } else {
            $sale->customer_name = $checkUnit->name;
            $sale->customer_phone = $checkUnit->phone;
        }

        $sale->save();
        Log::info('Sale data saved:', $sale->toArray());

        $carUnit = CarUnit::findOrFail($checkUnit->car_unit_id);
        $carUnit->status = 'Terjual';
        $carUnit->save();
        Log::info('CarUnit updated:', $carUnit->toArray());

        return response()->json(['message' => 'Data penjualan berhasil disimpan.']);
    } catch (\Exception $e) {
        Log::error('Error occurred:', ['exception' => $e]);
        return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data penjualan.', 'error' => $e->getMessage()], 500);
    }
}


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'payment' => 'required',
            ]);

            $carUnit = CarUnit::find($request->car_id);
            if (!$carUnit) {
                return redirect()->back()->with('error', 'Mobil tidak ditemukan!');
            }

            $checkUnits = CheckUnit::where('car_unit_id', $carUnit->id)->get();
            foreach ($checkUnits as $checkUnit) {
                if ($checkUnit->status == 'Menunggu Verifikasi' || $checkUnit->status == 'Disetujui' ) {
                    $checkUnit->status = 'Dibatalkan Oleh Sistem';
                    // $checkUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual';
                    $checkUnit->last_edit_by = Auth::id();
                    $updatedAt = Carbon::now()->addHours(7);
                    $checkUnit->updated_at = $updatedAt;
                    $checkUnit->save();
                } 
            }
            
            $sale = new Sale();
            $sale->car_unit_id = $request->car_id;
            $sale->customer_name = $request->name;
            $sale->customer_phone = $request->phone;
            $sale->payment_method = $request->payment;
            $sale->date = now()->toDateString();
            $sale->last_edit_by = Auth::id();
            $sale->save();

            $carUnit->status = 'Terjual';
            $carUnit->save();

            return redirect()->back()->with('success', 'Data penjualan berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return response()->json($sale);
    }
}

