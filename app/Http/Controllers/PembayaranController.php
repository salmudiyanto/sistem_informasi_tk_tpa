<?php

namespace App\Http\Controllers;

use App\Models\IuranBulanan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    private function formatNomor($nomor)
    {
        $nomor = preg_replace('/[^0-9\+]/', '', $nomor);
    
        if (substr($nomor, 0, 1) === '0') {
            return '62' . substr($nomor, 1);
        } elseif (substr($nomor, 0, 1) === '+') {
            return substr($nomor, 1);
        }
    
        return $nomor;
    }

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

                    if (!empty($siswa->wali) && !empty($siswa->wali->telepon)) {
                        $nomorWA = $this->formatNomor($siswa->wali->telepon);
            
                        $pesan = "*Invoice Iuran Bulanan*\n\n".
                                 "Nama Siswa : {$siswa->nama}\n".
                                 "Orang Tua  : {$siswa->wali->nama}\n".
                                 "Bulan      : {$request->bulan}\n".
                                 "Tahun      : {$request->tahun}\n".
                                 "Jumlah     : Rp " . number_format($request->jumlah, 0, ',', '.') . "\n".
                                 "Status     : BELUM DIBAYAR\n\n".
                                 "Mohon segera melakukan pembayaran. Terima kasih 🙏";
            
                        // Http::withHeaders([
                        //     'Authorization' => 'Bearer ' . env('GNqBYCDhswRh96KfuPwc'),
                        // ])->post('https://api.fontte.com/messages', [
                        //     'phone'   => $nomorWA,
                        //     'message' => $pesan,
                        // ]);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://api.fonnte.com/send',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array(
                        'target' => $nomorWA,
                        'message' => $pesan, 
                        'countryCode' => '62', //optional
                        ),
                          CURLOPT_HTTPHEADER => array(
                            "Authorization: GNqBYCDhswRh96KfuPwc" //change TOKEN to your actual token
                          ),
                        ));
                        
                        $response = curl_exec($curl);
                        if (curl_errno($curl)) {
                          $error_msg = curl_error($curl);
                        }
                        curl_close($curl);
                        if(isset($error_msg)){
                            echo $error_msg;
                          }else{
                            echo 'sukses';
                          }
                    }

            }
        }
        
        // return redirect()->route('pembayaran.index')->with('success', 'Data iuran berhasil di generate');
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
