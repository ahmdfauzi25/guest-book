<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg-6">
			<!-- Card untuk menampilkan informasi akun -->
			<div class="card mb-4">
				<div class="card-header">
					<h5 class="m-0 font-weight-bold text-primary">Daftar Akun</h5>
				</div>
				<div class="card-body">
					<?= form_error('admin/account', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newAccountModal">Add New Account</a>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">Active</th>
								<th scope="col">Created Since</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;  ?>
							<?php foreach ($all_users as $u) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $u['name']; ?></td>
									<td><?= $u['email']; ?></td>
									<td><?php if($u['is_active'] == 1) : ?>
											<span class="badge badge-success">Aktif</span>
										<?php else : ?>
											<span class="badge badge-danger">Non-aktif</span>
										<?php endif; ?></td>
									
									<td><?= date('d F Y', $u['date_created']); ?></td>
									<td>
									<a href="<?= base_url('admin/deleteaccount/') . $u['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">Delete</a>
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

<!-- Modal -->
<div class="modal fade" id="newAccountModal" tabindex="-1" role="dialog" aria-labelledby="newAccountModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newAccountModal">Add New Account</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/account'); ?>" method="post">
				<div class="modal-body">
				<div class="form-group">
								<input type="text" class="form-control form-control-user" id="name" name="name"
									placeholder="Full Name" value="<?= set_value('name'); ?>">
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
								<!-- <small class="text-danger-pl-3"></small> -->
							</div>
							<div class="form-group">
								<input type="text" class="form-control form-control-user" id="email" name="email"
									placeholder="Email Address" value="<?= set_value('email'); ?>">
								<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" class="form-control form-control-user"
										id="password1" name="password1" placeholder="Password">
									<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="password" class="form-control form-control-user"
										id="password2" name="password2" placeholder="Repeat Password">
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


