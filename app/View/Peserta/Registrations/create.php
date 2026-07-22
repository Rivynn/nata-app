<div class="container-fluid">

	<!-- ==========================================================
	| Page Header
	=========================================================== -->

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h3 class="font-weight-bold text-primary mb-1">

				Pendaftaran Pelatihan

			</h3>

			<p class="text-muted mb-0">

				Pastikan seluruh data Anda sudah benar sebelum mengirim pendaftaran.

			</p>

		</div>

		<a
			href="<?= url('/peserta/registrations') ?>"
			class="btn btn-outline-secondary">

			<i class="fas fa-arrow-left mr-2"></i>

			Kembali

		</a>

	</div>

	<!-- ==========================================================
	| Flash Message
	=========================================================== -->

	<?php if ($success = flash('success')): ?>

		<div class="alert alert-success alert-dismissible fade show shadow-sm">

			<i class="fas fa-check-circle mr-2"></i>

			<?= $success ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

	<?php if ($error = flash('error')): ?>

		<div class="alert alert-danger alert-dismissible fade show shadow-sm">

			<i class="fas fa-exclamation-circle mr-2"></i>

			<?= $error ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

	<?php if ($errors = flash('errors')): ?>

		<div class="alert alert-danger shadow-sm">

			<div class="font-weight-bold mb-2">

				<i class="fas fa-times-circle mr-2"></i>

				Mohon periksa kembali data berikut.

			</div>

			<ul class="mb-0 pl-3">

				<?php foreach ($errors as $message): ?>

					<li><?= $message ?></li>

				<?php endforeach; ?>

			</ul>

		</div>

	<?php endif; ?>

	<!-- ==========================================================
	| Registration Form
	=========================================================== -->

	<form
		method="POST"
		action="<?= url('/peserta/registrations') ?>">

		<input
			type="hidden"
			name="training_id"
			value="<?= $training->id ?>">

		<div class="row">

			<!-- Left Content -->

			<div class="col-lg-8">
				<!-- ==========================================================
| Informasi Peserta
=========================================================== -->

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<h6 class="m-0 font-weight-bold text-primary">

							<i class="fas fa-user mr-2"></i>

							Informasi Peserta

						</h6>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Nama Lengkap

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($participant->user->name) ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Email

									</label>

									<input
										type="email"
										class="form-control"
										value="<?= e($participant->user->email) ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Nomor Telepon

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($participant->phone ?: '-') ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										NIK

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($profile->nik ?: '-') ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group mb-0">

									<label>

										Jenis Kelamin

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($participant->getGenderLabel()) ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group mb-0">

									<label>

										Alamat

									</label>

									<textarea
										class="form-control"
										rows="3"
										readonly><?= e($profile->getFullAddress()) ?></textarea>

								</div>

							</div>

						</div>

					</div>

				</div>

				<!-- ==========================================================
				| Informasi Pelatihan
				=========================================================== -->

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<h6 class="m-0 font-weight-bold text-primary">

							<i class="fas fa-chalkboard-teacher mr-2"></i>

							Informasi Pelatihan

						</h6>

					</div>

					<div class="card-body">
						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Nama Pelatihan

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($training->name) ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Bidang Pelatihan

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($training->trainingField->name ?? '-') ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Pelatih

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($training->trainer->user->name ?? '-') ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Lokasi

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= e($training->location ?? '-') ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Tanggal Mulai

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= $training->training_start?->format('d M Y') ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Tanggal Selesai

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= $training->training_end?->format('d M Y') ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="form-group mb-0">

							<label>

								Deskripsi Pelatihan

							</label>

							<textarea
								class="form-control"
								rows="4"
								readonly><?= e($training->description ?? '-') ?></textarea>

						</div>

					</div>

				</div>

				<!-- ==========================================================
				| Motivasi Mengikuti Pelatihan
				=========================================================== -->

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<h6 class="m-0 font-weight-bold text-primary">

							<i class="fas fa-edit mr-2"></i>

							Motivasi Mengikuti Pelatihan

						</h6>

					</div>

					<div class="card-body">
						<div class="form-group">

							<label>

								Motivasi Mengikuti Pelatihan
								<span class="text-danger">*</span>

							</label>

							<textarea
								name="motivation"
								rows="6"
								class="form-control"
								placeholder="Jelaskan alasan Anda mengikuti pelatihan ini, manfaat yang ingin diperoleh, atau target yang ingin dicapai..."><?= old('motivation') ?></textarea>

							<small class="text-muted">

								Minimal jelaskan tujuan dan manfaat yang ingin Anda peroleh dari pelatihan ini.

							</small>

						</div>

						<div class="custom-control custom-checkbox">

							<input
								type="checkbox"
								class="custom-control-input"
								id="agreement"
								name="agreement"
								value="1">

							<label
								class="custom-control-label"
								for="agreement">

								Saya menyatakan bahwa data yang saya berikan adalah benar dan bersedia mengikuti seluruh rangkaian pelatihan sesuai ketentuan yang berlaku.

							</label>

						</div>

					</div>

					<div class="card-footer bg-white text-right">

						<a
							href="<?= url('/peserta/registrations') ?>"
							class="btn btn-light">

							Batal

						</a>

						<button
							type="submit"
							class="btn btn-primary">

							<i class="fas fa-paper-plane mr-2"></i>

							Kirim Pendaftaran

						</button>

					</div>

				</div>

			</div>

			<!-- Right Content -->

			<div class="col-lg-4">
				<!-- ==========================================================
				| Ringkasan Pelatihan
				=========================================================== -->

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<h6 class="m-0 font-weight-bold text-primary">

							<i class="fas fa-info-circle mr-2"></i>

							Ringkasan Pelatihan

						</h6>

					</div>

					<div class="card-body">

						<table class="table table-borderless table-sm mb-0">

							<tr>

								<th width="40%">

									Pelatihan

								</th>

								<td>

									<?= e($training->name) ?>

								</td>

							</tr>

							<tr>

								<th>

									Bidang

								</th>

								<td>

									<?= e($training->trainingField->name ?? '-') ?>

								</td>

							</tr>

							<tr>

								<th>

									Pelatih

								</th>

								<td>

									<?= e($training->trainer->user->name ?? '-') ?>

								</td>

							</tr>

							<tr>

								<th>

									Jadwal

								</th>

								<td>

									<?=$training->training_start?->format('d M Y') ?>

									<br>

									<small class="text-muted">

										s/d <?= $training->training_end?->format('d M Y') ?>

									</small>

								</td>

							</tr>

							<tr>

								<th>

									Lokasi

								</th>

								<td>

									<?= e($training->location ?? '-') ?>

								</td>

							</tr>

						</table>

					</div>

				</div>

				<!-- ==========================================================
				| Informasi Penting
				=========================================================== -->

				<div class="card border-left-info shadow">

					<div class="card-body">

						<h6 class="font-weight-bold text-info">

							<i class="fas fa-bullhorn mr-2"></i>

							Informasi Penting

						</h6>

						<ul class="mb-0 pl-3">

							<li>

								Pastikan seluruh data profil Anda sudah benar.

							</li>

							<li>

								Pendaftaran akan diverifikasi oleh petugas.

							</li>

							<li>

								Anda akan menerima informasi status pendaftaran setelah proses verifikasi selesai.

							</li>

							<li>

								Peserta yang telah diterima diharapkan mengikuti seluruh rangkaian pelatihan.

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>
