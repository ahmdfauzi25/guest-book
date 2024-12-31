<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<?php 
	function getRatingText($rating) {
		switch ($rating) {
			case 5: return 'Excellent';
			case 4: return 'Good';
			case 3: return 'Average';
			case 2: return 'Poor';
			case 1: return 'Terrible';
			default: return 'Unknown';
		}
	}
	?>

	<div class="row">
		<div class="col-lg-6">
			<?= form_error('feedback', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newFeedbackModal">Add New Feedback</a> -->

			<table class="table table-hover mt-3">
				<thead>
					<tr>
						<th scope="col">#</th>
						<!-- <th scope="col">Schedule</th> -->
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Rating</th>
						<th scope="col">Comments</th>
						<th scope="col">Submit Date</th>
						<!-- <th scope="col">Status</th> -->
						<!-- <th scope="col">#</th> -->
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;  ?>
					<?php foreach ($feedback as $fb) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<!-- <td><?= date('d-m-Y', strtotime($fb['date_created'])); ?></td> -->
							<td><?= $fb['name']; ?></td>
							<td><?= $fb['email']; ?></td>
							<td>
								<?php if ($fb['rating'] <= 2): ?>
									<span class="badge badge-danger"><?= getRatingText($fb['rating']); ?></span>
								<?php else: ?>
									<span class="badge badge-success"><?= getRatingText($fb['rating']); ?></span>
								<?php endif; ?>
							</td>
							<td><?= $fb['comments']; ?></td>
							<td> <span class="badge badge-success"><?= date('d F Y', ($fb['submit_date'])); ?></span></td>
							<!-- <td><?php if ($fb['status'] == 1) : ?>
									<span class="badge badge-success">Sudah Mengisi</span>
								<?php else : ?>
									<span class="badge badge-danger">Non-aktif</span>
								<?php endif; ?>
							</td> -->
							<!-- <td><?php if ($fb['is_active'] == 1) : ?>
									<span class="badge badge-success">Aktif</span>
								<?php else : ?>
									<span class="badge badge-danger">Non-aktif</span>
								<?php endif; ?></td>
							
							<td><?= date('d F Y', $fb['date_created']); ?></td> -->
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Button trigger modal -->
	<!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#feedbackModal">Beri Feedback</a> -->

	<!-- Modal -->
			
	</div>	<!-- /.container-fluid -->

</div>
