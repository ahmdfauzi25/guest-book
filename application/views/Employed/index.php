<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg">
		<?= form_error('employed', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
		<?= $this->session->flashdata('message'); ?>
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newEmployedModal">Add New Employed</a>

			<table class="table table-hover mt-3">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Birth of date</th>
						<th scope="col">NIK</th>
						<th scope="col">NIP</th>
						<th scope="col">Jobtitle</th>
						<th scope="col">Departement</th>
						<th scope="col">Address</th>
						<th scope="col">Active</th>
						<th scope="col">Action</th>
						<!-- <th scope="col">#</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;  ?>
					<?php foreach ($employed as $e) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $e['name']; ?></td>
							<td><?= date('d-m-Y', strtotime($e['tanggal_lahir'])); ?></td>
							<td><?= str_repeat('*', 11) . substr($e['nik'], -5); ?></td>
							<td><?= $e['nip']; ?></td>
							<td><?php 
								foreach($jobtitle as $j) {
									if($j['id'] == $e['jobtitle_id']) {
										echo $j['jobtitle'];
										break;
									}
								}
							?></td>
							<td><?php 
								foreach($departement as $d) {
									if($d['id'] == $e['departement_id']) {
										echo $d['departement'];
										break;
									}
								}
							?></td>
							<td><?= $e['address']; ?></td>
							<td>
								<?php if($e['is_active'] == 1) : ?>
									<span class="badge badge-success">Aktif</span>
								<?php else : ?>
									<span class="badge badge-danger">Non-aktif</span>
								<?php endif; ?>
							</td>
							<td>
								<a href="" class="badge badge-success" data-toggle="modal" data-target="#editEmployedModal<?= $e['id']; ?>">Edit</a>
								<a href="<?=base_url('employed/delete/') . $e['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus submenu ini?');">Delete</a>
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
<div class="modal fade" id="newEmployedModal" tabindex="-1" role="dialog" aria-labelledby="newEmployedModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newEmployedModal">Add New Employed</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('employed'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="jobtitle_id" id="jobtitle_id" class="form-control">
							<option value="">Select Jobtitle</option>
							<?php foreach ($jobtitle as $j) : ?>
								<option value="<?= $j['id']; ?>"><?= $j['jobtitle']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="departement_id" id="departement_id" class="form-control">
							<option value="">Select Departement</option>
							<?php foreach ($departement as $d) : ?>
								<option value="<?= $d['id']; ?>"><?= $d['departement']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="address" name="address" placeholder="Address">
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
							<label class="form-check-label" for="is_active">Active?</label>
						</div>
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
<?php foreach ($employed as $e) : ?>
<div class="modal fade" id="editEmployedModal<?= $e['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editEmployedModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Employed</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('employed/edit/') . $e['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= $e['name']; ?>">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $e['tanggal_lahir']; ?>">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="nik" name="nik" value="<?= $e['nik']; ?>">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="nip" name="nip" value="<?= $e['nip']; ?>">
					</div>
					<div class="form-group">
						<select name="jobtitle_id" id="jobtitle_id" class="form-control">
							<option value="">Select Jobtitle</option>
							<?php foreach ($jobtitle as $j) : ?>
								<option value="<?= $j['id']; ?>" <?= ($j['id'] == $e['jobtitle_id']) ? 'selected' : ''; ?>><?= $j['jobtitle']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="departement_id" id="departement_id" class="form-control">
							<option value="">Select Departement</option>
							<?php foreach ($departement as $d) : ?>
								<option value="<?= $d['id']; ?>" <?= ($d['id'] == $e['departement_id']) ? 'selected' : ''; ?>><?= $d['departement']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $e['address']; ?>">
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" <?= $e['is_active'] == 1 ? 'checked' : ''; ?>>
							<label class="form-check-label" for="is_active">Active?</label>
						</div>
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

