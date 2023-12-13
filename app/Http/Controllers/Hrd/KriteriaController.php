<?php

namespace App\Http\Controllers\Hrd;

use App\Exports\KriteriaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hrd\StoreKriteriaRequest;
use App\Http\Requests\Hrd\UpdateKriteriaRequest;
use App\Imports\KriteriaImport;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KriteriaController extends Controller
{
    const TITLE = 'Data Kriteria Penilaian';
    const URL = 'hrd.kriterias.';
    const FOLDER = 'hrd.kriteria.';

    public function index()
    {
        $title = self::TITLE;
        $subtitle = 'Daftar Data';
        $url = self::URL;
        $folder = 'app';

        $kriterias = Kriteria::latest()->get();

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url', 'kriterias', 'folder'));
    }

    public function create()
    {
        $title = self::TITLE;
        $subtitle = 'Tambah Data';
        $url = self::URL;

        return view(self::FOLDER . 'index', compact('title', 'subtitle', 'url'));
    }

    public function store(StoreKriteriaRequest $request)
    {
        $input = $request->all();

        Kriteria::create($input);

        return redirect()->route(self::URL . 'index');
    }

    public function edit($id)
    {
        $kriterias = Kriteria::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Edit Data';
        $url = self::URL;

        return view(self::FOLDER . 'edit', compact('title', 'subtitle', 'url', 'kriterias'));
    }

    public function update(UpdateKriteriaRequest $request, $id)
    {
        $kriterias = Kriteria::findOrFail($id);

        $input = $request->all();

        $kriterias->update($input);

        return redirect()->route(self::URL . 'index');
    }

    public function destroy($id)
    {
        $kriterias = Kriteria::findOrFail($id);

        $kriterias->delete();

        return redirect()->route('hrd.kriterias.index')->with('success', 'Kriteria deleted successfully');
    }

    public function show($id)
    {
        $kriterias = Kriteria::findOrFail($id);

        $title = self::TITLE;
        $subtitle = 'Detail Kriteria';
        $url = self::URL;

        return view(self::FOLDER . 'show', compact('title', 'subtitle', 'url', 'kriterias'));
    }

    public function export() 
    {
        return Excel::download(new KriteriaExport, 'kriteria.xlsx');
    }

    public function import() 
    {
        Excel::import(new KriteriaImport, 'kriteria.xlsx');
        
        return redirect()->route(self::URL . 'index');
    }
}
