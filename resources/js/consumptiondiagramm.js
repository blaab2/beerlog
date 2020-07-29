$(document).ready(function () {
    var data = JSON.parse($("#data").val());


    var counts = _.countBy(data, function (date) {
        return moment(date.created_at).startOf('day').format();
    });


    var diagrammdata = [];

    for (var prop in counts) {
        diagrammdata.push({'t': moment(prop), 'y': counts[prop]});
    }


    var timeFormat = 'DD/MM/YYYY';

    var ctx = document.getElementById('myChart');


    var timeFormat = 'DD/MM/YYYY';

    var config = {
        type: 'bar',
        data: {
            datasets: [
                {
                    label: "Consumption",
                    data: diagrammdata,
                    fill: true,
                    backgroundColor: '#00bc8c',
                    borderColor: '#00bc8c'
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
                        max: moment().add(1, 'days')
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Drinks'
                    },
                    ticks: {
                        fontColor: '#fff'
                    }
                }]
            },
            plugins: {
                datalabels: {
                    display: false,
                },
            }
        }
    };

    var chart = new Chart(ctx, config);
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

});
