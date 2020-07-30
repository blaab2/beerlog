import {round} from "lodash";

function drawConsumptionChart(diagrammdata, startdate, drinksperday, enddate, timeFormat) {
    var ctx = document.getElementById('consumptionChart');
    var config = {
        type: 'bar',
        data: {
            datasets: [
                {
                    label: "Spezi Consumption",
                    data: diagrammdata['Spezi'],
                    fill: true,
                    backgroundColor: '#00bc8c',
                    borderColor: '#00bc8c',
                    stack: 'Stack 0',
                },
                {
                    label: "Beer Consumption",
                    data: diagrammdata['Beer'],
                    fill: true,
                    backgroundColor: '#F39C12',
                    borderColor: '#F39C12',
                    stack: 'Stack 0',
                },
                {
                    label: "Average",
                    data: [{
                        x: startdate,
                        y: drinksperday
                    }, {
                        t: enddate,
                        y: drinksperday
                    }],
                    fill: false,
                    backgroundColor: '#375a7f',
                    borderColor: '#375a7f',
                    type: 'line'
                }
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                labels: {
                    fontColor: '#fff'
                }
            },
            scales: {
                xAxes: [{
                    type: "time",
                    time: {
                        parser: timeFormat,
                        tooltipFormat: timeFormat
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    },
                    ticks: {
                        fontColor: '#fff',
                        max: enddate,
                        min: startdate
                    },
                    stacked: true
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Drinks'
                    },
                    ticks: {
                        fontColor: '#fff'
                    },
                    stacked: false
                }]
            },
            plugins: {
                datalabels: {
                    display: false,
                }
            }
        }
    };
    var chart = new Chart(ctx, config);
}

function drawPieChart(data_sorted) {
    var ctx = document.getElementById('pieChart1');
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    data_sorted["Spezi"].length,
                    data_sorted["Beer"].length
                ],
                backgroundColor: [
                    '#00bc8c',
                    '#F39C12'
                ],
                borderColor: [
                    '#FFFFFF',
                    '#FFFFFF'
                ],
                borderWidth: 1
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Spezi',
                'Beer'
            ]
        },
        options: {
            legend: {
                display: true,
                labels: {
                    fontColor: '#fff'
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    display: true,
                }
            }
        }
    };
    var chart = new Chart(ctx, config);
}

function initTable(data) {
    $('#table-user-index').DataTable({
        data: data,
        columns: [
            {data: 'id'},
            {
                data: 'created_at', render: function (data, type, row) {
                    return window.moment(data).format("YYYY-MM-DD HH:mm:ss");
                }
            },
            {data: 'beer_type.name'},
            {data: 'cost'}
        ],

        "order": [[0, "desc"]]
    });
}

function processData() {
    var data = JSON.parse($("#data").val());

    var data_sorted = _.groupBy(data, function (data) {
        return data['beer_type']['name'];
    });

    var drinks_days = {};
    var diagrammdata = {};
    for (var beertype in data_sorted) {

        drinks_days[beertype] = _.countBy(data_sorted[beertype], function (date) {
            return moment(date.created_at).startOf('day').format();
        });


        let data = [];

        for (var prop in drinks_days[beertype]) {
            data.push({'t': moment(prop), 'y': drinks_days[beertype][prop]});
        }

        diagrammdata[beertype] = data;

    }

    var enddate = moment().add(1, 'days');
    var startdate = moment().add(-2, 'months');

    var duration = moment.duration(enddate.diff(startdate));
    var days = duration.asDays();
    var drinkscount = data.length;
    var drinksperday = round(drinkscount / days, 2);

    var timeFormat = 'DD/MM/YYYY';
    return {data, diagrammdata, enddate, startdate, drinksperday, timeFormat, data_sorted};
}

$(document).ready(function () {
    var {data, diagrammdata, enddate, startdate, drinksperday, timeFormat, data_sorted} = processData();

    drawConsumptionChart(diagrammdata, startdate, drinksperday, enddate, timeFormat);

    drawPieChart(data_sorted);

    initTable(data);

});
