<?php

namespace App\Http\Controllers;

use App\Models\HafalanDoa;
use Illuminate\Http\Request;

class MunaqasahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataHafalan = HafalanDoa::get();
        return view('admin.v_hafalan', compact('dataHafalan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.v_hafalan_tambah');
        
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
            'nama_doa' => 'required|string|max:100',
            'kategori' => 'required|in:Qiraah,Bacaan Solat,Surah Pendek,Doa Harian,Ayat Pilihan,Lainnya',
        ]);

        HafalanDoa::create($request->all());

        return redirect()->route('munaqasah.index')->with('success', 'Data Hafalan berhasil ditambahkan.');
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
        $hafalan = HafalanDoa::findOrFail($id);
        return view('admin.v_hafalan_edit', compact('hafalan'));
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
        $request->validate([
            'nama_doa' => 'required|string|max:100',
            'kategori' => 'required|in:Qiraah,Bacaan Solat,Surah Pendek,Doa Harian,Ayat Pilihan,Lainnya',
        ]);
        $hafalan = HafalanDoa::findOrFail($id);
        $hafalan->update($request->only(['nama_doa','kategori']));
        // $hafalan->update($request->all());

        return redirect()->route('munaqasah.index')->with('success', 'Data Hafalan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $hafalan = HafalanDoa::findOrFail($id);

        $hafalan->delete();
        return redirect()->route('munaqasah.index')->with('success', 'Data Hafalan berhasil dihapus.');
    }
}
