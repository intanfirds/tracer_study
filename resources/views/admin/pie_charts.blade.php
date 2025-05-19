{{-- FILTER --}}
<div class="row mb-4">
    <div class="col-md-6">
        <label for="filterProdi" class="form-label">Filter Program Studi</label>
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

{{-- PROFESI CHARTS --}}
<h4 class="fw-bold mb-4">Chart Data Profesi</h4>
<div class="row mb-4" id="chartContainer">
    @foreach ($charts1 as $index => $chart)
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">{{ $chart["title"] }}</div>
            <div class="card-body">
                <div id="profesi_chart_{{ $index }}" style="width: 100%; height: 250px;"></div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- SURVEY CHARTS --}}
<h4 class="fw-bold mb-4">Chart Data Survey Kepuasan</h4>
<div class="row mb-4" id="surveyContainer">
    @foreach($surveyCharts as $chart)
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">{{ $chart['title'] }}</div>
            <div class="card-body">
                <div id="survey_chart_{{ $chart['id'] }}" style="width: 100%; height: 250px;"></div>
            </div>
        </div>
    </div>
    @endforeach
</div>