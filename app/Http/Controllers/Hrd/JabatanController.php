<?php

namespace App\Http\Controllers\Hrd;

use App\Exports\JabatanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hrd\StoreJabatanRequest;
use App\Http\Requests\Hrd\UpdateJabatanRequest;
use App\Imports\JabatanImport;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JabatanController extends Controller
{
    const TITLE = 'Data Jabatan';
    const URL = 'hrd.jabatans.';
    const FOLDER = 'hrd.jabatan.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $jabatans = Jabatan::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'jabatans', 'folder'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url'));
    }

    public function store(StoreJabatanRequest $request)
    {
        $input = $request->all();

        Jabatan::create($input);

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $jabatans = Jabatan::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'jabatans'));
    }

    public function update(UpdateJabatanRequest $request, $id)
    {
        $jabatans = Jabatan::findOrFail($id);

        $input = $request->all();

        $jabatans->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $jabatans = Jabatan::findOrFail($id);

        $jabatans->delete();

        return redirect()->route('hrd.jabatans.index')->with('success', 'jabatan deleted successfully');
    }

    public function show($id)
    {
        $jabatans = Jabatan::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Jabatan';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'jabatans'));
    }

    public function export() 
    {
        return Excel::download(new JabatanExport, 'jabatan.xlsx');
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

        Excel::import(new JabatanImport, $file);

        return redirect()->route(self::URL . 'index')->with('success', 'Data Jabatan berhasil diimpor.');
    }
}
