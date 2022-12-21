

<script>
Chart.defaults.global.defaultFontFamily = "'NanumSquareRound', sans-serif";


// https://www.chartjs.org/docs/latest/charts/line.html
var ctx = document.querySelector('#chart-line1').getContext('2d');
var myChart = new Chart(ctx, {
	type: 'line',	
	data: {
		labels: ["1일", "2일", "3일", "4일", "5일", "6일", "7일", "8일", "9일", "10일"],
		datasets: [{
			label: "",
			data: [232, 300, 360, 321, 256, 412, 333, 180, 175, 205],
			pointBackgroundColor:'#fff',
			pointBorderWidth:2,			
			borderColor: '#1bc8a6',
			borderWidth: 2,
			fill:'start',
			backgroundColor: 'rgba(27,200,166,0.2)',
			lineTension:0.2
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio:false,
		legend: {
			display: false,
		},
		scales: {
			fontStyle: "bold",
			xAxes: [{
				gridLines: {
					//color: "#d4d4d4",
					borderDash: [2, 5],
					
				},
				ticks: {fontStyle: "bold"}
			}],
			yAxes: [{
				gridLines : {borderDash: [2, 5]},
				ticks: {
					min: 0,
					max: 700,
					stepSize : 100,
					fontSize : 10,
					fontStyle: 'bold'
				}				
			}]
		},
		tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
		layout: {
			padding:{top:20,bottom:10,right:20,left:20}
		},
		 plugins: {
            datalabels: {
                color: '#000',
                textAlign: 'left',
				align: 'top',
                font: {
					size:11,
					//weight: 'bold'			
                },
                formatter: function(value, ctx) {
					return value + '명';
                }
            }
        }
	}
});

var ctx2 = document.querySelector('#chart-line2').getContext('2d');
var myChart = new Chart(ctx2, {
	type: 'line',	
	data: {
		labels: ["1일", "2일", "3일", "4일", "5일", "6일", "7일", "8일", "9일", "10일"],
		datasets: [{
			label: "",
			data: [232, 300, 360, 321, 256, 412, 333, 180, 175, 205],
			pointBackgroundColor:'#fff',
			pointBorderWidth:2,			
			borderColor: '#1bc8a6',
			borderWidth: 2,
			fill:'start',
			backgroundColor: 'rgba(27,200,166,0.2)',
			lineTension:0.2
		}]
	},
	options: {
		responsive: true,
		maintainAspectRatio:false,
		legend: {
			display: false,
		},
		scales: {
			fontStyle: "bold",
			xAxes: [{
				gridLines: {
					//color: "#d4d4d4",
					borderDash: [2, 5],
					
				},
				ticks: {fontStyle: "bold"}
			}],
			yAxes: [{
				gridLines : {borderDash: [2, 5]},
				ticks: {
					min: 0,
					max: 700,
					stepSize : 100,
					fontSize : 10,
					fontStyle: 'bold'
				}				
			}]
		},
		tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
		layout: {
			padding:{top:20,bottom:10,right:20,left:20}
		},
		 plugins: {
            datalabels: {
                color: '#000',
                textAlign: 'left',
				align: 'top',
                font: {
					size:11,
					//weight: 'bold'			
                },
                formatter: function(value, ctx) {
					return value + '명';
                }
            }
        }
	}
});




// Doughnut chart
// https://www.chartjs.org/docs/latest/charts/doughnut.html
var ctx3 = document.querySelector('#chart-doughnut1').getContext('2d');
var myChart = new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: ['A지역', 'B지역', 'C지역', 'D지역', 'E지역'],
        datasets: [{
            data: [10, 30, 15, 25, 20],
            backgroundColor: ['#0bb496', '#14c8a9', '#16d6b5', '#19dee0', '#13c0d0'],
            borderWidth: 0
        }]
    },
    options: { 
		maintainAspectRatio:false,
        legend: {
            display: false,
            position: 'bottom',
            labels: {
                boxWidth: 10,
				boxHeight: 2,
                fontColor: '#797C8F',
				fontSize : 14,
				fontStyle : 'bold',
                padding: 20
            }
        },
        tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
        plugins: {
            datalabels: {
                color: '#fff',
                textAlign: 'center',
                font: {
                    lineHeight: 1.1,
					size:12,
					weight: 'bold',
					
                },
                formatter: function(value, ctx) {
                    return ctx.chart.data.labels[ctx.dataIndex] + '\n' + value + '%';
					//return value + '%';
                }
            }
        }
    }
});

