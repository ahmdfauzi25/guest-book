<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<?= form_error('servicetype', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newServiceTypeModal">Add New Service Type</a>

			<table class="table table-hover mt-3">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Service Type</th>
						<th scope="col">Action</th>
						<!-- <th scope="col">#</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;  ?>
					<?php foreach ($servicetype as $st) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $st['service_type']; ?></td>
							<td>
								<a href="" class="badge badge-success" data-toggle="modal" data-target="#editServiceTypeModal<?= $st['id']; ?>">Edit</a>
								<a href="<?= base_url('servicetype/delete/') . $st['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus service type ini?');">Delete</a>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
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
<div class="modal fade" id="newServiceTypeModal" tabindex="-1" role="dialog" aria-labelledby="newServiceTypeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newServiceTypeModal">Add New Service Type</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('servicetype'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<select class="form-control" id="service_type" name="service_type">
							<option value="">Pilih Tipe Layanan</option>
							<option value="VVIP">VVIP</option>
							<option value="NON-VVIP">NON-VVIP</option>
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

<!-- Modal Edit Service Type -->
<?php foreach ($servicetype as $st) : ?>
<div class="modal fade" id="editServiceTypeModal<?= $st['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editServiceTypeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Service Type</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('servicetype/edit/') . $st['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<select class="form-control" id="service_type" name="service_type">
							<option value="VVIP" <?= $st['service_type'] == 'VVIP' ? 'selected' : ''; ?>>VVIP</option>
							<option value="NON-VVIP" <?= $st['service_type'] == 'NON-VVIP' ? 'selected' : ''; ?>>NON-VVIP</option>
						</select>
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

