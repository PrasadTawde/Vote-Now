$(document).ready(function(){

	$.ajax({
		url : "../charts/courses.php",
		data : "GET",
		success : function(html)
		{
		var ctx2 = document.getElementById('courseChart').getContext('2d');
			var courseChart = new Chart(ctx2, {
				type: 'pie',
				data: {
					datasets: [{
						data: html,
						"backgroundColor":["rgb(23, 125, 255)","rgb(255, 100, 109)","rgb(253, 190, 70)","rgb(51, 204, 51)","rgb(204, 51, 255)"],
						borderWidth: 0
					}],
					labels: ['Goa Business School', 'Ma' , 'Mcom', 'all'] 
				},
				options : {
					responsive: true, 
					maintainAspectRatio: false,
					legend: {
						position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 20
						}
					},
					pieceLabel: {
						render: 'percentage',
						fontColor: 'white',
						fontSize: 14,
					},
					tooltips: false,
					layout: {
						padding: {
							left: 20,
							right: 20,
							top: 20,
							bottom: 20
						}
					}
				}
			});
		}
});
});