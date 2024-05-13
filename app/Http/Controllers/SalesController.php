<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\CheckUnit;
use App\Models\User;
use App\Models\CarUnit;
use Auth;

class SalesController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'checkUnitId' => 'required',
            'paymentMethod' => 'required'
        ]);

        try {
            $checkUnit = CheckUnit::findOrFail($request->checkUnitId);
            $checkUnit->status = 'Selesai';
            $checkUnit->last_edit_by = Auth::id();

            $updatedAt = Carbon::now()->addHours(7);
            $checkUnit->updated_at = $updatedAt;

            $checkUnit->save();
            
            $relatedCheckUnits = CheckUnit::where('car_unit_id', $checkUnit->car_unit_id)->get();

            foreach ($relatedCheckUnits as $relatedCheckUnit) {
                if ($relatedCheckUnit->id !== $checkUnit->id) {
                    $relatedCheckUnit->status = 'Dibatalkan Oleh Admin';
                    $relatedCheckUnit->note_from_admin = 'Mohon maaf, unit mobil baru saja terjual';
                } 
                $relatedCheckUnit->save();
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

            $carUnit = CarUnit::findOrFail($checkUnit->car_unit_id);
            $carUnit->status = 'Terjual';
            $carUnit->save();

            return response()->json(['message' => 'Data penjualan berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data penjualan.'], 500);
        }
    }
}
