<div class="container">

	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-10">

			<div class="card o-hidden border-0 shadow-lg my-5">

				<div class="card-body p-0">

					<div class="row">

						<!-- Left -->

						<div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-primary">

							<div class="text-center text-white px-4">

								<img
									src="<?= asset('img/logo-nobg.png') ?>"
									alt="<?= app_name() ?>"
									class="img-fluid mb-4"
									style="max-width:120px;">

								<h3 class="font-weight-bold mb-3">

									<?= app_name() ?>

								</h3>

								<p class="text-white-50 mb-0">

									Daftarkan diri Anda sebagai peserta pelatihan.

								</p>

							</div>

						</div>

						<!-- Right -->

						<div class="col-lg-6">

							<div class="p-5">

								<div class="text-center mb-4">

									<h1 class="h4 text-gray-900">

										Daftar Peserta

									</h1>

									<p class="text-muted">

										Lengkapi data berikut.

									</p>

								</div>

								<?php if(session('error')): ?>

									<div class="alert alert-danger">

										<?= session('error') ?>

									</div>

									<?php unset($_SESSION['error']); ?>

								<?php endif; ?>

								<form
									method="POST"
									action="<?= url('/register') ?>"
									class="user">

									<div class="form-group">

										<input
											type="text"
											name="name"
											class="form-control form-control-user"
											placeholder="Nama Lengkap"
											value="<?= old('name') ?>"
											required>

									</div>

									<div class="form-group">

										<input
											type="email"
											name="email"
											class="form-control form-control-user"
											placeholder="Email"
											value="<?= old('email') ?>"
											required>

									</div>

									<div class="form-group">

										<input
											type="text"
											name="phone"
											class="form-control form-control-user"
											placeholder="Nomor Telepon"
											value="<?= old('phone') ?>"
											required>

									</div>

									<div class="form-group">

										<input
											type="text"
											name="username"
											class="form-control form-control-user"
											placeholder="Username"
											value="<?= old('username') ?>"
											required>

									</div>

									<div class="form-group">

										<div class="input-group">

											<input
												type="password"
												id="password"
												name="password"
												class="form-control"
												placeholder="Password"
												required>

											<div class="input-group-append">

												<button
													class="btn btn-outline-secondary toggle-password"
													type="button"
													data-target="password">

													<i class="fas fa-eye"></i>

												</button>

											</div>

										</div>

									</div>

									<div class="form-group">

										<div class="input-group">

											<input
												type="password"
												id="password_confirmation"
												name="password_confirmation"
												class="form-control"
												placeholder="Konfirmasi Password"
												required>

											<div class="input-group-append">

												<button
													class="btn btn-outline-secondary toggle-password"
													type="button"
													data-target="password_confirmation">

													<i class="fas fa-eye"></i>

												</button>

											</div>

										</div>

									</div>

									<input
										type="hidden"
										name="role"
										value="peserta">

									<button
										class="btn btn-primary btn-user btn-block">

										<i class="fas fa-user-plus mr-2"></i>

										Daftar

									</button>

								</form>

								<div class="text-center mt-4">

									<small class="text-muted">

										Sudah memiliki akun?

									</small>

									<br>

									<a
										href="<?= url('/login') ?>"
										class="font-weight-bold">

										Masuk di sini

									</a>

								</div>

								<hr>

								<div class="text-center">

									<small class="text-muted d-block">

										<?= config('app.description') ?>

									</small>

									<small class="text-muted d-block">

										&copy; <?= date('Y') ?>

										<?= config('app.company') ?>

									</small>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>