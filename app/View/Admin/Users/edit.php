<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/users/update') ?>">

		<input
			type="hidden"
			name="id"
			value="<?= $user['id'] ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Edit User

						</h4>

						<p class="text-muted mb-0">

							Perbarui informasi akun pengguna.

						</p>

					</div>

					<a
						href="<?= url('/admin/users/show?id='.$user['id']) ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

		<div class="row">

			<!-- Sidebar -->

			<div class="col-lg-4">

				<div class="card shadow mb-4">

					<div class="card-body text-center">

						<?php if(!empty($user['avatar'])): ?>

							<img
								src="<?= avatar($user) ?>"
								class="rounded-circle shadow mb-3"
								width="140"
								height="140"
								style="object-fit:cover;">

						<?php else: ?>

							<div
								class="avatar-circle-lg mx-auto mb-3">

								<?= initials($user['name']) ?>

							</div>

						<?php endif; ?>

						<h5 class="font-weight-bold">

							<?= $user['name'] ?>

						</h5>

						<p class="text-muted">

							@<?= $user['username'] ?>

						</p>

						<?php if($user['role']=='admin'): ?>

							<span class="badge badge-danger px-3 py-2">

                                Admin

                            </span>

						<?php elseif($user['role']=='pegawai'): ?>

							<span class="badge badge-info px-3 py-2">

                                Pegawai

                            </span>

						<?php else: ?>

							<span class="badge badge-success px-3 py-2">

                                Peserta

                            </span>

						<?php endif; ?>

					</div>

				</div>

				<div class="card border-left-info shadow">

					<div class="card-body">

						<h6 class="font-weight-bold text-info">

							Informasi

						</h6>

						<ul class="mb-0 pl-3">

							<li>Username harus unik.</li>

							<li>Email harus unik.</li>

							<li>Role menentukan hak akses.</li>

							<li>Password tidak diubah dari halaman ini.</li>

						</ul>

					</div>

				</div>

			</div>

			<!-- Form -->

			<div class="col-lg-8">

				<div class="card shadow">

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
								value="<?= $user['name'] ?>"
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
									value="<?= $user['username'] ?>"
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
									value="<?= $user['email'] ?>"
									required>

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Role

								</label>

								<select
									name="role"
									class="form-control"
									required>

									<option
										value="admin"
										<?= $user['role']=='admin' ? 'selected' : '' ?>>

										Admin

									</option>

									<option
										value="pegawai"
										<?= $user['role']=='pegawai' ? 'selected' : '' ?>>

										Pegawai

									</option>

									<option
										value="peserta"
										<?= $user['role']=='peserta' ? 'selected' : '' ?>>

										Peserta

									</option>

								</select>

							</div>

							<div class="form-group col-md-6">

								<label>

									Status

								</label>

								<select
									name="status"
									class="form-control">

									<option
										value="active"
										<?= (($user['status'] ?? 'active')=='active') ? 'selected' : '' ?>>

										Aktif

									</option>

									<option
										value="inactive"
										<?= (($user['status'] ?? '')=='inactive') ? 'selected' : '' ?>>

										Nonaktif

									</option>

								</select>

							</div>

						</div>

					</div>

					<div class="card-footer bg-white d-flex justify-content-between">

						<a
							href="<?= url('/admin/users') ?>"
							class="btn btn-light">

							Batal

						</a>

						<div>

							<a
								href="<?= url('/admin/users/show?id='.$user['id']) ?>"
								class="btn btn-info">

								<i class="fas fa-eye mr-2"></i>

								Detail

							</a>

							<button
								type="submit"
								class="btn btn-primary">

								<i class="fas fa-save mr-2"></i>

								Simpan Perubahan

							</button>

						</div>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>