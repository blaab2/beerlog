
//var style = getComputedStyle(document.body);
//var fontcolor = style.getPropertyValue('--white');
//Chart.defaults.global.defaultColor = fontcolor;

var ctx = document.getElementById('myChart');
var inputdata = JSON.parse($("#data").val());

inputdata.sort(function(a, b){return b['beers_count'] - a['beers_count']});

var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: inputdata.map(x => x['nickname']),
		datasets: [{
			label: '# of Votes',
			data: inputdata.map(x => x['beers_count']),
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			],
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
            display: true,
            labels: {
                fontColor: '#fff'
            }
        }
	}
});	