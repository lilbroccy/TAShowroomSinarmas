<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{   
    public function index()
    {
        $users = User::all();
        $currentUserRole = Auth::user()->role;
        return view('tampilan-admin.table-user', compact('users', 'currentUserRole'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        return response()->json(['message' => 'Profile updated successfully.']);
    }
    public function destroy($id)
    {
        try {

            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'Data pengguna berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data pengguna'], 500);
        }
    }

    public function update_table(Request $request, $id)
    {   

        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'role' => 'required',
        ]);
        $user->update($request->all());
        return response()->json(['message' => 'Data pengguna berhasil diperbarui.']);
    }

}
