<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<!-- Card Container -->
			<div class="card mt-3">
				<div class="card-header">
					<h5 class="card-title">Daftar Lantai</h5>
				</div>
				<div class="card-body">
					<?= form_error('floor', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newFloorModal">Add New Floor</a>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Floor</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;  ?>
							<?php foreach ($floor as $fr) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $fr['floor']; ?></td>
									<td>
										<a href="" class="badge badge-success" data-toggle="modal" data-target="#editFloorModal<?= $fr['id']; ?>">Edit</a>
										<a href="<?= base_url('floor/delete/') . $fr['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus lantai ini?');">Delete</a>
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
<div class="modal fade" id="newFloorModal" tabindex="-1" role="dialog" aria-labelledby="newFloorModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newFloorModal">Add New Floor</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('floor'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
					<input type="text" class="form-control" id="floor" name="floor" placeholder="Floor">
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
<?php foreach ($floor as $fr) : ?>
<div class="modal fade" id="editFloorModal<?= $fr['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editFloorModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Floor</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('floor/edit/') . $fr['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="floor" name="floor" value="<?= $fr['floor']; ?>">
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

