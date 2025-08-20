<?php

namespace App\Http\Controllers;

use App\Models\HafalanDoa;
use App\Models\IuranBulanan;
use App\Models\PerkembanganBacaan;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliController extends Controller
{
    public function dashboard(){
        $dataUser = Auth::user();
        $dataWali = Wali::findOrFail($dataUser->related_id);
        $dataSiswa = Siswa::where('wali_id', $dataUser->related_id)->get();
        return view('wali.dashboard', compact('dataSiswa', 'dataWali'));
    }
    public function bacaan($id){
        $siswa = Siswa::with('wali')->find($id);
        $bacaan = PerkembanganBacaan::with('siswa')->where('perkembangan_bacaan.siswa_id', '=', $id)->get();
        $idSiswa = $id;
        $hafalan = HafalanDoa::leftJoin('hafalan_siswa', function($join) use ($id) {
            $join->on('hafalan_doa.id', '=', 'hafalan_siswa.hafalan_doa_id')
                 ->where('hafalan_siswa.siswa_id', '=', $id);
        })
        ->leftJoin('guru', 'hafalan_siswa.guru_id', '=', 'guru.id')
        ->select(
            'hafalan_doa.*',
            'hafalan_siswa.tanggal_setor',
            'hafalan_siswa.status',
            'hafalan_siswa.catatan',
            'guru.nama as guru_nama'
        )
        ->orderBy('hafalan_doa.kategori')
        ->orderBy('hafalan_doa.nama_doa')
        ->get();
        return view('wali.bacaan', compact('siswa', 'bacaan', 'idSiswa', 'hafalan'));
    }

    public function pembayaran(){
        $dataUser = Auth::user();
        $waliId = $dataUser->related_id;

        $iuranBulanan = IuranBulanan::with(['siswa' => function($query) use ($waliId) {
            $query->where('wali_id', $waliId);
        }])
        ->whereHas('siswa', function($query) use ($waliId) {
            $query->where('wali_id', $waliId);
        })
        ->get();
        // dd($iuranBulanan);
        return view('wali.iuran', compact('iuranBulanan'));

    }
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
