<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\CheckUnit;
use App\Models\User;
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
            $sales = new Sales();
            $sales->check_unit_id = $checkUnit->id;
            $sales->user_id = $checkUnit->user_id;
            $sales->car_unit_id = $checkUnit->car_unit_id;
            $sales->customer_name = $checkUnit->user->name;
            $sales->customer_phone = $checkUnit->user->phone;
            $sales->payment_method = $request->paymentMethod;
            $sales->last_edit_by = Auth::id();
            $sales->save();

            return response()->json(['message' => 'Data penjualan berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data penjualan.'], 500);
        }
    }
}
