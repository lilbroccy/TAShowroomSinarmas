<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\CheckUnit;
use App\Models\User;
use App\Models\CarUnit;
use Auth;
use Log;

class SalesController extends Controller
{
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
                    $relatedCheckUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual, Silahkan hubungi admin melalui whatsapp untuk konfirmasi proses pengembalian biaya check unit';
                    $relatedCheckUnit->save();
                    Log::info('Related CheckUnit updated:', $relatedCheckUnit->toArray());
                } 
            }

            $sales = new Sales();
            $sales->check_unit_id = $checkUnit->id;
            $sales->user_id = $checkUnit->user_id;
            $sales->car_unit_id = $checkUnit->car_unit_id;
            $sales->customer_name = $checkUnit->user->name;
            $sales->customer_phone = $checkUnit->user->phone;
            $sales->payment_method = $request->paymentMethod;
            $sales->date = now();
            $sales->last_edit_by = Auth::id();
            $sales->save();
            Log::info('Sales data saved:', $sales->toArray());

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
}

