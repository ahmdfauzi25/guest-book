<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1 class="h3 text-gray-800 mb-0"><?= $title; ?></h1>
		<a href="<?= base_url('admin/pdf'); ?>" class="btn btn-danger btn-sm">
			<i class="fas fa-file-pdf mr-2"></i>Export PDF
		</a>
	</div>

	<div class="row">
		<div class="col-xl-3">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Guest Today</h6>
				</div>
				<div class="card-body position-relative">
                <div class="chart-container">
                    <canvas id="guestsChart"></canvas>
                    <div class="total-guests-circle">
                        <span class="total-number"><?= $total_guests; ?></span>
                    </div>
                </div>
            </div>
        </div>
		</div>
		<div class="col-xl-9">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Guest Monthly</h6>
				</div>
				<div class="card-body position-relative">
                <div class="chart-container2">
                    <canvas id="myLineChart"></canvas>
                </div>
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
				<div class="card-header py-3 d-flex justify-content-between align-items-center">
					<h6 class="m-0 font-weight-bold text-primary">Data Guest</h6>
					
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div style="min-width: 1200px;">
							<table class="table table-bordered" id="dataTable" cellspacing="0">
								<thead>
									<tr>
										<th style="width: 3%;">#</th>
										<th style="width: 10%;">Name Quest</th>
										<th style="width: 7%;">No Badge</th>
										<th style="width: 8%;">Visitor Phi</th>
										<th style="width: 10%;">Instansi</th>
										<th style="width: 8%;">Service Type</th>
										<th style="width: 8%;">Telp</th>
										<th style="width: 10%;">Needs</th>
										<th style="width: 8%;">Arrival Time</th>
										<th style="width: 8%;">Return Time</th>
										<th style="width: 5%;">Floor</th>
										<th style="width: 5%;">Room</th>
										<th style="width: 5%;">Schedule</th>
										<th style="width: 5%;">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;  ?>
									<?php foreach ($guestbook as $gb) : ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $gb['name_guest']; ?></td>
											<td><?= $gb['no_badge']; ?></td>
											<td><?= $gb['visitor_phi']; ?></td>
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
											<td><?php 
												foreach($floor as $f) {
													if($f['id'] == $gb['floor_id']) {
														echo $f['floor'];
														break;
													}
												}
											?></td>
											<td><?php 
												foreach($room as $r) {
													if($r['id'] == $gb['room_id']) {
														echo $r['room'];
														break;
													}
												}
											?></td>
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
			maintainAspectRatio: false,
			scales: {
				y: {
					beginAtZero: true,
					grid: {
						drawBorder: false
					}
				},
				x: {
					grid: {
						drawBorder: false
					}
				}
			},
			plugins: {
				legend: {
					position: 'top'
				}
			}
		}
	});

	var ctx = document.getElementById('guestsChart').getContext('2d');
	var guestsChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: [<?php 
				if (!empty($guests_per_floor)) {
					$labels = array_map(function($floor) {
						$floorName = isset($floor['floor_name']) ? $floor['floor_name'] : $floor['floor'];
						return "\" " . $floorName . "\"";
					}, $guests_per_floor);
					echo implode(", ", $labels);
				} else {
					echo '"Tidak ada data"';
				}
			?>],
			datasets: [{
				data: [<?php 
					if (!empty($guests_per_floor)) {
						$values = array_map(function($floor) {
							return $floor['total_guests'];
						}, $guests_per_floor);
						echo implode(", ", $values);
					} else {
						echo "0";
					}
				?>],
				backgroundColor: [
					'#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
					'#858796', '#5a5c69', '#2e59d9', '#17a673', '#2c9faf'
				],
				borderWidth: 1
			}]
		},
		options: {
			maintainAspectRatio: false,
			cutout: '60%',
			plugins: {
				legend: {
					position: 'top'
				},
				tooltip: {
					callbacks: {
						label: function(context) {
							let label = context.label || '';
							if (label) {
								label += ' : ';
							}
							label += context.formattedValue + ' Tamu';
							return label;
						}
					}
				}
			}
		}
	});

	
</script>

<style>
.total-guests-circle {
	position: absolute;
	top: 55%;
	left: 50%;
	transform: translate(-50%, -50%);
	text-align: center;
	font-size: 14px;
	line-height: 1.4;
	/* background: rgba(255, 255, 255, 0.9); */
	padding: 10px;
	border-radius: 8px;
}

.total-number {
	font-size: 75px;
	font-weight: 700;
	color: #000000;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

#dataTable th, #dataTable td {
    white-space: nowrap;
    padding: 8px 12px;
}

.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.chart-container {
    position: relative;
    height: 300px;
    width: 100%;
}
.chart-container2 {
    position: relative;
    height: 300px;
    width: 100%;
}
</style>

