<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count(); 

        $totalSkorNilai = Penilaian::sum('skor_nilai'); 
        $rataRataSkorNilai = $totalPegawai > 0 ? $totalSkorNilai / $totalPegawai : 0; 

        $totalSkor = Penilaian::sum('skor'); 
        $rataRataSkor = $totalPegawai > 0 ? $totalSkor / $totalPegawai : 0; 

        return view('hrd.dashboard', compact('totalPegawai', 'rataRataSkorNilai', 'rataRataSkor'));
    }

    public function chartData()
    {
        $pegawaiData = Penilaian::selectRaw('nama_pegawai, SUM(skor_nilai) as total_score')
            ->groupBy('nama_pegawai')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();

        $labels = $pegawaiData->pluck('nama_pegawai')->toArray();
        $values = $pegawaiData->pluck('total_score')->toArray();

        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    public function topScores()
    {
        $topScores = Penilaian::selectRaw('nama_pegawai, SUM(skor_nilai) as total_score')
            ->groupBy('nama_pegawai') // You may need to group by 'nama_pegawai' if it's not unique
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();

        return response()->json($topScores);
    }
}
