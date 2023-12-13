@extends('manager.layouts.app')

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
        <h1>Form Penilaian Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('manager.penilaians.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nomor Induk Pegawai</label>
                                        <div class="input-group">
                                            <select class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" required>
                                                <option value="">Pilih NIP</option>
                                                @foreach ($pegawais as $pegawai)
                                                    <option value="{{ $pegawai->nip }}" data-nama="{{ $pegawai->nama_pegawai }}">{{ $pegawai->nip }}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" id="nama_pegawai" required readonly />
                                        @error('nama_pegawai')
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
                                        <label>Nama Penilai</label>
                                        <input type="text" class="form-control @error('nama_penilai') is-invalid @enderror" name="nama_penilai" id="nama_penilai" value="{{ auth()->user()->name }}" required readonly />
                                        @error('nama_penilai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Penilaian</label>
                                        <input type="date" class="form-control @error('waktu_penilaian') is-invalid @enderror" name="waktu_penilaian" id="waktu_penilaian" required />
                                        @error('waktu_penilaian')
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
                                        <p>
                                            Keterangan : <br>
                                            5 = Sangat Bagus <br>
                                            4 = Bagus <br>
                                            3 = Cukup <br>
                                            2 = Kurang Bagus <br>
                                            1 = Tidak Bagus
                                        </p>
                                        <label>Data Penilaian</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Kriteria</th>
                                                    <th class="text-center">Penilaian</th>
                                                    <th class="text-center">Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kriterias as $kriteria)
                                                    <tr>
                                                        <td class="text-center font-weight-bold text-uppercase">{{ $kriteria->nama_kriteria }}</td>
                                                        <td class="text-center">
                                                            @foreach (['5', '4', '3', '2', '1'] as $skor)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="skor[{{ $kriteria->id }}]" id="skor_{{ $kriteria->id }}_{{ $loop->index }}" value="{{ $skor }}" data-id-kriteria="{{ $kriteria->id }}">
                                                                    <label class="form-check-label" for="skor_{{ $kriteria->id }}_{{ $loop->index }}">{{ $skor }}</label>
                                                                </div>
                                                            @endforeach
                                                            <input type="hidden" name="nama_kriteria[{{ $kriteria->id }}]" value="{{ $kriteria->nama_kriteria }}">
                                                            <input type="hidden" name="bobot[{{ $kriteria->id }}]" value="{{ $kriteria->bobot }}">
                                                            <input type="hidden" name="skor_nilai[{{ $kriteria->id }}]" value="{{ $kriteria->skor_nilai }}">
                                                            <input type="hidden" name="id_kriteria[{{ $kriteria->id }}]" value="{{ $kriteria->id }}">
                                                        </td>                                                        
                                                        <td class="text-center font-weight-bold text-uppercase">{{ $kriteria->bobot }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @error('skor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                const valueMapping = {
                                                    'Sangat Bagus': 5,
                                                    'Bagus': 4,
                                                    'Cukup': 3,
                                                    'Kurang Bagus': 2,
                                                    'Tidak Bagus': 1
                                                };
                                        
                                                document.querySelector('form').addEventListener('submit', function () {
                                                    document.querySelectorAll('[name^="skor["]').forEach(function (radioGroup) {
                                                        const selectedRadioButton = radioGroup.querySelector(':checked');
                                        
                                                        if (selectedRadioButton) {
                                                            const textValue = selectedRadioButton.value;
                                        
                                                            selectedRadioButton.value = valueMapping[textValue];
                                        
                                                            const bobotInput = selectedRadioButton.closest('tr').querySelector('[name^="bobot["]');
                                                            const bobot = parseFloat(bobotInput.value);
                                        
                                                            const skorNilaiInput = selectedRadioButton.closest('tr').querySelector('[name^="skor_nilai["]');
                                                            skorNilaiInput.value = (selectedRadioButton.value * bobot) / 100;
                                        
                                                            const hasilSkorNilaiSpan = document.getElementById('hasil_skor_nilai_' + skorNilaiInput.getAttribute('data-id-kriteria'));
                                                            hasilSkorNilaiSpan.textContent = skorNilaiInput.value;
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Input Data</button>
                                <button type="reset" class="btn btn-info">Reset Form</button>
                                <a href="{{ route('manager.penilaians.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('nip').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('nama_pegawai').value = selectedOption.getAttribute('data-nama');
    });

    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('waktu_penilaian').value = today;
    });
</script>

@endsection
