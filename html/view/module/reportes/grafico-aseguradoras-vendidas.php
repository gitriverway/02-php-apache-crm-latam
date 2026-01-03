<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-12 connectedSortable">
    <!-- solid sales graph -->
    <div class="card bg-gradient-info">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-th mr-1"></i>
                Sales Graph
            </h3>
        </div>
        <div class="card-body">
            <canvas class="chart" id="line-chart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- right col -->

<!-- Left col -->
<section class="col-lg-6 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sales
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.Left col -->

<script>
// Sales graph chart
var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
// $('#revenue-chart').get(0).getContext('2d');

var salesGraphChartData = {
    labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1',
        '2013 Q2'
    ],
    datasets: [{
        label: 'Digital Goods',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
    }]
}

var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    },
    scales: {
        xAxes: [{
            ticks: {
                fontColor: '#efefef'
            },
            gridLines: {
                display: false,
                color: '#efefef',
                drawBorder: false
            }
        }],
        yAxes: [{
            ticks: {
                stepSize: 5000,
                fontColor: '#efefef'
            },
            gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false
            }
        }]
    }
}

// This will get the first returned node in the jQuery collection.
// eslint-disable-next-line no-unused-vars
var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
})


//-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
</script>