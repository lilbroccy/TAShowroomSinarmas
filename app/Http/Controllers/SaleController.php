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
    $carUnits = CarUnit::all();
    $sales = Sale::all();
        return view('tampilan-admin.table-sales', compact('sales', 'carUnits'));
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

            $updatedAt = Carbon::now()->addHours(7);
            $checkUnit->updated_at = $updatedAt;

            $checkUnit->save();
            Log::info('CheckUnit updated:', $checkUnit->toArray());
            
            $relatedCheckUnits = CheckUnit::where('car_unit_id', $checkUnit->car_unit_id)->get();
            Log::info('Related CheckUnits:', $relatedCheckUnits->toArray());

            foreach ($relatedCheckUnits as $relatedCheckUnit) {
                if ($relatedCheckUnit->id !== $checkUnit->id && ($relatedCheckUnit->status == 'Menunggu Verifikasi' || $relatedCheckUnit->status == 'Disetujui')) {
                    $relatedCheckUnit->status = 'Dibatalkan Oleh Admin';
                    $relatedCheckUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual, Silahkan hubungi admin melalui whatsapp untuk konfirmasi proses pengembalian biaya cek unit';
                    $relatedCheckUnit->car_status = 'Terjual';
                    $relatedCheckUnit->last_edit_by = Auth::id();
                    $relatedCheckUnit->save();
                    Log::info('Related CheckUnit updated:', $relatedCheckUnit->toArray());
                } 
            }

            $sale = new Sale();
            $sale->check_unit_id = $checkUnit->id;
            $sale->user_id = $checkUnit->user_id;
            $sale->car_unit_id = $checkUnit->car_unit_id;
            $sale->customer_name = $checkUnit->user->name;
            $sale->customer_phone = $checkUnit->user->phone;
            $sale->payment_method = $request->paymentMethod;
            $sale->date = now();
            $sale->last_edit_by = Auth::id();
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
            if ($checkUnit->status == 'Menunggu Verifikasi' || $checkUnit->status == 'Disetujui') {
                $checkUnit->status = 'Dibatalkan Oleh Admin';
                $checkUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual, Silahkan hubungi admin melalui whatsapp untuk konfirmasi proses pengembalian biaya cek unit';
                $checkUnit->last_edit_by = Auth::id();
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


}

