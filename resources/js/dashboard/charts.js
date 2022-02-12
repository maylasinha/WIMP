$(function () {
	var url = window.location.pathname.split('/').pop(),
			ct1 = $('#visitsReport'),
			ct2 = $('#usersReport'),
			ct3 = $('#petsReport'),
			ct4 = $('#testimonialsReport');

	if(url == 'home') {
		$('.loader').html('<i class="fas fa-spinner fa-spin" style="position: absolute; top: 50%; display: inline-block;"></i>');

		// Get overview data
		$.ajax({
			url: APP_URL + '/admin/overview',
			type: 'GET',
			dataType: 'json',
			cache: false,
			success: function(result) {
				$('#visits').html(result.total_visits);
				$('#users').html(result.total_users);
				$('#pets').html(result.total_pets);
				$('#testimonials').html(result.total_testimonials);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('.loader').html('<i class="fas fa-exclamation-triangle text-warning"></i>');
			}
		});

		// Pet comments report
		if (ct1.length > 0) {
			$.ajax({
				url: APP_URL + '/admin/reports/visits',
				type: 'GET',
				success: function(result) {
					var colors = [];

					$.each(result.datasets.data, function(key,val) {
						colors.push(getRandomColor());
					});

					var visitsReportChart = new Chart(ct1, {
						type: 'bar',
						data: {
							labels: result.labels,
							datasets: [
								{
									data: result.datasets.data,
									backgroundColor: colors
								}
							]
						},
						options: {
							title: {
								display: true,
								text: 'Acessos por Sistema Operacional'
							},
							legend: {
								display: false
							},
							tooltips: {
								enabled: true,
								mode: 'single'
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										stepSize : 50,
										beginAtZero: true
									}
								}]
							}
						}
					});
				},
				error: function(xhr) {
					new Noty({
						text: '<i class="fas fa-times fa-fw"></i> ' + xhr.responseText,
						type: 'error',
						theme: 'mint',
						timeout: 3000
					}).show();
				}
			});
		}

		// Users report
		if (ct2.length > 0) {
			$.ajax({
				url: APP_URL + '/admin/reports/users',
				type: 'GET',
				success: function(result) {
					var colors = [];

					$.each(result.datasets.data, function(key,val) {
						colors.push(getRandomColor());
					});

					var usersReportChart = new Chart(ct2, {
						type: 'bar',
						data: {
							labels: result.labels,
							datasets: [
								{
									data: result.datasets.data,
									backgroundColor: colors
								}
							]
						},
						options: {
							title: {
								display: true,
								text: 'Usuários por Perfil'
							},
							legend: {
								display: false
							},
							tooltips: {
								enabled: true,
								mode: 'single'
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										stepSize : 50,
										beginAtZero: true
									}
								}]
							}
						}
					});
				},
				error: function(xhr) {
					new Noty({
						text: '<i class="fas fa-times fa-fw"></i> ' + xhr.responseText,
						type: 'error',
						theme: 'mint',
						timeout: 3000
					}).show();
				}
			});
		}

		// Pets report
		if (ct3.length > 0) {
			$.ajax({
				url: APP_URL + '/admin/reports/pets',
				type: 'GET',
				success: function(result) {
					var colors = [];

					$.each(result.datasets.data, function(key,val) {
						colors.push(getRandomColor());
					});

					var petsReportChart = new Chart(ct3, {
						type: 'bar',
						data: {
							labels: result.labels,
							datasets: [
								{
									data: result.datasets.data,
									backgroundColor: colors
								}
							]
						},
						options: {
							title: {
								display: true,
								text: 'Pets por Categoria'
							},
							legend: {
								display: false
							},
							tooltips: {
								enabled: true,
								mode: 'single'
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										stepSize : 50,
										beginAtZero: true
									}
								}]
							}
						}
					});
				},
				error: function(xhr) {
					new Noty({
						text: '<i class="fas fa-times fa-fw"></i> ' + xhr.responseText,
						type: 'error',
						theme: 'mint',
						timeout: 3000
					}).show();
				}
			});
		}

		// Testimonials report
		if (ct4.length > 0) {
			$.ajax({
				url: APP_URL + '/admin/reports/testimonials',
				type: 'GET',
				success: function(result) {
					var colors = [];

					$.each(result.datasets.data, function(key,val) {
						colors.push(getRandomColor());
					});

					var testimonialsReportChart = new Chart(ct4, {
						type: 'bar',
						data: {
							labels: result.labels,
							datasets: [
								{
									data: result.datasets.data,
									backgroundColor: colors
								}
							]
						},
						options: {
							title: {
								display: true,
								text: 'Depoimentos por Status'
							},
							legend: {
								display: false
							},
							tooltips: {
								enabled: true,
								mode: 'single'
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										stepSize : 50,
										beginAtZero: true
									}
								}]
							}
						}
					});
				},
				error: function(xhr) {
					new Noty({
						text: '<i class="fas fa-times fa-fw"></i> ' + xhr.responseText,
						type: 'error',
						theme: 'mint',
						timeout: 3000
					}).show();
				}
			});
		}
	}
});

function getRandomColor() {
	var letters = '0123456789ABCDEF'.split(''),
			color = '#';

	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}

	return color;
}