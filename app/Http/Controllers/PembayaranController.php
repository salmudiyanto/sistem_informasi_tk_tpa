<?php

namespace App\Http\Controllers;

use App\Models\IuranBulanan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPembayaran = IuranBulanan::join('siswa', 'iuran_bulanan.siswa_id', '=', 'siswa.id')
                            ->join('tingkat', 'siswa.tingkat_id', '=', 'tingkat.id')
                            ->select(
                                'tingkat.nama_tingkat as tingkat',
                                'iuran_bulanan.bulan',
                                'iuran_bulanan.tahun',
                                'iuran_bulanan.jumlah'
                            )
                            ->groupBy('tingkat.nama_tingkat', 'iuran_bulanan.bulan', 'iuran_bulanan.tahun', 'iuran_bulanan.jumlah')
                            ->orderBy('iuran_bulanan.tahun', 'desc')
                            ->orderBy('iuran_bulanan.bulan', 'desc')
                            ->get();
        // dd($dataPembayaran);       
        return view('admin.v_pembayaran', compact('dataPembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.v_pembayaran_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $dataSiswa = Siswa::where('tingkat_id', $request->tingkat)->get();
        if($dataSiswa->isEmpty()){
            return redirect()->route('pembayaran.index')->withErrors('Tidak ada siswa di tingkat ini');
        }

        foreach ($dataSiswa as $siswa){
            $cek = IuranBulanan::where('siswa_id', $siswa->id)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->first();
                
                if (!$cek) {
                    IuranBulanan::create([
                        'siswa_id'      => $siswa->id,
                        'bulan'         => $request->bulan,
                        'tahun'         => $request->tahun,
                        'jumlah'        => $request->jumlah,
                        'status'        => 'belum',
                        'tanggal_bayar' => null,
                    ]);
            }
        }
        
        return redirect()->route('pembayaran.index')->with('success', 'Data iuran berhasil di generate');
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
