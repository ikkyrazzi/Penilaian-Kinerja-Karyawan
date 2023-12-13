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
                        <form method="POST" action="{{ route('hrd.pegawais.update', $pegawais->id) }}">
                            @method('put') @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nomor Induk Pegawai</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" value="{{ $pegawais->nip }}" required autofocus />
                                        @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" id="nama_pegawai" value="{{ $pegawais->nama_pegawai }}" required />
                                        @error('nama_pegawai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $pegawais->email }}" required />
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" name="nama_jabatan" required>
                                            <option value="">Pilih</option>
                                
                                            @foreach ($jabatans as $jabatan)
                                                <option value="{{ $jabatan->nama_jabatan }}" {{ old('nama_jabatan', $pegawais->jabatan->nama_jabatan) == $jabatan->nama_jabatan ? 'selected' : '' }}>
                                                    {{ $jabatan->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('nama_jabatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                        <select class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ $pegawais->pendidikan_terakhir }}" required>
                                            <option value="sma">SMA Sederajat</option>
                                            <option value="diploma">Diploma 3</option>
                                            <option value="sarjana">Sarjana</option>

                                        </select>
                                        @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" id="tgl_lahir" value="{{ $pegawais->tgl_lahir }}" required autofocus />
                                        @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" id="tgl_masuk" value="{{ $pegawais->tgl_masuk }}" required />
                                        @error('tgl_masuk')
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
                                <a href="{{ route('hrd.pegawais.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
