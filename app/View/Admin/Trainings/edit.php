<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/trainings/update') ?>">

		<input
			type="hidden"
			name="id"
			value="<?= $training['id'] ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Edit Pelatihan

						</h4>

						<p class="text-muted mb-0">

							Perbarui informasi pelatihan.

						</p>

					</div>

					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

		<div class="row">

			<!-- Preview -->

			<div class="col-lg-4">

				<div class="card shadow">

					<div class="card-body text-center">

						<div
							class="rounded-circle bg-light shadow mx-auto mb-4 d-flex align-items-center justify-content-center"
							style="width:120px;height:120px;">

							<i
								id="previewIcon"
								class="<?= $training['icon'] ?> text-<?= $training['color'] ?>"
								style="font-size:48px;"></i>

						</div>

						<h4
							id="previewName"
							class="font-weight-bold">

							<?= $training['name'] ?>

						</h4>

						<p
							id="previewField"
							class="text-muted">

							<?= $training['field_name'] ?>

						</p>

						<hr>

						<div class="row">

							<div class="col-6">

								<small class="text-muted">

									Kuota

								</small>

								<h5
									id="previewQuota"
									class="font-weight-bold">

									<?= $training['quota'] ?>

								</h5>

							</div>

							<div class="col-6">

								<small class="text-muted">

									Durasi

								</small>

								<h5
									id="previewDuration"
									class="font-weight-bold">

									<?= $training['duration'] ?> Hari

								</h5>

							</div>

						</div>

						<hr>

						<p
							id="previewLocation"
							class="mb-2 text-secondary">

							<?= $training['location'] ?>

						</p>

						<span
							id="previewStatus"
							class="badge badge-<?= $training['status'] == 'open' ? 'success' : 'danger' ?> px-3 py-2">

							<?= $training['status'] == 'open'
								? 'Dibuka'
								: 'Ditutup' ?>

						</span>

					</div>

				</div>

			</div>

			<!-- Form -->

			<div class="col-lg-8">

				<div class="card shadow">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi Pelatihan

						</h6>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Jenis Pelatihan

							</label>

							<select
								name="training_field_id"
								id="trainingField"
								class="form-control"
								required>

								<?php foreach($fields as $field): ?>

									<option
										value="<?= $field['id'] ?>"
										data-icon="<?= $field['icon'] ?>"
										data-color="<?= $field['color'] ?>"
										<?= $field['id'] == $training['training_field_id'] ? 'selected' : '' ?>>

										<?= $field['name'] ?>

									</option>

								<?php endforeach; ?>

							</select>

						</div>

						<div class="form-group">

							<label>

								Nama Pelatihan

							</label>

							<input
								type="text"
								id="name"
								name="name"
								class="form-control"
								value="<?= $training['name'] ?>"
								required>

						</div>

						<div class="form-group">

							<label>

								Deskripsi

							</label>

							<textarea
								name="description"
								class="form-control"
								rows="4"
								required><?= $training['description'] ?></textarea>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Kuota

								</label>

								<input
									type="number"
									id="quota"
									name="quota"
									class="form-control"
									value="<?= $training['quota'] ?>"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Durasi (Hari)

								</label>

								<input
									type="number"
									id="duration"
									name="duration"
									class="form-control"
									value="<?= $training['duration'] ?>"
									required>

							</div>

						</div>
						<div class="form-group">

							<label>

								Lokasi

							</label>

							<input
								type="text"
								id="location"
								name="location"
								class="form-control"
								value="<?= $training['location'] ?>"
								required>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Pendaftaran Dibuka

								</label>

								<input
									type="date"
									name="registration_open"
									class="form-control"
									value="<?= $training['registration_open'] ?>"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Pendaftaran Ditutup

								</label>

								<input
									type="date"
									name="registration_close"
									class="form-control"
									value="<?= $training['registration_close'] ?>"
									required>

							</div>

						</div>

						<div class="form-group">

							<label>

								Status

							</label>

							<select
								id="status"
								name="status"
								class="form-control">

								<option
									value="open"
									<?= $training['status'] == 'open'
										? 'selected'
										: '' ?>>

									Dibuka

								</option>

								<option
									value="closed"
									<?= $training['status'] == 'closed'
										? 'selected'
										: '' ?>>

									Ditutup

								</option>

							</select>

						</div>

					</div>

					<div class="card-footer bg-white d-flex justify-content-between">

						<a
							href="<?= url('/admin/trainings') ?>"
							class="btn btn-light">

							<i class="fas fa-times mr-2"></i>

							Batal

						</a>

						<button
							type="submit"
							class="btn btn-warning">

							<i class="fas fa-save mr-2"></i>

							Update Pelatihan

						</button>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>

