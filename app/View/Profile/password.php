<div class="container-fluid">

	<div class="row justify-content-center">

		<div class="col-lg-7">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Ubah Password

					</h6>

				</div>

				<div class="card-body">

					<?php if(session('success')): ?>

						<div class="alert alert-success">

							<?= session('success') ?>

						</div>

					<?php endif; ?>

					<?php if(session('error')): ?>

						<div class="alert alert-danger">

							<?= session('error') ?>

						</div>

					<?php endif; ?>

					<form
						method="POST"
						action="<?= url('/profile/password') ?>">

						<div class="form-group">

							<label>Password Lama</label>

							<div class="input-group">

								<input
									type="password"
									name="current_password"
									id="current_password"
									class="form-control"
									required>

								<div class="input-group-append">

									<button
										class="btn btn-outline-secondary toggle-password"
										type="button"
										data-target="current_password">

										<i class="fas fa-eye"></i>

									</button>

								</div>

							</div>

						</div>

						<div class="form-group">

							<label>Password Baru</label>

							<div class="input-group">

								<input
									type="password"
									name="password"
									id="password"
									class="form-control"
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

							<label>Konfirmasi Password Baru</label>

							<div class="input-group">

								<input
									type="password"
									name="password_confirmation"
									id="password_confirmation"
									class="form-control"
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

						<hr>

						<div class="text-right">

							<a
								href="<?= url('/profile') ?>"
								class="btn btn-secondary">

								Batal

							</a>

							<button
								class="btn btn-primary">

								<i class="fas fa-save mr-2"></i>

								Simpan Perubahan

							</button>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>