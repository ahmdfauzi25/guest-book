<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<?= form_error('jobtitle', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newJobtitleModal">Add New Jobtitle</a>

			<table class="table table-hover mt-3">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Jobtitle</th>
						<th scope="col">Action</th>
						<!-- <th scope="col">#</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;  ?>
					<?php foreach ($jobtitle as $j) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $j['jobtitle']; ?></td>
							<td>
								<a href="" class="badge badge-success" data-toggle="modal" data-target="#editMenuModal<?= $j['id']; ?>">Edit</a>
								<a href="<?= base_url('jobtitle/delete/') . $j['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">Delete</a>
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
<div class="modal fade" id="newJobtitleModal" tabindex="-1" role="dialog" aria-labelledby="newJobtitleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newJobtitleModal">Add New Jobtitle</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('jobtitle'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="jobtitle" name="jobtitle" placeholder="Jobtitle Name">
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

<!-- Modal Edit jobtitle -->
<?php foreach ($jobtitle as $j) : ?>
<div class="modal fade" id="editMenuModal<?= $j['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel<?= $j['id']; ?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5">Edit Jobtitle</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('jobtitle/edit/') . $j['id']; ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="jobtitle" name="jobtitle" placeholder="jobtitle Name" value="<?= $j['jobtitle']; ?>">
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

