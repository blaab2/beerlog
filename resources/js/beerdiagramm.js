Chart = require('chart.js');
ChartDataLabels = require('chartjs-plugin-datalabels');

//var style = getComputedStyle(document.body);
var theme = {};
//theme.primary = style.getPropertyValue('--primary');
//theme.secondary = style.getPropertyValue('--secondary');
//theme.success = style.getPropertyValue('--success');
theme.primary = '#375a7f';
theme.success = '#00bc8c';
theme.warning = '#F39C12';


var ctx = document.getElementById('myChart');
var inputdata = JSON.parse($("#data1").val());
var ownuserid = $("#data2").val();
var thisuserid = $("#data3").val();

inputdata.sort(function (a, b) {
    return b['beers_count'] - a['beers_count']
});

var backgroundColors = inputdata.map(function (x) {
    return x['id'] == ownuserid ? theme.success : (x['id'] == thisuserid ? theme.warning : theme.primary);
});

var borderColors = inputdata.map(function (x) {
    return x['id'] == ownuserid ? theme.success : (x['id'] == thisuserid ? theme.warning : theme.primary);
});

/*
[
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			]

console.log(colors);

			*/

var myChart = new Chart(ctx, {
    plugins: [ChartDataLabels],
    type: 'bar',
    data: {
        labels: inputdata.map(x => x['nickname']),
        datasets: [{
            label: '# of beers',
            data: inputdata.map(x => x['beers_count']),
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontColor: '#fff'
                }
            }],
            xAxes: [{
                ticks: {
                    fontColor: '#fff'
                }
            }]
        },
        legend: {
            display: false,
            labels: {
                fontColor: '#fff'
            }
        },
        plugins: {
            // Change options for ALL labels of THIS CHART
            datalabels: {
                color: '#fff',
                formatter: function (value, context) {
                    //var i = context.dataIndex;
                    //var prev = context.dataset.data[i - 1];
                    //var diff = prev !== undefined ? prev - value : 0;
                    //var glyph = diff < 0 ? '\u25B2' : diff > 0 ? '\u25BC' : '\u25C6';
                    var glyph = '\u2764';//'\uF0FC';

                    //return String.fromCharCode(parseInt('f0fc', 16));
                    return Math.round(value) + ' ' + glyph;
                },
                font: {
                    size: 20
                },
            }
        }
    }
});
