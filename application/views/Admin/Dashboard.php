<div class="row">
    <div class="col-md-4 offset-md-4 text-center">
        <h1  style="color: #333; font-weight: 300;">Hello, <?php echo $this->session->userdata('FullName'); ?></h1>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12 text-center mt-2">
        <h4  style="color: #333; font-weight: 300;">Weekly Sales Report</h4>
        <div class="chart">
            <canvas id="c1" width="1000" height="200"></canvas>
        </div>
    </div>
</div>
<br/>

<hr class="mt-4" />
<div class="row text-center " >
    <div class="col-4 myhover">
        <div class="card">
            <div class="card-body bg-info text-light">
                <h5 class="card-title">Total Orders</h5>
                <h2 class="badge badge-light ">910</h2>
            </div>
        </div>
    </div>
    <div class="col-4 myhover">
    <div class="card">
            <div class="card-body bg-warning">
                <h5 class="card-title">Pending Orders</h5>
                <h2 class="badge badge-light ">540</h2>
            </div>
        </div>
    </div>
    <div class="col-4 myhover">
        <div class="card">
            <div class="card-body bg-success text-light">
                <h5 class="card-title">Completed Orders</h5>
                <h2 class="badge badge-light">370</h2>
            </div>
        </div>
    </div>
</div>
<hr />

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js'></script>
<script>
    var data1 = {
        labels: [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ],
        datasets: [{
                fillColor: "rgba(56,175,91,.1)",
                strokeColor: "rgba(56,175,91,1)",
                pointColor: "rgba(56,175,91,1)",
                pointStrokeColor: "rgba(0,0,0,0.6)",
                data: [1000, 1200, 935, 990, 1050, 1030, 1040]
            },
            {
                fillColor: "rgba(234,142,57,.1)",
                strokeColor: "rgba(234,142,57,1)",
                pointColor: "rgba(234,142,57,1)",
                pointStrokeColor: "rgba(0,0,0,0.6)",
                data: [1300, 1200, 1000, 1200, 1100, 1150, 1180]
            },
            {
                fillColor: "rgba(236,72,127,.1)",
                strokeColor: "rgba(236,72,127,1)",
                pointColor: "rgba(236,72,127,1)",
                pointStrokeColor: "rgba(0,0,0,0.6)",
                data: [1400, 1350, 1250, 1250, 1350, 1500, 1550]
            }
        ]
    };

    var options1 = {
        scaleFontColor: "rgba(0,0,0,0.7)",
        scaleLineColor: "rgba(0,0,0,0)",
        scaleGridLineColor: "rgba(0,0,0,0.1)",
        scaleFontFamily: "Open Sans",
        scaleFontSize: 14,
        bezierCurve: true,
        scaleShowLabels: true,
        pointDotRadius: 6,
        animation: true,
        scaleShowGridLines: true,
        datasetFill: true,
        responsive: true
    };

    new Chart(c1.getContext("2d")).Line(data1, options1);

    var data2 = [{
            value: 80,
            color: "rgba(236,72,127,1)",
            label: ""
        },
        {
            value: 20,
            color: "#3c4449",
            label: ""
        }
    ];

    var options2 = {
        animation: false,
        responsive: true,
        segmentShowStroke: false,
        percentageInnerCutout: 90
    };

    new Chart($("#c2").get(0).getContext("2d")).Doughnut(data2, options2);

    var data2 = [{
            value: 64,
            color: "rgba(234,142,57,1)",
            label: ""
        },
        {
            value: 36,
            color: "#3c4449",
            label: ""
        }
    ];

    var options2 = {
        animation: false,
        responsive: true,
        segmentShowStroke: false,
        percentageInnerCutout: 90
    };

    new Chart($("#c3").get(0).getContext("2d")).Doughnut(data2, options2);

    var data2 = [{
            value: 34,
            color: "rgba(56,175,91,1)",
            label: ""
        },
        {
            value: 66,
            color: "#3c4449",
            label: ""
        }
    ];

    var options2 = {
        animation: false,
        responsive: true,
        segmentShowStroke: false,
        percentageInnerCutout: 90
    };

    new Chart($("#c4").get(0).getContext("2d")).Doughnut(data2, options2);
</script>