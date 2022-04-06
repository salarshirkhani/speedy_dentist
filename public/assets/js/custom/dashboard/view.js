$(document).ready(function() {
    "use strict";
    let siteUrl = $('meta[name="site-url"]').attr('content');
    $.get(siteUrl + "/dashboard/get-chart-data", function(data, status){
        if (!data.monthlyDebitCredit.credits.length)
            return;
        
        let areaChartData = {
            labels  : [JSON.parse(data.monthlyDebitCredit.labels)],
            datasets: [
                {
                    label               : 'Credits',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [JSON.parse(data.monthlyDebitCredit.credits)]
                },
                {
                    label               : 'Debits',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [JSON.parse(data.monthlyDebitCredit.debits)]
                }
            ]
        };
    
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        var temp1 = areaChartData.datasets[1];
        barChartData.datasets[0] = temp1;
        barChartData.datasets[1] = temp0;
    
        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        };
    
        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
    
        var donutChartCanvas = $('#donutChart1').get(0).getContext('2d');
        var donutData        = {
            labels: [
                'Debit',
                'Credit'
            ],
            datasets: [
                {
                    data: [data.currentYearDebitCredit.debits, data.currentYearDebitCredit.credits],
                    backgroundColor : ['#00a65a', '#f56954'],
                }
            ]
        };
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        };
    
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        });
    
        var donutChartCanvas = $('#donutChart2').get(0).getContext('2d');
        var donutData        = {
            labels: [
                'Debit',
                'Credit'
            ],
            datasets: [
                {
                    data: [data.overallDebitCredit.debits, data.overallDebitCredit.credits],
                    backgroundColor : ['#00a65a', '#f56954'],
                }
            ]
        };
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        };
        new Chart(donutChartCanvas, {
            type: 'pie',
            data: donutData,
            options: donutOptions
        });
    });
});
