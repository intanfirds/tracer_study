@extends('layouts.app')
@push('css')

<style>
    .card-body {
    padding: 10px !important; /* Mengurangi padding card body */
    }

    #piechart1_3d, #piechart2_3d {
    margin-top: -10px; /* Membawa chart lebih dekat ke atas */
    }
</style>

@endpush

@section('content')
{{-- AREA KONTEN BERSHADOW --}}

<div class="card shadow p-4 mb-4" style="border-radius: 16px;">
    <h3 class="card-title">Dashboard Admin</h3>

    {{-- FILTER --}}
    <form id="filterForm" class="row g-3 mb-4" method="GET" action="{{ route('admin.index') }}">
    <div class="col-md-5">
        <label for="filterProdi" class="form-label">Filter Program Studi</label>
        <select class="form-select" id="filterProdi" name="prodi_id">
            <option value="">Semua Program Studi</option>
            @foreach($prodi as $p)
                <option value="{{ $p->prodi_id }}" {{ (request('prodi_id') ?? $selectedProdi) == $p->prodi_id ? 'selected' : '' }}>
                    {{ $p->nama_prodi }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <label for="filterTahun" class="form-label">Filter Tahun Lulus</label>
        <select class="form-select" id="filterTahun" name="tahun_lulus">
            <option value="">Semua Tahun</option>
            @foreach($alumni as $a)
                <option value="{{ $a->tahun_lulus }}" {{ (request('tahun_lulus') ?? $selectedTahun) == $a->tahun_lulus ? 'selected' : '' }}>
                    {{ $a->tahun_lulus }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">&nbsp;</label>
        <button type="submit" class="btn btn-primary d-block w-100">
            <i class="fas fa-filter me-2"></i>Filter
        </button>
    </div>
</form>


    <!-- Add this near your filters -->
    <div id="loadingSpinner" style="display:none;" class="text-center my-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    {{-- TAB NAV --}}
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="layer1-tab" data-bs-toggle="tab" data-bs-target="#layer1" type="button" role="tab" aria-controls="layer1" aria-selected="true">
          📊 Data Profesi & Tabel
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="layer2-tab" data-bs-toggle="tab" data-bs-target="#layer2" type="button" role="tab" aria-controls="layer2" aria-selected="false">
          📈 Data Survey & Chart
        </button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">

      {{-- LAYER 1 --}}
      <div class="tab-pane fade show active" id="layer1" role="tabpanel" aria-labelledby="layer1-tab">
        {{-- TABLES ONLY --}}
        <div class="table-responsive rounded mt-4" id="tableContainer" style="font-size: 0.85rem;">
          @include('admin.tab_profesi', ['tabel1' => $tabel1])
        </div>
      </div>

      {{-- LAYER 2 --}}
      <div class="tab-pane fade" id="layer2" role="tabpanel" aria-labelledby="layer2-tab">
        {{-- PIE CHARTS --}}
        @include('admin.tab_kepuasan', ['charts1' => $charts1, 'prodi' => $prodi, 'alumni' => $alumni])
        {{-- SURVEY CHARTS --}}
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {packages:['corechart']});

let chartsData = @json($charts1);
let surveyChartsData = @json($surveyCharts);

google.charts.setOnLoadCallback(() => {
    drawProfesiCharts();
    drawSurveyCharts();
});

function drawProfesiCharts() {
    chartsData.forEach((chart, index) => {
        const chartId = 'profesi_chart_' + index;
        const element = document.getElementById(chartId);
        if (!element) return;

        if (chart.labels.length === 0) {
            element.innerHTML = '<div class="text-center text-muted mt-5">Data belum tersedia</div>';
            return;
        }

        const dataArray = [['Label', 'Value']];
        for (let i = 0; i < chart.labels.length; i++) {
            const value = chart.data[i] > 0 ? chart.data[i] : 0.00001;
            dataArray.push([chart.labels[i], value]);
        }

        const data = google.visualization.arrayToDataTable(dataArray);
        const options = {
            is3D: true,
            legend: { position: 'labeled' },
            pieSliceText: 'value',
            sliceVisibilityThreshold: 0,
            colors: ['0466c8','0353a4',"023e7d","002855","001845","001233","33415c","5c677d","7d8597","a5b1c2","c8d0e0","e0e6f2"],
            chartArea: {top: 10, bottom: 20, left: 10, right: 10, width: '100%', height: '80%'},
        };

        const pieChart = new google.visualization.PieChart(element);
        pieChart.draw(data, options);
    });
}

function drawSurveyCharts() {
    const labels = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
    const colors = ['0466c8','0353a4',"7d8597","a5b1c2"];

    surveyChartsData.forEach(chart => {
        const chartId = 'survey_chart_' + chart.id;
        const element = document.getElementById(chartId);
        if (!element) return;

        const total = chart.data.reduce((a, b) => a + b, 0);
        if (total === 0) {
            element.innerHTML = '<div class="text-center text-muted mt-5">Data belum tersedia</div>';
            return;
        }

        const dataArray = [
            ['Kategori', 'Persentase'],
            ['Sangat Baik', chart.data[0] ?? 0],
            ['Baik', chart.data[1] ?? 0],
            ['Cukup', chart.data[2] ?? 0],
            ['Kurang', chart.data[3] ?? 0]
        ];

        const data = google.visualization.arrayToDataTable(dataArray);
        const options = {
            colors: colors,
            is3D: true,
            legend: { position: 'labeled' },
            pieSliceText: 'percentage',
            sliceVisibilityThreshold: 0,
            chartArea: { left: 0, top: 30, width: '100%', height: '80%' }
        };

        const pieChart = new google.visualization.PieChart(element);
        pieChart.draw(data, options);
    });
}

// Redraw saat tab pindah
document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (e) {
        if (e.target.id === 'layer2-tab') {
            drawSurveyCharts();
        }
        if (e.target.id === 'layer1-tab') {
            drawProfesiCharts();
        }
    });
});
</script>
@endpush