var ctx4 = document.querySelector('#chart-doughnut2').getContext('2d');
var myChart = new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: ['A타입', 'B타입', 'C타입', 'D타입', 'E타입'],
        datasets: [{
            data: [10, 30, 15, 25, 20],
            backgroundColor: ['#2744db', '#376ce4', '#3b89ea', '#4995f4', '#49a5f4'],
            borderWidth: 0
        }]
    },
    options: { 
		maintainAspectRatio:false,
        legend: {
            display: false,
            position: 'bottom',
            labels: {
                boxWidth: 10,
				boxHeight: 2,
                fontColor: '#797C8F',
				fontSize : 14,
				fontStyle : 'bold',
                padding: 20
            }
        },
       tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
        plugins: {
            datalabels: {
                color: '#fff',
                textAlign: 'center',
                font: {
                    lineHeight: 1.1,
					size:12,
					weight: 'bold',
					
                },
                formatter: function(value, ctx) {
                    return ctx.chart.data.labels[ctx.dataIndex] + '\n' + value + '%';
					//return value + '%';
                }
            }
        }
    }
});

var ctx5 = document.querySelector('#chart-bar1').getContext('2d');
var myChart = new Chart(ctx5, {
    type: 'bar',
    data: {
        labels: ['10대', '20대', '30대', '40대', '50대'],
        datasets: [{
            data: [200, 230, 215, 225, 220],
            backgroundColor: ['#0bb496', '#14c8a9', '#16d6b5', '#19dee0', '#13c0d0'],
            borderWidth: 0
        }]
    },
	options: {
		responsive: true,
		maintainAspectRatio:false,
		legend: {
			display: false,
		},
		scales: {
			xAxes: [{
				gridLines: {
					borderDash: [2, 5],
					
				},
				ticks: {fontStyle: "bold"}
			}],
			yAxes: [{
				gridLines : {borderDash: [2, 5]},
				ticks: {
					min: 0,
					max: 500,
					stepSize : 100,
					fontSize : 10,
					fontStyle: 'bold'
				}				
			}]
		},
		tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
		layout: {
			padding:{top:20,bottom:10,right:20,left:20}
		},
		 plugins: {
            datalabels: {
                color: '#fff',
                textAlign: 'left',
				align: 'top',
                font: {
					size:11,
					weight: 'bold'			
                },
                formatter: function(value, ctx) {
					return value + '명';
                }
            }
        }
	}
});

var ctx6 = document.querySelector('#chart-bar2').getContext('2d');
var myChart = new Chart(ctx6, {
    type: 'bar',
    data: {
        labels: ['10대', '20대', '30대', '40대', '50대'],
        datasets: [{
            data: [200, 230, 215, 225, 220],
            backgroundColor: ['#2744db', '#376ce4', '#3b89ea', '#4995f4', '#49a5f4'],
            borderWidth: 0
        }]
    },
	options: {
		responsive: true,
		maintainAspectRatio:false,
		legend: {
			display: false,
		},
		scales: {
			xAxes: [{
				gridLines: {
					borderDash: [2, 5],
					
				},
				ticks: {fontStyle: "bold"}
			}],
			yAxes: [{
				gridLines : {borderDash: [2, 5]},
				ticks: {
					min: 0,
					max: 500,
					stepSize : 100,
					fontSize : 10,
					fontStyle: 'bold'
				}				
			}]
		},
		tooltips: {
			displayColors : false,
			backgroundColor : 'rgba(0,0,0,0.9)',
			titleFontColor: '#fff',
			titleAlign: 'center',
			bodySpacing: 2,
			bodyFontColor: '#fff',
		},
		layout: {
			padding:{top:20,bottom:10,right:20,left:20}
		},
		 plugins: {
            datalabels: {
                color: '#fff',
                textAlign: 'left',
				align: 'top',
                font: {
					size:11,
					weight: 'bold'			
                },
                formatter: function(value, ctx) {
					return value + '명';
                }
            }
        }
	}
});

</script>