<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hrd\StorePenilaianRequest;
use App\Http\Requests\Hrd\UpdatePegawaiRequest;
use App\Http\Requests\Hrd\UpdatePenilaianRequest;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    const TITLE = 'Data Penilaian Karyawan';
    const URL = 'hrd.penilaians.';
    const FOLDER = 'hrd.penilaian.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $penilaians = Penilaian::latest()->get();

        // Get unique nama_pegawai values
        $uniquePegawaiNames = $penilaians->unique('nama_pegawai')->pluck('nama_pegawai');

        // Calculate total skor_nilai for each unique nama_pegawai
        $hasilKinerja = [];
        $totalSkorNilai = []; // Initialize the array here
        foreach ($uniquePegawaiNames as $namaPegawai) {
            $totalSkorNilai[$namaPegawai] = Penilaian::where('nama_pegawai', $namaPegawai)->sum('skor_nilai');

            // Determine the performance category based on the total score
            if ($totalSkorNilai[$namaPegawai] >= 3.5 && $totalSkorNilai[$namaPegawai] <= 5) {
                $hasilKinerja[$namaPegawai] = 'Kinerja Bagus';
            } elseif ($totalSkorNilai[$namaPegawai] >= 2 && $totalSkorNilai[$namaPegawai] < 3.5) {
                $hasilKinerja[$namaPegawai] = 'Kinerja Cukup';
            } elseif ($totalSkorNilai[$namaPegawai] >= 1 && $totalSkorNilai[$namaPegawai] < 2) {
                $hasilKinerja[$namaPegawai] = 'Kinerja Tidak Bagus';
            } 
        }

        $pegawais = Pegawai::latest()->get();
        $kriterias = Kriteria::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'penilaians', 'folder', 'pegawais', 'kriterias', 'uniquePegawaiNames', 'hasilKinerja', 'totalSkorNilai'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        $pegawais = Pegawai::latest()->get();
        $kriterias = Kriteria::latest()->get();

        // Initialize an empty collection
        $penilaians = collect();

        // Check if a pegawai is selected
        if(request('nip')) {
            // Retrieve the penilaians related to the selected pegawai
            $penilaians = Penilaian::where('nip', request('nip'))->get();
        }

        return view(self::FOLDER . 'create', compact('title', 'subtitle', 'url', 'pegawais', 'kriterias', 'penilaians'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'waktu_penilaian' => 'required',
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'nama_penilai' => 'required',
            'skor' => 'required',
            'bobot' => 'required',
            'skor_nilai' => 'required',
            'hasil' => 'required',
        ]);

        $penilaiansData = [];

        foreach ($validatedData['id_kriteria'] as $kriteriaId) {
            $skor = isset($validatedData['skor'][$kriteriaId]) ? $validatedData['skor'][$kriteriaId] : null;
            $bobot = $validatedData['bobot'][$kriteriaId];

            $skor_nilai = $skor * ($bobot / 100);

            $penilaiansData[] = [
                'id_kriteria' => $kriteriaId,
                'nama_kriteria' => $validatedData['nama_kriteria'][$kriteriaId],
                'waktu_penilaian' => $validatedData['waktu_penilaian'],
                'nip' => $validatedData['nip'],
                'nama_pegawai' => $validatedData['nama_pegawai'],
                'nama_penilai' => $validatedData['nama_penilai'],
                'skor' => $skor,
                'bobot' => $bobot,
                'skor_nilai' => $skor_nilai,
            ];
        }

        
        foreach ($penilaiansData as $penilaianData) {
            \App\Models\Penilaian::create($penilaianData);
        }

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $penilaians = Penilaian::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'penilaians', 'jabatans'));
    }

    public function update(UpdatePegawaiRequest $request, $id)
    {
        $penilaians = Penilaian::findOrFail($id);

        $input = $request->all();

        $penilaians->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $penilaians = Penilaian::findOrFail($id);

        $penilaians->delete();

        return redirect()->route('hrd.penilaians.index')->with('success', 'Penilaian deleted successfully');
    }

    public function show($id)
{
    $penilaian = Penilaian::findOrFail($id);

    $title = self::TITLE;
    $subtitle = 'Detail Penilaian';
    $url = self::URL;

    // Check if the 'pegawai' relationship is loaded
    $penilaian->load('pegawai');

    $totalSkorNilai = [];
    $totalSkorNilai[$penilaian->nama_pegawai] = Penilaian::where('nama_pegawai', $penilaian->nama_pegawai)->sum('skor_nilai');

    // Fetch kriteria and skor_nilai based on $penilaian->id
    $kriteriaSkor = Penilaian::where('nama_pegawai', $penilaian->nama_pegawai)
        ->pluck('skor_nilai', 'nama_kriteria')
        ->toArray();

    return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'penilaian', 'totalSkorNilai', 'kriteriaSkor'));
}

}
