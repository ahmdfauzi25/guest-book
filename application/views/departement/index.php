<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<!-- Card Section -->
	<div class="card mb-4">
		<div class="card-header">
			<h5 class="m-0 font-weight-bold text-primary">Departement List</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg">
					<?= form_error('departement', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newDepartementModal">Add New Departement</a>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Departement</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;  ?>
							<?php foreach ($departement as $d) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $d['departement']; ?></td>
									<td>
										<a href="" class="badge badge-success" data-toggle="modal" data-target="#editMenuModal<?= $d['id']; ?>">Edit</a>
										<a href="<?= base_url('departement/delete/') . $d['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">Delete</a>
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
	<!-- End Card Section -->

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
<div class="modal fade" id="newDepartementModal" tabindex="-1" role="dialog" aria-labelledby="newDepartementModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newMenuModal">Add New Departement</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('departement'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="departement" name="departement" placeholder="departement Name">
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

<!-- Modal Edit Departement -->
<?php foreach ($departement as $d) : ?>
<div class="modal fade" id="editMenuModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel<?= $d['id']; ?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Departement</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('departement/edit/') . $d['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="departement" name="departement" placeholder="Departement Name" value="<?= $d['departement']; ?>">
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

