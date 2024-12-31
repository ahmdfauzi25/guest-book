<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-6">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>

	<div class="card mb-3 col-lg-8" style="max-width: 540px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
		<div class="row g-0">
			<div class="col-md-4">
				<img src="<?= base_url('assets/img/profile/') . $user['image'];  ?>" class="card-img" style="border-radius: 15px 0 0 15px;">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h5 class="card-title" style="font-weight: bold; color: #333;"><?= $user['name']; ?></h5>
					<p class="card-text" style="color: #555;"><?= $user['email'];  ?></p>
					<p class="card-text"><small class="text-body-secondary">Member Since <?= date('d F Y', $user['date_created']);  ?></small></p>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
