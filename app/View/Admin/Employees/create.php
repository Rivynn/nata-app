<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/employees/store') ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Tambah Pegawai

						</h4>

						<p class="text-muted mb-0">

							Tambahkan akun pegawai baru ke dalam sistem.

						</p>

					</div>

					<a
						href="<?= url('/admin/employees') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

		<div class="row">

			<!-- Form -->

			<div class="col-lg-8">

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi Pegawai

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

			<!-- Sidebar -->

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

							<input
								type="text"
								class="form-control"
								value="Pegawai"
								readonly>

							<input
								type="hidden"
								name="role"
								value="pegawai">

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

							Simpan Pegawai

						</button>

						<a
							href="<?= url('/admin/employees') ?>"
							class="btn btn-light btn-block">

							Batal

						</a>

					</div>

				</div>

				<div class="card border-left-success shadow">

					<div class="card-body">

						<div class="text-center mb-3">

							<i class="fas fa-user-tie fa-4x text-success"></i>

						</div>

						<h6 class="font-weight-bold text-success">

							Informasi

						</h6>

						<ul class="pl-3 mb-0">

							<li>

								Username harus unik.

							</li>

							<li>

								Email tidak boleh sama.

							</li>

							<li>

								Role akan otomatis menjadi <strong>Pegawai</strong>.

							</li>

							<li>

								Password minimal 8 karakter.

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>