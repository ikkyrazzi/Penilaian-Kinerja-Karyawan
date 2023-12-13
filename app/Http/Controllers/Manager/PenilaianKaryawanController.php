<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\StorePenilaianKaryawanRequest;
use App\Http\Requests\Manager\UpdatePenilaianKaryawanRequest;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianKaryawanController extends Controller
{
    const TITLE = 'Data Penilaian Karyawan';
    const URL = 'manager.penilaians.';
    const FOLDER = 'manager.penilaian.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $penilaians = Penilaian::latest()->get();
        $pegawais   = Pegawai::latest()->get();
        $kriterias  = Kriteria::latest()->get();
        
        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'penilaians', 'folder', 'pegawais', 'kriterias'));
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

    public function update(UpdatePenilaianKaryawanRequest $request, $id)
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
        $penilaians = Penilaian::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Penilaian';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'penilaians'));
    }
}
