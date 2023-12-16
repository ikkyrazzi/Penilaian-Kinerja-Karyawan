<?php

namespace App\Http\Controllers\Hrd;

use App\Exports\PegawaiExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hrd\StorePegawaiRequest;
use App\Http\Requests\Hrd\UpdatePegawaiRequest;
use App\Imports\PegawaiImport;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    const TITLE = 'Data Pegawai';
    const URL = 'hrd.pegawais.';
    const FOLDER = 'hrd.pegawai.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $pegawais = Pegawai::latest()->get();
        $jabatans = Jabatan::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'pegawais', 'folder', 'jabatans'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url'));
    }

    public function store(StorePegawaiRequest $request)
    {
        $input = $request->all();

        Pegawai::create($input);

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $pegawais = Pegawai::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        $jabatans = Jabatan::latest()->get();

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'pegawais', 'jabatans'));
    }

    public function update(UpdatePegawaiRequest $request, $id)
    {
        $pegawais = Pegawai::findOrFail($id);

        $input = $request->all();

        $pegawais->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $pegawais = Pegawai::findOrFail($id);

        $pegawais->delete();

        return redirect()->route('hrd.pegawais.index')->with('success', 'Pegawai deleted successfully');
    }

    public function show($id)
    {
        $pegawais = Pegawai::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Pegawai';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'pegawais'));
    }

    public function export() 
    {
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }

    public function import()
    {
        $title = self::TITLE;
        $subtitle = 'Import Data';
        $url = self::URL;

        return view(self::FOLDER . 'import', compact('title', 'subtitle', 'url',));
    }

    public function importProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new PegawaiImport, $file);

        return redirect()->route(self::URL . 'index')->with('success', 'Data Jabatan berhasil diimpor.');
    }
}
