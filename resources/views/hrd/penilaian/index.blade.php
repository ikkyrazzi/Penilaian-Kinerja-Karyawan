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
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Nama Penilai</th>
                                        <th class="text-center">Skor Penilaian</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uniquePegawaiNames as $namaPegawai)
                                        @php
                                            $penilaian = $penilaians->where('nama_pegawai', $namaPegawai)->first();
                                        @endphp
                                        <tr>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nip }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nama_pegawai }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->pegawai->email }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->pegawai->nama_jabatan }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $penilaian->nama_penilai }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">{{ $totalSkorNilai[$namaPegawai] }}</td>
                                            <td class="text-center font-weight-bold text-uppercase">
                                                <a href="{{ route('hrd.penilaians.show', $penilaian->id) }}" class="btn btn-info btn-sm">Show</a>
                                            </td>                                            
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
