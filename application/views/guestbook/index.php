<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg">
			<!-- Menambahkan card untuk menampilkan guestbook -->
			<div class="card">
				<div class="card-header">
					<!-- <h2 class="card-title"><?= $title; ?></h2> -->
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newGuestbookModal">Add New Guest</a>
				</div>
				<div class="card-body">
					<?= form_error('guestbook', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<div class="table-responsive">
						<table class="table table-hover mt-3">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name Quest</th>
									<th scope="col">No Badge</th>
									<th scope="col">Visitor Phi</th>
									<th scope="col">Instansi</th>
									<th scope="col">Service Type</th>
									<th scope="col">Telp</th>
									<th scope="col">Needs</th>
									<th scope="col">Arrival Time</th>
									<th scope="col">Return Time</th>
									<th scope="col">Floor</th>
									<th scope="col">Room</th>
									<th scope="col">Schedule</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
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
										<td>
											<a href="" class="badge badge-success" data-toggle="modal" data-target="#editGuestbookModal<?= $gb['id']; ?>">Edit</a>
											<a href="<?=base_url('guestbook/delete/') . $gb['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Tamu ini?');">Delete</a>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">
	Launch demo modal
</button> -->

<!-- Modal Created-->
<div class="modal fade" id="newGuestbookModal" tabindex="-1" role="dialog" aria-labelledby="newGuestbookModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newGuestbookModal">Add New Guest</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('guestbook'); ?>" method="post">
				<div class="modal-body">
				<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="name_guest" name="name_guest" placeholder="Name Quest">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="no_badge" name="no_badge" placeholder="No Badge">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="visitor_phi" name="visitor_phi" placeholder="Visitor Phi">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="instansi" name="instansi" placeholder="Instansi">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="servicetype_id" id="servicetype_id" class="form-control">
							<option value="">Select Service Type</option>
							<?php foreach ($servicetype as $s) : ?>
								<option value="<?= $s['id']; ?>"><?= $s['service_type']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="kepentingan" name="kepentingan" placeholder="Kepentingan">
					</div>
					<div class="form-group">
						<!-- Mengubah input waktu kedatangan menjadi pemilih waktu -->
						<input type="time" class="form-control" id="waktu_kedatangan" name="waktu_kedatangan">
					</div>
					<div class="form-group">
						<!-- Mengubah input waktu kepulagan menjadi pemilih waktu -->
						<input type="time" class="form-control" id="waktu_kepulangan" name="waktu_kepulangan">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="floor_id" id="floor_id" class="form-control">
							<option value="">Select Floor</option>
							<?php foreach ($floor as $f) : ?>
								<option value="<?= $f['id']; ?>"><?= $f['floor']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="room_id" id="room_id" class="form-control">
							<option value="">Select Room</option>
							<?php foreach ($room as $r) : ?>
								<option value="<?= $r['id']; ?>"><?= $r['room']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="date_created" name="date_created">
					</div>
					<div class="form-group">
						<select class="form-control" id="status" name="status">
							<option value="">Pilih Status Tamu</option>
							<option value="0">Belum Hadir</option>
							<option value="1">Sudah Hadir</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<?php foreach ($guestbook as $gb) : ?>
<div class="modal fade" id="editGuestbookModal<?= $gb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editGuestbookModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="editGuestbookModal">Edit Guest</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('guestbook/edit/') . $gb['id']; ?>" method="post">
				<div class="modal-body">
				<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="name_guest" name="name_guest" placeholder="Name Quest" value="<?= $gb['name_guest']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="no_badge" name="no_badge" placeholder="No Badge" value="<?= $gb['no_badge']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="visitor_phi" name="visitor_phi" placeholder="Visitor Phi" value="<?= $gb['visitor_phi']; ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="instansi" name="instansi" placeholder="Instansi" value="<?= $gb['instansi']; ?>">
					</div>
					<div class="form-group">
						<select name="servicetype_id" id="servicetype_id" class="form-control">
							<option value="">Select Service Type</option>
							<?php foreach ($servicetype as $s) : ?>
								<option value="<?= $s['id']; ?>" <?= ($s['id'] == $gb['servicetype_id']) ? 'selected' : ''; ?>><?= $s['service_type']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telp" value="<?= $gb['no_telp']; ?>">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="kepentingan" name="kepentingan" placeholder="Kepentingan" value="<?= $gb['kepentingan']; ?>">
					</div>
					<div class="form-group">
						<!-- Mengubah input waktu kedatangan menjadi pemilih waktu -->
						<input type="time" class="form-control" id="waktu_kedatangan" name="waktu_kedatangan" value="<?= $gb['waktu_kedatangan']; ?>">
					</div>
					<div class="form-group">
						<!-- Mengubah input waktu kepulagan menjadi pemilih waktu -->
						<input type="time" class="form-control" id="waktu_kepulangan" name="waktu_kepulangan" value="<?= $gb['waktu_kepulangan']; ?>">
					</div>
					<div class="form-group">
						<select name="floor_id" id="floor_id" class="form-control">
							<option value="">Select Floor</option>
							<?php foreach ($floor as $f) : ?>
								<option value="<?= $f['id']; ?>" <?= ($f['id'] == $gb['floor_id']) ? 'selected' : ''; ?>><?= $f['floor']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="room_id" id="room_id" class="form-control">
							<option value="">Select Room</option>
							<?php foreach ($room as $r) : ?>
								<option value="<?= $r['id']; ?>" <?= ($r['id'] == $gb['room_id']) ? 'selected' : ''; ?>><?= $r['room']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="date_created" name="date_created" value="<?= $gb['date_created']; ?>">
					</div>
					<div class="form-group">
						<select class="form-control" id="status" name="status">
							<option value="">Pilih Status Tamu</option>
							<option value="0" <?= $gb['status'] == 0 ? 'selected' : ''; ?>>Belum Hadir</option>
							<option value="1" <?= $gb['status'] == 1 ? 'selected' : ''; ?>>Sudah Hadir</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<style>
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table {
    min-width: 1200px; /* Sesuaikan dengan kebutuhan */
}
</style>

