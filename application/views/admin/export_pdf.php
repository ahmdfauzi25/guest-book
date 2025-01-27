<!DOCTYPE html>
<html>

<head>
	<title>Laporan Dashboard</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 30px;
			/* Menambahkan margin di bawah tabel */
		}

		.table th,
		.table td {
			border: 1px solid #ddd;
			padding: 8px;
		}

		.table th {
			background-color: #f4f4f4;
		}
	</style>
</head>

<body>
	<h2>Laporan Dashboard</h2>
	<p>Tanggal: <?= date('d-m-Y') ?></p>

	<h3>Ringkasan</h3>
	<table class="table">
		<tr>
			<td>Total Tamu Hari Ini</td>
			<td><?= $total_guests ?></td>
		</tr>
		<tr>
			<td>Total Tamu Bulan Ini</td>
			<td><?= $total_guests_month ?></td>
		</tr>
		<tr>
			<td>Total Feedback Baik</td>
			<td><?= $total_good_feedback ?></td>
		</tr>
		<tr>
			<td>Total Feedback Buruk</td>
			<td><?= $total_bad_feedback ?></td>
		</tr>
		<tr>
			<td>Total Feedback Terkirim</td>
			<td><?= $total_feedback_submitted ?></td>
		</tr>
	</table>

	<h3>Daftar Tamu Hari Ini</h3>
	<table class="table">
		<tr>
			<th>Nama</th>
			<th>No Badge</th>
			<th>Visitor Phi</th>
			<th>Instansi</th>
			<th>Service Type</th>
			<th>Keperluan</th>
			<th>Waktu Kedatangan</th>
			<th>Waktu Kepulangan</th>
			<th>Floor</th>
			<th>Room</th>
		</tr>
		<?php foreach ($guestbook as $guest): ?>
			<tr>
				<td><?= $guest['name_guest'] ?></td>
				<td><?= $guest['no_badge'] ?></td>
				<td><?= $guest['visitor_phi'] ?></td>
				<td><?= $guest['instansi'] ?></td>
				<td><?php
					foreach ($servicetype as $s) {
						if ($s['id'] == $guest['servicetype_id']) {
							echo $s['service_type'];
							break;
						}
					}
					?></td>
				<td><?= $guest['kepentingan'] ?></td>
				<td><?= $guest['waktu_kedatangan'] ?></td>
				<td><?= $guest['waktu_kepulangan'] ?></td>
				<td><?php 
								foreach($floor as $f) {
									if($f['id'] == $guest['floor_id']) {
										echo $f['floor'];
										break;
									}
								}
							?></td>
							<td><?php 
								foreach($room as $r) {
									if($r['id'] == $guest['room_id']) {
										echo $r['room'];
										break;
									}
								}
							?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>

</html>
