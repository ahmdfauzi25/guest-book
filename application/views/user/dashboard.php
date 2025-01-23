<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-xl-3">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Guest Today</h6>
				</div>
				<div class="card-body position-relative">
					<canvas id="guestsChart" style="height: 400px; width:400px;"></canvas>
					<div class="total-guests-circle">
						<?= $total_guests; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Guest Monthly</h6>
				</div>
				<div class="card-body">
					<canvas id="myLineChart" style="height: 340px; width:1160px;"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Coming Today <?= date('d-m-Y'); ?></div>
							 <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_guests; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-clock fa-2x text-primary"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Good Enough</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_good_feedback; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-thumbs-up fa-2x text-success"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
							Less Good</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_bad_feedback; ?></div>
								</div>
								<!-- <div class="col">
									<div class="progress progress-sm mr-2">
										<div class="progress-bar bg-danger" role="progressbar"
										style="width: 50%" aria-valuenow="50" aria-valuemin="0"
										aria-valuemax="100"></div>
									</div>
								</div> -->
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-thumbs-down fa-2x text-danger"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Total Feedback</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_feedback_submitted; ?></div>
								<!-- <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div> -->
						</div>
						<div class="col-auto">
							<i class="fas fa-comments fa-2x text-warning"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- End-->

	<!-- Tambahkan Tabel Data Guestbook -->
	<div class="row">
		<div class="col-xl-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Guest</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name Quest</th>
						<th scope="col">Instansi</th>
						<th scope="col">Service Type</th>
						<th scope="col">Telp</th>
						<th scope="col">Needs</th>
						<th scope="col">Arrival Time</th>
						<th scope="col">Return Time</th>
						<th scope="col">Schedule</th>
						<th scope="col">Status</th>
						<!-- <th scope="col">Action</th> -->
						<!-- <th scope="col">#</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;  ?>
					<?php foreach ($guestbook as $gb) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $gb['name_guest']; ?></td>
							<td><?= $gb['instansi']; ?></td>
							<td><?php 
								foreach($servicetype as $s) {
									if($s['id'] == $gb['servicetype_id']) {
										echo $s['service_type'];
										break;
									}
								}
							?></td>
							<td><?= $gb['no_telp']; ?></td>
							<td><?= $gb['kepentingan']; ?></td>
							<td><?= $gb['waktu_kedatangan']; ?></td>
							<td><?= $gb['waktu_kepulangan']; ?></td>
							<td><?= date('d-m-Y', strtotime($gb['date_created'])); ?></td>
							<td>
							<?php if($gb['status'] == 1) : ?>
									<span class="badge badge-success">Sudah Hadir</span>
								<?php else : ?>
									<span class="badge badge-warning">Belum Hadir</span>
								<?php endif; ?>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Tabel Data Guestbook -->

	<!-- Line Chart Example -->
	<!-- <div class="row">
	
	</div> -->
	<!-- End Line Chart Example -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	var ctx = document.getElementById('myLineChart').getContext('2d');
	var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['<?= date('F', strtotime('first day of this month')); ?>', '<?= date('F', strtotime('first day of next month')); ?>', '<?= date('F', strtotime('first day of +2 months')); ?>', '<?= date('F', strtotime('first day of +3 months')); ?>', '<?= date('F', strtotime('first day of +4 months')); ?>', '<?= date('F', strtotime('first day of +5 months')); ?>', '<?= date('F', strtotime('first day of +6 months')); ?>', '<?= date('F', strtotime('first day of +7 months')); ?>', '<?= date('F', strtotime('first day of +8 months')); ?>', '<?= date('F', strtotime('first day of +9 months')); ?>', '<?= date('F', strtotime('first day of +10 months')); ?>', '<?= date('F', strtotime('first day of +11 months')); ?>'],
			datasets: [{
				label: 'Total Guest Monthly',
				data: [<?= $total_guests_month; ?>],
				backgroundColor: 'rgba(78, 115, 223, 0.05)',
				borderColor: 'rgba(78, 115, 223, 1)',
				borderWidth: 2,
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: false
				}
			}
		}
	});

	var ctx = document.getElementById('guestsChart').getContext('2d');
	var guestsChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Total Today'],
			datasets: [{
				label: 'Jumlah Tamu',
				data: [<?= $total_guests; ?>], // Ganti 100 dengan total tamu yang sesuai
				backgroundColor: ['#36A2EB', '#FF6384'],
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
			}
		}
	});
</script>

<style>
.total-guests-circle {
    position: absolute;
    top: 55%;
    left: 49%;
    transform: translate(-50%, -50%);
    background-color: white; /* Warna latar belakang */
    border-radius: 50%; /* Membuat bulatan */
    width: 80px; /* Ukuran bulatan */
    height: 80px; /* Ukuran bulatan */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold; /* Gaya teks */
    color: black; /* Warna teks */
    font-size: 85px; /* Ukuran font diperbesar */
}
</style>

