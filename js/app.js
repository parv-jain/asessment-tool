$(document).ready(function(){
	$.ajax({
    dataType:"json",
		url: "data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var parameter = [];
			var rating = [];
      for (var i in data) {
				parameter.push(data[i].id);
				rating.push(data[i].rating);
			}
			var chartdata = {
				labels: parameter,
				datasets : [
					{
						label: 'Rating',
						backgroundColor: 'rgba(229,57,53, 0.75)',
						borderColor: 'rgba(198,40,40, 0.8)',
						hoverBackgroundColor: 'rgba(198,40,40, 0.8)',
						hoverBorderColor: 'rgba(183, 28, 28, 1)',
						data: rating
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
