<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //ambil data max 10
        $data = Kelas::paginate(10);
        //membuat variabel tampil yang diisi dengan data
        $tampil['data'] = $data;
        //tampilkan resources/views/kelas/index.blade.php beserta variabel tampil
        return view("kelas.index", $tampil);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("kelas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validasi inputan
        $this->validate($request, [
            'nama_kelas' => 'required|unique:kelas',
            'kompetensi_keahlian' => 'required'
        ]);
        $data = Kelas::create($request->all());
        return redirect()->route("kelas.index")->with(
            "success",
            "Data berhasil disimpan."
        );
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
    public function edit($kela)
    {
        //
        $data = Kelas::findOrFail($kela);
        //tampilkan resources/views/kelas/edit.blade.php
        return view("kelas.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kela)
        {
            //
        //validasi inputan
        $this->validate($request, [
            'nama_kelas' => 'required',
            'kompetensi_keahlian' => 'required'
        ]);
        $data = Kelas::findOrFail($kela);
        $data->nama_kelas = $request->nama_kelas;
        $data->kompetensi_keahlian = $request->kompetensi_keahlian;
        $data->save();
        return redirect()->route("kelas.index")->with(
            "success",
            "Data berhasil diubah."
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kela)
    {
        //
        $data = Kelas::findOrFail($kela);
        $data->delete();
    }
}
