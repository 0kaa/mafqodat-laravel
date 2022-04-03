$(window).on("load", function () {
    "use strict";

    var $strokeColor = "#ebe9f1";

    var $textMutedColor = "#b9b9c3";
    var $salesStrokeColor2 = "#df87f2";

    var salesLineChartOptions;

    var salesLineChart;


    var $salesLineChart = document.querySelector("#sales-line-chart");

    // Sales Line Chart
    // -----------------------------
    salesLineChartOptions = {
        chart: {
            height: 240,
            toolbar: { show: false },
            zoom: { enabled: false },
            type: "line",
            dropShadow: {
                enabled: true,
                top: 18,
                left: 2,
                blur: 5,
                opacity: 0.2,
            },
            offsetX: -10,
        },
        stroke: {
            curve: "smooth",
            width: 4,
        },
        grid: {
            borderColor: $strokeColor,
            padding: {
                top: -20,
                bottom: 5,
                left: 20,
            },
        },
        legend: {
            show: false,
        },
        colors: [$salesStrokeColor2],
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                inverseColors: false,
                gradientToColors: [window.colors.solid.primary],
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100],
            },
        },
        markers: {
            size: 0,
            hover: {
                size: 5,
            },
        },
        xaxis: {
            labels: {
                offsetY: 5,
                style: {
                    colors: $textMutedColor,
                    fontSize: "0.857rem",
                },
            },
            axisTicks: {
                show: false,
            },
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "July",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            axisBorder: {
                show: false,
            },
            tickPlacement: "on",
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: "0.857rem",
                },
                formatter: function (val) {
                    return val > 999 ? (val / 1000).toFixed(1) + "k" : val;
                },
            },
        },
        tooltip: {
            x: { show: false },
        },
        series: [
            {
                name: "Sales",
                data: [
                    0, 100, 200, 300, 400, 500
                ],
            },
        ],
    };
    salesLineChart = new ApexCharts($salesLineChart, salesLineChartOptions);
    salesLineChart.render();
});
