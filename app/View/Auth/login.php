<div class="container">

	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-lg my-5">

				<div class="card-body p-0">

					<div class="row">

						<div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-primary">

							<div class="text-center text-white px-4">

								<img
									src="<?= asset('img/logo-nobg.png') ?>"
									alt="<?= config('app.name') ?>"
									class="img-fluid mb-4"
									style="max-width:120px;">

								<h3 class="font-weight-bold mb-3">
									<?= config('app.name') ?>
								</h3>

								<p class="mb-0 text-white-50">
									<?= config('app.company') ?>
								</p>

							</div>

						</div>

						<div class="col-lg-6">

							<div class="p-5">

								<div class="text-center mb-4">

									<h1 class="h4 text-gray-900 mb-2">
										Selamat Datang
									</h1>

									<p class="text-muted">
										Silakan login untuk melanjutkan.
									</p>

								</div>
                                <?php if (isset($_SESSION['success'])): ?>

                                    <div class="alert alert-success">

                                        <?= $_SESSION['success']; ?>

                                    </div>

                                    <?php unset($_SESSION['success']); ?>

                                <?php endif; ?>

								<?php if(isset($_SESSION['error'])): ?>

									<div class="alert alert-danger">

										<?= $_SESSION['error']; ?>

									</div>

									<?php unset($_SESSION['error']); ?>

								<?php endif; ?>

								<form
									method="POST"
									action="<?= url('/login') ?>"
									class="user">

									<div class="form-group">

                                        <input
                                                type="text"
                                                name="login"
                                                class="form-control form-control-user"
                                                placeholder="Username atau Email"
                                                value="<?= old('login') ?>"
                                                required
                                                autofocus>

									</div>

									<div class="form-group">

										<input
											type="password"
											name="password"
											class="form-control form-control-user"
											placeholder="Password"
											required>

									</div>

									<button
										type="submit"
										class="btn btn-primary btn-user btn-block shadow-sm">

										<i class="fas fa-sign-in-alt mr-2"></i>

										Masuk

									</button>

								</form>

								<div class="text-center my-4">

									<small class="text-muted">
										Belum memiliki akun?
									</small>

									<br>

									<a
										href="<?= url('/register') ?>"
										class="font-weight-bold">

										Daftar sebagai Peserta

									</a>

								</div>

								<div class="text-center">


									<small class="text-muted d-block mt-1">

										<?= config('app.description') ?>

									</small>

									<small class="text-muted d-block mt-1">

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