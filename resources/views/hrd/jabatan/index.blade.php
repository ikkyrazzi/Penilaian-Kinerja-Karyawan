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
                        <form method="POST" action="{{ route('hrd.jabatans.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" name="nama_jabatan" id="nama_jabatan" required autofocus />
                                        @error('nama_jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Divisi</label>
                                        <input type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi" id="divisi" required />
                                        @error('divisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Tambah Jabatan</button>
                                <a href="{{ route('hrd.jabatans.export') }}" class="btn btn-success">Export Data</a>
                                <a href="{{ route('hrd.jabatans.import') }}" class="btn btn-warning">Import Data</a>
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
                                        <th class="text-center">Nama Jabatan</th>
                                        <th class="text-center">Divisi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($jabatans as $jabatan)
                                    <tr>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $no++ }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $jabatan->nama_jabatan }}</td>
                                        <td class="text-center font-weight-bold text-uppercase">{{ $jabatan->divisi }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('hrd.jabatans.show', $jabatan->id) }}" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                                <a href="{{ route('hrd.jabatans.edit', $jabatan->id) }}" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <form action="{{ route('hrd.jabatans.destroy', $jabatan->id) }}" method="POST" style="display: inline;">
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
