<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function index()
    {
        $dataWali = Wali::withCount('siswa')->get();
        return view('admin.v_wali', compact('dataWali'));
    }

    public function create()
    {
        return view('admin.v_wali_tambah');
    }
    
     public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'alamat'    => 'required|string|max:200',
            'telepon'   => 'nullable|string|max:20',
            'email'     => 'nullable|email|unique:users,email',
            'password'   => 'required',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        $wali = Wali::create($request->only(['nama','alamat','telepon','email','pekerjaan']));

        if ($request->email) {
            User::create([
                'name'       => $request->nama,
                'email'      => $request->email,
                'password'   => bcrypt($request->password), 
                'role'       => 'wali',
                'related_id' => $wali->id,
            ]);
        }

        return redirect()->route('wali.index')->with('success', 'Data wali berhasil disimpan.');
    }

    public function edit($id)
    {
        $wali = Wali::findOrFail($id);
        return view('admin.v_wali_edit', compact('wali'));
    }

     public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'alamat'    => 'required|string|max:200',
            'telepon'   => 'nullable|string|max:20',
            'email'     => 'nullable|email|unique:users,email,' . $id . ',related_id',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        $wali = Wali::findOrFail($id);
        $wali->update($request->only(['nama','alamat','telepon','email','pekerjaan']));

        if ($wali->user) {
            $wali->user->update([
                'name'  => $request->nama,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('wali.index')->with('success', 'Data wali berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $wali = Wali::findOrFail($id);

        if ($wali->user) {
            $wali->user->delete();
        }

        $wali->delete();

        return redirect()->route('wali.index')->with('success', 'Data wali berhasil dihapus.');
    }

    public function show($id)
    {
        $wali = Wali::with('siswa.tingkat')->findOrFail($id);
        return view('admin.v_wali_detail', compact('wali'));
    }
}
