<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $dataGuru = Guru::get();
        return view('admin.v_guru', compact('dataGuru'));
    }

    public function create()
    {
        return view('admin.v_guru_tambah');
    }
    
     public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:guru,email',
            'password'   => 'required',
            'bidang' => 'nullable|string|in:TK,TPA,Keduanya',
        ]);

        $wali = Guru::create($request->only(['nama','jenis_kelamin','alamat','telepon','email','bidang']));

        if ($request->email) {
            User::create([
                'name'       => $request->nama,
                'email'      => $request->email,
                'password'   => bcrypt($request->password), 
                'role'       => 'guru',
                'related_id' => $wali->id,
            ]);
        }

        return redirect()->route('guru.index')->with('success', 'Data Gueu berhasil disimpan.');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.v_guru_edit', compact('guru'));
    }

     public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
            'bidang' => 'nullable|string|max:255',
        ]);

        $guru = Guru::findOrFail($guru->id);
        $guru->update($request->only(['nama','alamat','telepon','email','pekerjaan']));

        if ($guru->user) {
            $guru->user->update([
                'name'  => $request->nama,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->user) {
            $guru->user->delete();
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data wali berhasil dihapus.');
    }

    public function show(Guru $guru)
    {
        return view('admin.v_guru_detail', compact('guru'));
    }
    
}
