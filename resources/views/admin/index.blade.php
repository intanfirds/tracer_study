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
          📈 Data Survey & Chart
        </button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">

      {{-- LAYER 1 --}}
      <div class="tab-pane fade show active" id="layer1" role="tabpanel" aria-labelledby="layer1-tab">
        {{-- TABLES ONLY --}}
        <div class="table-responsive rounded mt-4" id="tableContainer" style="font-size: 0.85rem;">
          @include('admin.data_table', ['tabel1' => $tabel1])
        </div>
      </div>

      {{-- LAYER 2 --}}
      <div class="tab-pane fade" id="layer2" role="tabpanel" aria-labelledby="layer2-tab">
        {{-- PIE CHARTS --}}
        @include('admin.pie_charts', ['charts1' => $charts1, 'prodi' => $prodi, 'alumni' => $alumni])
        {{-- SURVEY CHARTS --}}
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current', {packages:['corechart']});
google.charts.setOnLoadCallback(() => {
    drawProfesiCharts();
    drawSurveyCharts();
});

// Draw profesi charts
function drawProfesiCharts() {
    @foreach ($charts1 as $index => $chart)
        drawChart(
            'profesi_chart_{{ $index }}',
            '{{ $chart["title"] }}',
            {!! json_encode($chart['labels']) !!},
            {!! json_encode($chart['data']) !!}
        );
    @endforeach
}

// Draw survey charts
function drawSurveyCharts() {
    const labels = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'];
    const colors = ['#28a745', '#17a2b8', '#ffc107', '#dc3545'];

    @foreach($surveyCharts as $chart)
        const data_{{ $chart['id'] }} = google.visualization.arrayToDataTable([
            ['Category', 'Percentage'],
            // Gunakan labels JavaScript, bukan $labels PHP
            ['Sangat Baik', {{ $chart['data'][0] ?? 0 }}],
            ['Baik', {{ $chart['data'][1] ?? 0 }}],
            ['Cukup', {{ $chart['data'][2] ?? 0 }}],
            ['Kurang', {{ $chart['data'][3] ?? 0 }}]
        ]);

        const options_{{ $chart['id'] }} = {
            title: '{{ $chart['title'] }}',
            colors: colors,
            is3D: true,
            legend: { position: 'labeled' },
            pieSliceText: 'percentage',
            sliceVisibilityThreshold: 0,
            chartArea: {
                left: 0,
                top: 30,
                width: '100%',
                height: '80%'
            }
        };

        const chart_{{ $chart['id'] }} = new google.visualization.PieChart(
            document.getElementById('survey_chart_{{ $chart['id'] }}')
        );
        chart_{{ $chart['id'] }}?.draw(data_{{ $chart['id'] }}, options_{{ $chart['id'] }});
    @endforeach
}

// Your existing drawChart function
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
      console.log('Drawing charts...');
      try {
          @foreach ($charts1 as $index => $chart)
              drawChart(
                  'chart_div_{{ $index }}',
                  '{{ $chart["title"] }}',
                  {!! json_encode($chart['labels']) !!},
                  {!! json_encode($chart['data']) !!}
              );
          @endforeach
          console.log('Charts drawn successfully');
      } catch(e) {
          console.error('Error drawing charts:', e);
      }
  }

  // Add event listener for tab changes to redraw charts
  document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tab => {
      tab.addEventListener('shown.bs.tab', function (e) {
          if (e.target.id === 'layer2-tab') {
              drawProfesiCharts();
              drawSurveyCharts();
          }
      });
  });
</script>
<script>
  $('#filterProdi, #filterTahun').change(function(){
      var prodi = $('#filterProdi').val();
      var tahun = $('#filterTahun').val();
      
      $.ajax({
          url: '{{ route("admin.getData") }}',
          type: 'GET',
          data: { prodi: prodi, tahun: tahun },
          success: function(response) {
              if(response.status === 'success') {
                  // Update table
                  $('#tableContainer').html(response.tableHtml);
                  
                  // Update charts
                  $('#chartContainer').html(response.chartHtml);
                  
                  // Redraw charts
                  setTimeout(function() {
                      drawAllCharts();
                  }, 100);
              } else {
                  console.error('Response error:', response.error);
              }
          },
          error: function(xhr, status, error) {
              console.error('AJAX Error:', error);
          }
      });
  });
</script>
@endpush