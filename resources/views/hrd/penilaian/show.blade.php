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
        <h1>Detail Penilaian Karyawan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h2>{{ $penilaian->nama_pegawai }}'s Detail</h2>
                    
                        <form>
                            <div class="form-group">
                                <label for="nomorInduk">Nomor Induk Pegawai:</label>
                                <input type="text" class="form-control" id="nomorInduk" value="{{ $penilaian->nip }}" readonly>
                            </div>
                    
                            <div class="form-group">
                                <label for="namaPegawai">Nama Pegawai:</label>
                                <input type="text" class="form-control" id="namaPegawai" value="{{ $penilaian->nama_pegawai }}" readonly>
                            </div>
                    
                            {{-- Check if the 'pegawai' relationship is loaded before accessing its properties --}}
                            @if ($penilaian->pegawai)
                                <div class="form-group">
                                    <label for="emailPegawai">Email Pegawai:</label>
                                    <input type="text" class="form-control" id="emailPegawai" value="{{ $penilaian->pegawai->email }}" readonly>
                                </div>
                    
                                <div class="form-group">
                                    <label for="jabatan">Jabatan:</label>
                                    <input type="text" class="form-control" id="jabatan" value="{{ $penilaian->pegawai->nama_jabatan }}" readonly>
                                </div>
                            @endif
                    
                            <div class="form-group">
                                <label for="namaPenilai">Nama Penilai:</label>
                                <input type="text" class="form-control" id="namaPenilai" value="{{ $penilaian->nama_penilai }}" readonly>
                            </div>
                    
                            <div class="form-group">
                                <label for="skorPenilaian">Skor Penilaian:</label>
                                <input type="text" class="form-control" id="skorPenilaian" value="{{ $totalSkorNilai[$penilaian->nama_pegawai] }}" readonly>
                            </div>
                    
                            <!-- Add more details as needed -->
                    
                            <a href="{{ route('hrd.penilaians.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>                    
                </div>
            </div>

            <!-- New div for the chart -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Chart Container -->
                        <canvas id="kriteriaChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Chart.js initialization
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('kriteriaChart').getContext('2d');

        var data = {
            labels: {!! json_encode(array_keys($kriteriaSkor)) !!},
            datasets: [{
                label: 'Skor Nilai',
                data: {!! json_encode(array_values($kriteriaSkor)) !!},
                backgroundColor: [
                    '#191d21',
                    '#63ed7a',
                    '#ffa426',
                    '#fc544b',
                    '#6777ef',
                    '#ff69b4',
                    '#32cd32',
                    '#ffd700',
                    '#9400d3',
                    '#ffa07a',
                ],
            }]
        };

        var options = {
            plugins: {
                datalabels: {
                    color: '#fff', // Label text color
                    font: {
                        weight: 'bold'
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 10,
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>

@endsection
