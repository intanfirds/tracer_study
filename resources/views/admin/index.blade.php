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
    <p class="fs-4 fw-bold">Dashboard Admin</p>

    {{-- TAB NAV --}}
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="layer1-tab" data-bs-toggle="tab" data-bs-target="#layer1" type="button" role="tab" aria-controls="layer1" aria-selected="true">
          📊 Data Profesi & Tabel
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="layer2-tab" data-bs-toggle="tab" data-bs-target="#layer2" type="button" role="tab" aria-controls="layer2" aria-selected="false">
          📈 Data Survey
        </button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">

      {{-- LAYER 1 --}}
      <div class="tab-pane fade show active" id="layer1" role="tabpanel" aria-labelledby="layer1-tab">
        {{-- FILTER --}}
        <div class="row mb-4">
          <div class="col-md-6">
            <label for="filterProdi" class="form-label">Filter Prodi</label>
            <select id="filterProdi" class="form-select">
              <option value="">Semua Prodi</option>
              @foreach ($prodi as $p)
                <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="filterTahun" class="form-label">Filter Tahun Lulus</label>
            <select id="filterTahun" class="form-select">
              <option value="">Semua Tahun</option>
              @foreach ($alumni as $tahun)
                <option value="{{ $tahun->tahun_lulus }}">{{ $tahun->tahun_lulus }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- PIE CHART --}}
        <div class="row mb-4">
            @foreach ($charts1 as $index => $chart)
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">{{ $chart["title"] }}</div>
                <div class="card-body">
                    <div id="chart_div_{{ $index }}" style="width: 100%; height: 250px;"></div>
                </div>
              </div>
            </div>
            @endforeach
        </div>

        {{-- TABLES --}}
        <div class="table-responsive rounded shadow-sm mt-4" style="font-size: 0.85rem;">
          <table class="table table-sm table-bordered text-center align-middle mb-1">
            <thead class="table-light text-dark">
              <tr class="fw-bold">
                <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Tahun Lulus</th>
                <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan</th>
                <th rowspan="2" class="align-middle bg-dark text-white py-1 px-2">Jumlah Lulusan <br> yang Terlacak</th>
                <th colspan="2" class="bg-dark text-white py-1">Profesi Kerja/Perguruan Tinggi</th>
                <th colspan="3" class="bg-dark text-white py-1">Lingkup Tempat Kerja</th>
              </tr>
              <tr class="fw-bold">
                <th class="bg-info text-white py-1 px-1">Bidang Infokom</th>
                <th class="bg-info text-white py-1 px-1">Non Infokom</th>
                <th class="bg-warning text-dark py-1 px-1">Multinasional/ <br>Internasional</th>
                <th class="bg-warning text-dark py-1 px-1">Nasional</th>
                <th class="bg-warning text-dark py-1 px-1">Wirausaha</th>
              </tr>
            </thead>
            <tbody>
            @php
                $total_jumlah_lulusan = $tabel1->sum('jumlah_lulusan');
                $total_terlacak = $tabel1->sum('terlacak');
                $total_bidang_infokom = $tabel1->sum('bidang_infokom');
                $total_bidang_non_infokom = $tabel1->sum('bidang_non_infokom');
                $total_multinasional = $tabel1->sum('multinasional');
                $total_nasional = $tabel1->sum('nasional');
                $total_wirausaha = $tabel1->sum('wirausaha');
            @endphp
            @foreach ($tabel1 as $data)
            <tr>
                <td class="py-1 px-2">{{ $data->tahun_lulus }}</td>
                <td class="py-1 px-2">{{ $data->jumlah_lulusan }}</td>
                <td class="py-1 px-2">{{ $data->terlacak }}</td>
                <td class="py-1 px-1">{{ $data->bidang_infokom }}</td>
                <td class="py-1 px-1">{{ $data->bidang_non_infokom }}</td>
                <td class="py-1 px-1">{{ $data->multinasional }}</td>
                <td class="py-1 px-1">{{ $data->nasional }}</td>
                <td class="py-1 px-1">{{ $data->wirausaha }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot class="table-secondary fw-semibold">
              <tr>
                <td class="py-1 px-2">Jumlah</td>
                <td class="py-1 px-2">{{ $total_jumlah_lulusan }}</td>
                <td class="py-1 px-2">{{ $total_terlacak }}</td>
                <td class="py-1 px-1">{{ $total_bidang_infokom }}</td>
                <td class="py-1 px-1">{{ $total_bidang_non_infokom }}</td>
                <td class="py-1 px-1">{{ $total_multinasional }}</td>
                <td class="py-1 px-1">{{ $total_nasional }}</td>
                <td class="py-1 px-1">{{ $total_wirausaha }}</td>
              </tr>
            </tfoot>
          </table>
        </div>

      </div>
    </div>

      {{-- LAYER 2 --}}
      <div class="tab-pane fade" id="layer2" role="tabpanel" aria-labelledby="layer2-tab">
        {{-- FILTER --}}
        <div class="row mb-4">
            <div class="col-md-6">
              <label for="filterProdi2" class="form-label">Filter Prodi</label>
              <select id="filterProdi2" class="form-select">
                <option value="">Semua Prodi</option>
                @foreach ($prodi as $p)
                  <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="filterTahun2" class="form-label">Filter Tahun Lulus</label>
              <select id="filterTahun2" class="form-select">
                <option value="">Semua Tahun</option>
                @foreach ($alumni as $tahun)
                  <option value="{{ $tahun->tahun_lulus }}">{{ $tahun->tahun_lulus }}</option>
                @endforeach
              </select>
            </div>
          </div>
        <div class="row">
          @for ($j = 1; $j <= 7; $j++)
            <div class="col-lg-6 mb-4">
              <div class="card">
                <div class="card-header">Pie Chart {{ $j }}</div>
                <div class="card-body"><canvas id="chart{{ $j }}"></canvas></div>
              </div>
            </div>
          @endfor
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawAllCharts);

    function drawChart(chartId, title, labels, dataValues) {
        const dataArray = [['Label', 'Value']];
        for (let i = 0; i < labels.length; i++) {
          const value = dataValues[i] > 0 ? dataValues[i] : 0.00001;
          const labelText = dataValues[i] > 0 ? dataValues[i] : '0';
          dataArray.push([labels[i], value]);

        }

        const data = google.visualization.arrayToDataTable(dataArray);

        const options = {
            title: title,
            is3D: true,
            legend: { position: 'labeled' },
            pieSliceText: 'value',
            sliceVisibilityThreshold: 0, // <== Ini kunci utama agar tidak muncul "Other"
            colors: ['#370617', '#6A040F', '#9D0208', '#D00000','#DC2F02', '#E85D04','#F48C06','#FAA307','#FFBA08'],
            chartArea: {
                top: 10,
                bottom: 20,
                left: 10,
                right: 10,
                width: '100%',
                height: '80%'
            },
            titlePosition: 'in',
            titleTextStyle: {
                fontSize: 16,
                bold: true
            }
        };


        const chart = new google.visualization.PieChart(document.getElementById(chartId));
        chart.draw(data, options);
    }

    function drawAllCharts() {
        // Contoh: Data di-generate dari Blade Laravel
        @foreach ($charts1 as $index => $chart)
            drawChart(
                'chart_div_{{ $index }}',
                '{{ $chart["title"] }}',
                {!! json_encode($chart['labels']) !!},
                {!! json_encode($chart['data']) !!}
            );
        @endforeach
    }
    </script>
@endpush
