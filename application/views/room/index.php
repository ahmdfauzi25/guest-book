<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<!-- Card Container -->
			<div class="card mt-3">
				<div class="card-header">
					<h5 class="card-title">Daftar Room</h5>
				</div>
				<div class="card-body">
					<?= form_error('room', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoomModal">Add New Room</a>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Room</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;  ?>
							<?php foreach ($room as $rm) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $rm['room']; ?></td>
									<td>
										<a href="" class="badge badge-success" data-toggle="modal" data-target="#editRoomModal<?= $rm['id']; ?>">Edit</a>
										<a href="<?= base_url('room/delete/') . $rm['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus room ini?');">Delete</a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- End Card Container -->
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

<!-- Modal -->
<div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newRoomModal">Add New Room</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('room'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
					<input type="text" class="form-control" id="room" name="room" placeholder="Room">
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

<!-- Modal Edit Floor -->
<?php foreach ($room as $rm) : ?>
<div class="modal fade" id="editRoomModal<?= $rm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Room</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('room/edit/') . $rm['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="room" name="room" value="<?= $rm['room']; ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

