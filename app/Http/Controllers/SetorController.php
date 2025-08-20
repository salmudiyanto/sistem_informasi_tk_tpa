<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\HafalanDoa;
use App\Models\HafalanSiswa;
use App\Models\PerkembanganBacaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = Auth::user();
        $dataGuru = Guru::findOrFail($dataUser->related_id);
        if($dataGuru->bidang == 'TPA'){
            $jmlSiswa = Siswa::where('tingkat_id', '2')->count();
        }else if($dataGuru->bidang == 'TKA'){
            $jmlSiswa = Siswa::where('tingkat_id', '1')->count();
        }else if($dataGuru->bidang == 'Keduanya'){
            $jmlSiswa = Siswa::whereIn('tingkat_id', ['1', '2'])->count();
        }
        
        $jmlMunaqasyah = HafalanDoa::count();
        return view('guru.dashboard', ['jmlSiswa' => $jmlSiswa, 'jmlMunaqasyah' => $jmlMunaqasyah]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hafalan()
    {
        $dataUser = Auth::user();
        $dataGuru = Guru::findOrFail($dataUser->related_id);
        if($dataGuru->bidang == 'TPA'){
            $dataSiswa = Siswa::where('tingkat_id', '2')->get();
        }else if($dataGuru->bidang == 'TKA'){
            $dataSiswa = Siswa::where('tingkat_id', '1')->get();
        }else if($dataGuru->bidang == 'Keduanya'){
            $dataSiswa = Siswa::whereIn('tingkat_id', ['1', '2'])->get();
        }
        return view('guru.hafalan', ['dataSiswa' => $dataSiswa]);

    }

    public function hafalanSiswa($id){
        $siswa = Siswa::with('wali')->find($id);
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
        $idSiswa = $id;
        return view('guru.hafalan_detail', compact('siswa', 'hafalan', 'idSiswa'));
    }

    public function tambahSetor(Request $request, $siswa, $doa){
        $dataUser = Auth::user();
        $dataGuru = Guru::findOrFail($dataUser->related_id);
        HafalanSiswa::create([
            'siswa_id'       => $siswa,
            'hafalan_doa_id'      => $doa,
            'tanggal_setor' => date('Y-m-d'),
            'status' => $request->catatan,
            'guru_id' => $dataUser->related_id

        ]);
        return redirect()->route('setor.hafalan')->with('success', 'Sukses.');

    }

    public function bacaan()
    {
        $dataUser = Auth::user();
        $dataGuru = Guru::findOrFail($dataUser->related_id);
        if($dataGuru->bidang == 'TPA'){
            $dataSiswa = Siswa::where('tingkat_id', '2')->get();
        }else if($dataGuru->bidang == 'TKA'){
            $dataSiswa = Siswa::where('tingkat_id', '1')->get();
        }else if($dataGuru->bidang == 'Keduanya'){
            $dataSiswa = Siswa::whereIn('tingkat_id', ['1', '2'])->get();
        }
        return view('guru.bacaan', ['dataSiswa' => $dataSiswa]);

    }

    public function bacaanSiswa($id){
        $siswa = Siswa::with('wali')->find($id);
        $bacaan = PerkembanganBacaan::with('siswa')->where('perkembangan_bacaan.siswa_id', '=', $id)->get();
        $idSiswa = $id;
        return view('guru.bacaan_detail', compact('siswa', 'bacaan', 'idSiswa'));
    }

    public function simpanBacaan(Request $request, $id){
        $dataUser = Auth::user();
        PerkembanganBacaan::create([
            'siswa_id' => $id,
            'tanggal' => date('Y-m-d'),
            'surat' => $request->surah,
            'ayat_mulai' => $request->awal,
            'ayat_selesai' => $request->akhir,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'guru_id' => $dataUser->related_id
        ]);
        return redirect()->route('setor.bacaan')->with('success', 'Sukses.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
