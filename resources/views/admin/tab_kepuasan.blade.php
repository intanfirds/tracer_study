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