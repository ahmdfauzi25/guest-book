<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-lg">
			<!-- Card Container -->
			<div class="card mb-4">
				<div class="card-header">
					<h5 class="m-0 font-weight-bold text-primary">Sub Menu List</h5>
				</div>
				<div class="card-body">
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger" role="alert">
							<?= validation_errors(); ?>
						</div>
						<?= $this->session->flashdata('message'); ?>
					<?php endif; ?>
					<a href="" class="btn btn-primary" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub-Menu</a>

					<!-- Tambahkan kode untuk pagination -->
					<?php
					$limit = 10; // Jumlah entri per halaman
					$total = count($subMenu); // Total entri
					$totalPages = ceil($total / $limit); // Total halaman
					$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
					$offset = ($currentPage - 1) * $limit; // Offset untuk query
					$subMenu = array_slice($subMenu, $offset, $limit); // Ambil entri untuk halaman saat ini
					?>

					<table class="table table-hover mt-3">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Title</th>
								<th scope="col">Menu</th>
								<th scope="col">url</th>
								<th scope="col">icon</th>
								<th scope="col">Active</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = $offset + 1;  // Mulai dari offset ?>
							<?php foreach ($subMenu as $sm) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $sm['title']; ?></td>
									<td><?= $sm['menu']; ?></td>
									<td><?= $sm['url']; ?></td>
									<td><?= $sm['icon']; ?></td>
									<td>
										<?php if($sm['is_active'] == 1) : ?>
											<span class="badge badge-success">Aktif</span>
										<?php else : ?>
											<span class="badge badge-danger">Non-aktif</span>
										<?php endif; ?>
									</td>
									<td>
										<a href="<?=base_url('menu/submenudelete/') . $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus submenu ini?');">Delete</a>
									</td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>

					<div class="mt-2">
						Total Entri: <?= $total; ?>
					</div>
					<!-- Kode untuk menampilkan pagination -->
					<nav aria-label="Page navigation" class="d-flex justify-content-center">
						<ul class="pagination">
							
							<!-- Tombol Previous -->
							<li class="page-item <?= ($currentPage == 1) ? 'disabled' : ''; ?>">
								<a class="page-link" href="?page=<?= $currentPage-1; ?>" <?= ($currentPage == 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>Previous</a>
							</li>

							<?php for ($page = 1; $page <= $totalPages; $page++) : ?>
								<li class="page-item <?= ($page == $currentPage) ? 'active' : ''; ?>">
									<a class="page-link" href="?page=<?= $page; ?>"><?= $page; ?></a>
								</li>
							<?php endfor; ?>

							<!-- Tombol Next -->
							<li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
								<a class="page-link" href="?page=<?= $currentPage+1; ?>" <?= ($currentPage == $totalPages) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>Next</a>
							</li>
						</ul>
					</nav>
					<!-- Informasi total entri dengan class text-center -->
					
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="newSubMenuModal">Add New Sub Menu</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/submenu'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="title" name="title" placeholder="SubMenu Title">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<select name="menu_id" id="menu_id" class="form-control">
							<option value="">Select Menu</option>
							<?php foreach ($menu as $m) : ?>
								<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="url" name="url" placeholder="SubMenu url">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
						<input type="text" class="form-control" id="icon" name="icon" placeholder="SubMenu icon">
					</div>
					<div class="form-group">
						<!-- <label for="formGroupInput"></label> -->
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

