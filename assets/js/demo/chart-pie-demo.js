// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
var ctx = document.getElementById("myPieChart");
var atx = document.getElementById("myBarChart");

var voting = [];
var nama = [];
var color = [];
var user;


totalUser();
chart();

setInterval(function(){
	chart();
}, 10000);

setInterval(function(){
	totalUser();
}, 10000);



function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function chart() {
	//setInterval(function () {
		$.ajax({
			type: 'GET',
			url: url + "/Data/hasilDataVoting",
			async: false,
			dataType: 'JSON',
			beforeSend: function(){
                // Show image container
                $('#loader-wrapper').show();
            },
			success: function (data) {
				var html = '';
				for (let i = 0; i < data.length; i++) {
					if (color[i] == null) {
						
						color[i] = getRandomColor();

					} else {

						nama[i] = "Paslon " + data[i]["nomer_paslon"];
						voting[i] = data[i]["points_vote"];
						html += '<span class="mr-2"><i class="fas fa-circle " style="color:' + color[i] + '"></i>' + nama[i] + '</span>'
	
					}
				}
				$('#namapaslon').html(html);

				var myPieChart = new Chart(ctx, {
					type: 'doughnut',
					data: {
						labels: nama,
						datasets: [{
							data: voting,
							backgroundColor: color,
							hoverBackgroundColor: color,
							hoverBorderColor: "rgba(234, 236, 244, 1)",
						}],
					},
					options: {
						maintainAspectRatio: false,
						tooltips: {
							backgroundColor: "rgb(255,255,255)",
							bodyFontColor: "#858796",
							borderColor: '#dddfeb',
							borderWidth: 1,
							xPadding: 15,
							yPadding: 15,
							displayColors: false,
							caretPadding: 10,
						},
						legend: {
							display: false
						},
						cutoutPercentage: 80,
					},
				});

				var myBarChart = new Chart(atx, {
					type: 'bar',
					data: {
						labels: nama,
						datasets: [{
							label: "Voting",
							backgroundColor: color,
							hoverBackgroundColor: "#2e59d9",
							borderColor: "#4e73df",
							data: voting,
						}],
					},
					options: {
						maintainAspectRatio: false,
						layout: {
							padding: {
								left: 10,
								right: 25,
								top: 25,
								bottom: 0
							}
						},
						scales: {
							xAxes: [{
								time: {
									unit: 'month'
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 6
								},
								maxBarThickness: 25,
							}],
							yAxes: [{
								ticks: {
									min: 0,
									max: user,
									maxTicksLimit: 5,
									padding: 10,

								},
								gridLines: {
									color: "rgb(234, 236, 244)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: false,
									borderDash: [2],
									zeroLineBorderDash: [2]
								}
							}],
						},
						legend: {
							display: false
						},
						tooltips: {
							titleMarginBottom: 10,
							titleFontColor: '#6e707e',
							titleFontSize: 14,
							backgroundColor: "rgb(255,255,255)",
							bodyFontColor: "#858796",
							borderColor: '#dddfeb',
							borderWidth: 1,
							xPadding: 15,
							yPadding: 15,
							displayColors: false,
							caretPadding: 10,
							callbacks: {

							}
						},
					}
				});

			},
			error: function (jqXHR, textStatus, error) {
				alert('Error Read Data Voting : ' + error + jqXHR + textStatus);
			}
		});
//	}, 10000);
}

function totalUser() {
	//setInterval(function () {
		$.ajax({
			type: 'GET',
			url: url + "/Data/totalUser",
			async: false,
			dataType: 'JSON',
			beforeSend: function(){
                // Show image container
                $('#loader-wrapper').show();
            },
			success: function (data) {
				var temp = Object.values(data);
				for (let index = 0; index < temp.length; index++) {
					var values = temp[index];
				}
				user = parseInt(values);
				//console.log(user);
			},
			error: function (jqXHR, textStatus, error) {
				alert("Error Read Data Total User : " + jqXHR + textStatus + error);
			}

		});
	//}, 10000);
}





// Pie Chart Example
