window.Chart = require('chart.js');

window.getChart = function(labels,count,label){
	return {
		type: 'bar',
		responsive: true,
		aspectRatio: 2,
		data: {
			labels: labels,
			datasets: [{
				data: count,
				label: label,
				backgroundColor: 'rgba(37,150, 0,1)',
				borderColor: 'rgba(255, 255, 255, 1)',
				borderWidth: 1,
				barThickness: 5,
				maxBarThickness: 5,
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}],
				xAxes: [{
					categoryPercentage: 1.0,
					barPercentage: 1.0
				}]
			}
		}
	}
}


