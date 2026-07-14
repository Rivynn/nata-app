<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/employees/update') ?>">

		<input
			type="hidden"
			name="id"
			value="<?= $employee['id'] ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-warning mb-1">

							Edit Pegawai

						</h4>

						<p class="text-muted mb-0">

							Perbarui informasi pegawai yang terdaftar pada sistem.

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

			<!-- Profile -->

			<div class="col-lg-4">

				<div class="card shadow mb-4">

					<div class="card-body text-center">

						<?php if(!empty($employee['avatar'])): ?>

							<img
								src="<?= avatar($employee) ?>"
								class="rounded-circle shadow mb-3"
								width="130"
								height="130"
								style="object-fit:cover;">

						<?php else: ?>

							<div class="avatar-circle-lg mx-auto mb-3">

								<?= initials($employee['name']) ?>

							</div>

						<?php endif; ?>

						<h5 class="font-weight-bold">

							<?= $employee['name'] ?>

						</h5>

						<p class="text-muted">

							@<?= $employee['username'] ?>

						</p>

						<span class="badge badge-info px-3 py-2">

							<?= $employee['field_name'] ?>

						</span>

					</div>

				</div>

			</div>

			<!-- Form -->

			<div class="col-lg-8">

				<div class="card shadow">

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
								value="<?= $employee['name'] ?>"
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
									value="<?= $employee['username'] ?>"
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
									value="<?= $employee['email'] ?>"
									required>

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Nomor Telepon

								</label>

								<input
									type="text"
									name="phone"
									class="form-control"
									value="<?= $employee['phone'] ?>">

							</div>

							<div class="form-group col-md-6">

								<label>

									Jabatan

								</label>

								<input
									type="text"
									name="position"
									class="form-control"
									value="<?= $employee['position'] ?>">

							</div>

						</div>

						<div class="form-group">

							<label>

								Bidang Pelatihan

							</label>

							<select
								name="training_field_id"
								class="form-control"
								required>

								<?php foreach($fields as $field): ?>

									<option
										value="<?= $field['id'] ?>"
										<?= $field['id'] == $employee['training_field_id'] ? 'selected' : '' ?>>

										<?= $field['name'] ?>

									</option>

								<?php endforeach; ?>

							</select>

						</div>

						<div class="form-group">

							<label>

								Alamat

							</label>

							<textarea
								name="address"
								rows="4"
								class="form-control"><?= $employee['address'] ?></textarea>

						</div>

						<div class="form-group">

							<label>

								Status

							</label>

							<select
								name="status"
								class="form-control">

								<option
									value="active"
									<?= $employee['status'] == 'active' ? 'selected' : '' ?>>

									Aktif

								</option>

								<option
									value="inactive"
									<?= $employee['status'] == 'inactive' ? 'selected' : '' ?>>

									Nonaktif

								</option>

								<option
									value="blocked"
									<?= $employee['status'] == 'blocked' ? 'selected' : '' ?>>

									Diblokir

								</option>

							</select>

						</div>

					</div>

					<div class="card-footer bg-white d-flex justify-content-between">

						<a
							href="<?= url('/admin/employees/show?id='.$employee['id']) ?>"
							class="btn btn-light">

							<i class="fas fa-times mr-2"></i>

							Batal

						</a>

						<button
							type="submit"
							class="btn btn-warning">

							<i class="fas fa-save mr-2"></i>

							Simpan Perubahan

						</button>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>