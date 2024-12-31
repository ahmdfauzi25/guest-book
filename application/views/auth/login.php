	<style>
		.container-fluid {
			background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('assets/img/symphony.png');
			/* background-size: contain; */
			background-position: center;
		}
		.card {
			border-radius: 15px;
			overflow: hidden;
		}
		.card-body {
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
		}
		.btn-primary {
			background-color: #4e73df;
			border: none;
			border-radius: 25px;
		}
		.btn-primary:hover {
			background-color: #3e5bbf;
		}
		.text-center h1 {
			color: #4e73df;
			font-weight: bold;
		}
		.logo {
			transition: transform 0.3s, color 0.3s;
		}
		.logo:hover {
			transform: scale(1.1);
			color: #3e5bbf;
			text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
		}
	</style>

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
										<img src="assets/img/book.png" class="logo" style="width: 3rem; height: auto;">
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
