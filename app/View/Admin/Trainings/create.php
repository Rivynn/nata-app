<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/trainings/store') ?>">

		<!-- Header -->

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Tambah Pelatihan

						</h4>

						<p class="text-muted mb-0">

							Tambahkan program pelatihan baru yang akan dibuka untuk peserta.

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
								class="fas fa-book-open text-primary"
								style="font-size:48px;"></i>

						</div>

						<h4
							id="previewName"
							class="font-weight-bold">

							Nama Pelatihan

						</h4>

						<p
							id="previewField"
							class="text-muted">

							Jenis Pelatihan

						</p>

						<hr>

						<div class="row text-center">

							<div class="col-6">

								<small class="text-muted">

									Kuota

								</small>

								<h5
									id="previewQuota"
									class="font-weight-bold">

									0

								</h5>

							</div>

							<div class="col-6">

								<small class="text-muted">

									Durasi

								</small>

								<h5
									id="previewDuration"
									class="font-weight-bold">

									0 Hari

								</h5>

							</div>

						</div>

						<hr>

						<p
							id="previewLocation"
							class="mb-2 text-secondary">

							Lokasi

						</p>

						<span
							id="previewStatus"
							class="badge badge-success px-3 py-2">

							Dibuka

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

								<option value="">

									- Pilih Bidang -

								</option>

								<?php foreach($fields as $field): ?>

									<option
										value="<?= $field['id'] ?>"
										data-icon="<?= $field['icon'] ?>"
										data-color="<?= $field['color'] ?>">

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
								required></textarea>

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
									min="1"
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
									min="1"
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

								<option value="open">

									Dibuka

								</option>

								<option value="closed">

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
							class="btn btn-primary">

							<i class="fas fa-save mr-2"></i>

							Simpan Pelatihan

						</button>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>

<script>


</script>
