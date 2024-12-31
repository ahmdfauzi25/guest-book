	<div class="container-fluid" style="font-family: 'Nunito', sans-serif; background-image: url('assets/img/symphony.png'); background-size: repeat; background-position: center; height: 100vh;">

		<!-- Outer Row -->
		<div class="row justify-content-center align-items-center" style="height: 100vh;">

			<div class="col-lg-3">

				<div class="card o-hidden border-0 shadow-lg my-5" style="max-width: 500px;">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
							<div class="col-lg">
								<div class="p-5">
									<div class="text-center">
										<i class="fas fa-book" style="font-size: 3rem; color: #4e73df;"></i>
										<h1 class="h4 text-gray-900 mb-4">Sistem Buku Tamu</h1>
									</div>
									<?= $this->session->flashdata('message'); ?>
									<form class="user" method="post" action="<?= base_url('auth'); ?>">
										<div class="form-group">
											<input type="text" class="form-control form-control-user"
												id="email" name="email" placeholder="Enter Email Address... " value="<?= set_value('email'); ?>">
											<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user"
												id="password" name="password" placeholder="Password">
											<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>

										<button type="submit" class="btn btn-primary btn-user btn-block">
											Login
										</button>

									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="https://www.instagram.com/ahmdfauzi2501/" target="_blank">
											<i class="fab fa-instagram" style="color: #4e73df;"></i> Instagram
										</a>
										<a class="small" href="https://www.linkedin.com/in/ahmad-fauzi-147367129/" target="_blank">
											<i class="fab fa-linkedin" style="color: #4e73df;"></i> Linkedin
										</a>
									</div>

									<div class="text-center">
										<small>Copyright &copy; Ahzi-Dev <?= date('Y'); ?> </small>
										<!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
		<div class="text-right" style="position: absolute; bottom: 20px; right: 20px;">
			<a href="<?= base_url('feedback/create'); ?>" class="btn">
				<img src="<?= base_url('assets/img/rating.png'); ?>" alt="Feedback" style="width: 50px; height: 50px;">
			</a>
		</div>
	</div>
