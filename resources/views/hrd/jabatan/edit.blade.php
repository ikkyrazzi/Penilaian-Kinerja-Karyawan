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
        <h1>Edit Master Buku</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('hrd.jabatans.update', $jabatans->id) }}">
                            @method('put') @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Jabatan</label>
                                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" name="nama_jabatan" id="nama_jabatan" value="{{ $jabatans->nama_jabatan }}" required autofocus />
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
                                        <input type="text" class="form-control @error('divisi') is-invalid @enderror" name="divisi" id="divisi" value="{{ $jabatans->divisi }}" required />
                                        @error('divisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update Data</button>
                                <button type="reset" class="btn btn-info">Reset Form</button>
                                <a href="{{ route('hrd.jabatans.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
