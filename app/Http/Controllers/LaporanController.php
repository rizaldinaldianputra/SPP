<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Kelas;
use App\Spp;
use App\Siswa;
use App\User;
use App\Pembayaran;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Kelas::get();
        $tampil['data'] = $data;
        //ambil tampilan resources/views/kelas/pdf.blade.php
        $pdf = PDF::loadView("kelas.pdf", $tampil);
        return $pdf->download('Laporan_Kelas.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function siswa(Request $request)
    {
        //$data = Siswa::get();
        foreach ($data as $item) {
            $item->kelas = Kelas::find($item->id_kelas);
            $item->spp = Spp::find($item->id_spp);
            $item->user = Siswa::find($item->id_user);
        }
        $tampil['data'] = $data;
        //ambil tampilan resources/views/siswa/pdf.blade.php
        $pdf = PDF::loadView("siswa.pdf", $tampil);
        return $pdf->download('Laporan_Siswa.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function spp(Request $request)
    {
        //
        $data = Spp::get();
        $tampil['data'] = $data;
        //ambil tampilan resources/views/spp/pdf.blade.php
        $pdf = PDF::loadView("spp.pdf", $tampil);
        return $pdf->download('Laporan_SPP.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function petugas(Request $request)
    {
        $data = User::where("hak_akses", "petugas")->get();
        $tampil['data'] = $data;
        //ambil tampilan resources/views/petugas/pdf.blade.php
        $pdf = PDF::loadView("petugas.pdf", $tampil);
        return $pdf->download('Laporan_Petugas.pdf');
    }
    public function pembayaran(Request $request)
    {
        $data = Pembayaran::get();
        foreach ($data as $item) {
            $item->siswa = Siswa::find($item->nisn);
            $item->spp = Spp::find($item->id_spp);
            $item->user = User::find($item->id_user);
        }
        $tampil['data'] = $data;
        //ambil tampilan resources/views/pembayaran/pdf.blade.php
        $pdf = PDF::loadView("pembayaran.pdf", $tampil);
        return $pdf->download('Laporan_Pembayaran.pdf');
    }
}
