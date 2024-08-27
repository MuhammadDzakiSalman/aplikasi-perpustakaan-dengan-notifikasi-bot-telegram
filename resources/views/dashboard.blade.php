@extends('partials.main')
@section('content')
    <div class="container-fluid">
        <div class="row gy-2 py-3">
            <div class="col-lg-4 col-xl-4">
                <div class="card border-0 bg-primary bg-gradient text-light">
                    <div class="card-body">
                        <h4 class="fw-semibold card-title">Jumlah Buku</h4>
                        <h5 class="card-subtitle mb-2" id="jumlah_buku">{{ $jumlah_buku }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="card bg-warning bg-gradient border-0 bg-gradient text-light">
                    <div class="card-body">
                        <h4 class="fw-semibold card-title">Sedang Dipinjam</h4>
                        <h5 class="card-subtitle mb-2" id="sedang_dipinjam">{{ $sedang_dipinjam }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="card bg-info bg-gradient border-0 bg-gradient text-light">
                    <div class="card-body">
                        <h4 class="fw-semibold card-title">Jumlah Anggota</h4>
                        <h5 class="card-subtitle mb-2" id="jumlah_anggota">{{ $jumlah_anggota }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 gy-3">
            <div class="col col-12">
                <h5 class="fw-semibold">Trafik Peminjaman dan Pengembalian</h5>
            </div>
            <div class="col col-12 col-xl-6">
                <div class="card bg-light border-0 text-light">
                    <div class="card-body">
                        {{-- Tambahkan chart peminjaman buku dan pengembalian buku hari ini --}}
                        <canvas id="peminjamanPengembalianChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('peminjamanPengembalianChart').getContext('2d');
        var peminjamanPengembalianChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Peminjaman Hari Ini', 'Pengembalian Hari Ini'],
                datasets: [{
                    label: 'Grafik',
                    data: [{{ $peminjaman_hari_ini }}, {{ $pengembalian_hari_ini }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
    plugins: {
        tooltip: {
            callbacks: {
                label: function(context) {
                    let label = context.dataset.label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += context.raw.toString();
                    return label;
                }
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            grid: {
                display: true,
                color: 'rgba(200, 200, 200, 0.2)'
            },
            title: {
                display: true,
                text: 'Jumlah'
            },
            suggestedMax: Math.max({{ $peminjaman_hari_ini }}, {{ $pengembalian_hari_ini }}) + 5
        },
        x: {
            grid: {
                display: false
            }
        }
    },
    animation: {
        duration: 500,
        easing: 'easeInOut'
    }
}
        });
    </script>
@endsection
