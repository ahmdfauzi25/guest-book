<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<!-- Menambahkan card untuk tabel -->
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Daftar Role</h5>
				</div>
				<div class="card-body">
					<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Role</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;  ?>
							<?php foreach ($role as $r) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $r['role']; ?></td>
									<td>
										<a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">access</a>
										<a href="" class="badge badge-success" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>">Edit</a>
										<a href="<?= base_url('admin/roledelete/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?');">Delete</a>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMenuModal">
	Launch demo modal
</button> -->

<!-- Modal Create-->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newRoleModal">Add New Role</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>	
				</button>
			</div>
			<form action="<?= base_url('admin/role'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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

<!-- Modal Edit-->
<?php foreach ($role as $r) : ?>
<div class="modal fade" id="editRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Role</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/roleedit/') . $r['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="role" name="role" placeholder="Role Name" value="<?= $r['role']; ?>">
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
