<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\HafalanDoa;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $jmlSiswa = Siswa::count();
        $jmlGuru = Guru::count();
        $jmlMunaqasyah = HafalanDoa::count();
        $jmlWali = Wali::count();
        return view('admin.dashboard', ['jmlSiswa' => $jmlSiswa, 'jmlWali' => $jmlWali, 'jmlGuru' => $jmlGuru, 'jmlMunaqasyah' => $jmlMunaqasyah]);
    }

    public function guruHome(){
        $dataGuru = Guru::get();
        return view('admin.v_guru', ['dataGuru' => $dataGuru]);
    }

    public function gurutambah(){
        return view('admin.v_guru_tambah');
    }

    public function muridHome(){
        $dataSiswa = Siswa::get();
        return view('admin.v_murid', ['dataSiswa' => $dataSiswa]);
    }

    public function muridTambah(){
        return view('admin.v_murid_tambah');
    }

    public function waliHome(){
        $dataWali = Wali::withCount('siswa')->get();
        return view('admin.v_wali', compact('dataWali'));
    }

    public function waliTambah(){
        return view('admin.v_wali_tambah');
    }

    public function waliSimpan(Request $request){
        $request->validate([
            'nama'      => 'required|string|max:100',
            'alamat'    => 'required|string|max:200',
            'telepon'   => 'nullable|string|max:20',
            'email'     => 'nullable|email|unique:users,email',
            'password'   => 'required',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        $wali = Wali::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'telepon'   => $request->telepon,
            'email'     => $request->email,
            'pekerjaan' => $request->pekerjaan,
        ]);

        if ($request->email) {
            User::create([
                'name'       => $request->nama,
                'email'      => $request->email,
                'password'   => bcrypt($request->password),
                'role'       => 'wali',
                'related_id' => $wali->id,
            ]);
        }

        return redirect()->route('waliHome')->with('success', 'Data wali berhasil disimpan.');
    }
    
}
