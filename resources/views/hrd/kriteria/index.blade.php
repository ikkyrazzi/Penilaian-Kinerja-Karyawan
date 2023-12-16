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
        <h1>Data Jabatan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('hrd.kriterias.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Kriteria</label>
                                        <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria" id="nama_kriteria" required autofocus />
                                        @error('nama_kriteria')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Bobot(%)</label>
                                        <select class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot" required>
                                            <option value="">Pilih Bobot (%)</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                        </select>
                                        @error('bobot')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Keterangan" required></textarea>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
                            </div>
                        </form>

                        <br>

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
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kriteria</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Bobot (%)</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($kriterias as $kriteria)
                                    <tr>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $no++ }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $kriteria->nama_kriteria }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $kriteria->keterangan }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $kriteria->bobot }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('hrd.kriterias.show', $kriteria->id) }}" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                                <a href="{{ route('hrd.kriterias.edit', $kriteria->id) }}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <form action="{{ route('hrd.kriterias.destroy', $kriteria->id) }}" method="POST" style="display: inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
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
