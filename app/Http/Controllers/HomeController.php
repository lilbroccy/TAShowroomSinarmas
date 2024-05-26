<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarUnit;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Sale;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::whereHas('carUnits', function($query) {
            $query->where('status', 'Tersedia');
        })->get();
        $carUnits = CarUnit::all();

        foreach ($carUnits as $carUnit) {
            $carUnit->first_photo = $carUnit->photos->isNotEmpty() ? $carUnit->photos->first()->file_path : null;
        }
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->get();
        $totalWishlist = $wishlists->count();
        return view('tampilan-user.home', compact('categories', 'carUnits', 'wishlists', 'totalWishlist'));
    }

    //get detail sweetalert
    public function getDetail($id)
    {
        $carUnit = CarUnit::find($id);

        if (!$carUnit) {
            return response()->json(['error' => 'Car unit not found'], 404);
        }

        $secondPhotoUrl = null;
        $thirdPhotoUrl = null;

        $photos = $carUnit->photos;

        if ($photos->count() > 1) {
            $secondPhotoUrl = $photos[1]->file_path;
        }

        if ($photos->count() > 2) {
            $thirdPhotoUrl = $photos[2]->file_path;
        }

        // Mengembalikan detail carUnit dalam format JSON
        return response()->json([
            'name' => $carUnit->name,
            'price' => $carUnit->price,
            'description' => $carUnit->description,
            'image_url_1' => $carUnit->photos->first()->file_path,
            'image_url_2' => $secondPhotoUrl,
            'image_url_3' => $thirdPhotoUrl
        ]);
    }

    public function getBrands(){
        $brands = Brand::all();
        return view('tampilan-admin.car-units', compact('brands'));
    }

    public function getCarDetail($id)
    {
        $userId = Auth::id();
        $wishlists = Wishlist::where('user_id', $userId)->get();
        $totalWishlist = $wishlists->count();
        $carUnit = CarUnit::find($id);
        $categories = Category::all();
        return view('tampilan-user.car-detail', compact('carUnit','categories', 'wishlists', 'totalWishlist'));
    }
    
}
