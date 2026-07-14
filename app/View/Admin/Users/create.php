<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/users/store') ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Tambah User

						</h4>

						<p class="text-muted mb-0">

							Tambahkan akun pengguna baru ke dalam sistem.

						</p>

					</div>

					<a
						href="<?= url('/admin/users') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

		<div class="row">

			<!-- Informasi User -->

			<div class="col-lg-8">

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi User

						</h6>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Nama Lengkap

							</label>

							<input
								type="text"
								name="name"
								class="form-control"
								placeholder="Masukkan nama lengkap..."
								required>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Username

								</label>

								<input
									type="text"
									name="username"
									class="form-control"
									placeholder="Username"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Email

								</label>

								<input
									type="email"
									name="email"
									class="form-control"
									placeholder="Email"
									required>

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Password

								</label>

								<input
									type="password"
									name="password"
									class="form-control"
									placeholder="Password"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Konfirmasi Password

								</label>

								<input
									type="password"
									name="password_confirmation"
									class="form-control"
									placeholder="Konfirmasi Password"
									required>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- Pengaturan -->

			<div class="col-lg-4">

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Pengaturan

						</h6>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Role

							</label>

							<select
								name="role"
								class="form-control"
								required>

								<option value="">

									-- Pilih Role --

								</option>

								<option value="admin">

									Admin

								</option>

								<option value="pegawai">

									Pegawai

								</option>

								<option value="peserta">

									Peserta

								</option>

							</select>

						</div>

						<div class="form-group">

							<label>

								Status

							</label>

							<select
								name="status"
								class="form-control">

								<option value="active">

									Aktif

								</option>

								<option value="inactive">

									Nonaktif

								</option>

							</select>

						</div>

						<hr>

						<button
							type="submit"
							class="btn btn-primary btn-block">

							<i class="fas fa-save mr-2"></i>

							Simpan User

						</button>

						<a
							href="<?= url('/admin/users') ?>"
							class="btn btn-light btn-block">

							Batal

						</a>

					</div>

				</div>

				<div class="card border-left-info shadow">

					<div class="card-body">

						<h6 class="font-weight-bold text-info">

							Informasi

						</h6>

						<ul class="mb-0 pl-3">

							<li>

								Username harus unik.

							</li>

							<li>

								Email tidak boleh sama.

							</li>

							<li>

								Password minimal 8 karakter.

							</li>

							<li>

								Role menentukan hak akses pengguna.

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>