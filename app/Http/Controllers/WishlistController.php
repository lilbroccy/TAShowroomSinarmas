<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\CarUnit;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Anda harus login untuk menambahkan ke wishlist'], 401);
        }
        $request->validate([
            'car_unit_id' => 'required|exists:car_units,id'
        ]);
        $userId = Auth::id();
        $carUnitId = $request->input('car_unit_id');
        $existingWishlist = Wishlist::where('user_id', $userId)->where('car_unit_id', $carUnitId)->first();
        if ($existingWishlist) {
            return response()->json(['message' => 'Item sudah ada di wishlist'], 200);
        }
        Wishlist::create([
            'user_id' => $userId,
            'car_unit_id' => $carUnitId,
        ]);

        return response()->json(['message' => 'Item berhasil ditambahkan ke wishlist'], 201);
    }
}

