<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Halaman Daftar User';
        $data  = User::all();
        return view('pages.users.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Halaman Tambah User';
        return view('pages.users.create', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = new User();
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Data User berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(User $user)
    {
        $title = 'Halaman Edit User';
        return view('pages.users.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = User::find($user->id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Data User berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return back()->with('success', 'Data User berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function resetPassword(User $user)
    {
        try {
            $user->password = bcrypt('password');
            $user->save();
            return back()->with('success', 'Password user berhasil direset');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
