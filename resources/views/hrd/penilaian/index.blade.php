@extends('hrd.layouts.app')

@section('addTitle') 

@endsection

@section('addCss') 

@endsection 

@section('addJs') 

@endsection 

@section('addJsCustom') 

@endsection 

@section('subheader') 

@endsection 

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Penilaian Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil! </strong>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nomor Induk Pegawai</th>
                                        <th class="text-center">Nama Pegawai</th>
                                        <th class="text-center">Nama Penilai</th>
                                        <th class="text-center">Nama Kriteria</th>
                                        <th class="text-center">Skor</th>
                                        <th class="text-center">Bobot (%)</th>
                                        <th class="text-center">Skor Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaians as $penilaian)
                                    <tr>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nip }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nama_pegawai }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nama_penilai }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nama_kriteria }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->skor }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->bobot }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->skor_nilai }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
