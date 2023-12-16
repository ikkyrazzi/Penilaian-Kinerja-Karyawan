<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung total pegawai
        $totalPegawai = Pegawai::count();

        // Menghitung total pegawai yang sudah dinilai
        $totalDinilai = Penilaian::distinct('nama_pegawai')->count('nama_pegawai');

        // Menghitung total pegawai yang belum dinilai
        $totalBelumDinilai = $totalPegawai - $totalDinilai;

        return view('manager.dashboard', compact('totalPegawai', 'totalDinilai', 'totalBelumDinilai'));
    }
}
