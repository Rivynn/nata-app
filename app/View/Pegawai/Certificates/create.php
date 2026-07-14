<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-success mb-1">

						Terbitkan Sertifikat

					</h4>

					<p class="text-muted mb-0">

						Pastikan seluruh data peserta telah benar sebelum menerbitkan sertifikat.

					</p>

				</div>

				<i class="fas fa-award fa-3x text-warning"></i>

			</div>

		</div>

	</div>

	<form
		method="POST"
		action="<?= url('/pegawai/certificates/store') ?>">

		<input
			type="hidden"
			name="registration_id"
			value="<?= $participant['registration_id'] ?>">

		<div class="row">

			<div class="col-lg-4">

				<div class="card shadow">

					<div class="card-body text-center">

						<?php if (has_avatar($participant)): ?>

							<img
								src="<?= avatar($participant) ?>"
								class="rounded-circle shadow mb-3"
								width="140"
								height="140"
								style="object-fit:cover;">

						<?php else: ?>

							<div class="avatar-circle-lg mx-auto mb-3">

								<?= initials($participant['name']) ?>

							</div>

						<?php endif; ?>

						<h5 class="font-weight-bold mb-1">

							<?= $participant['name'] ?>

						</h5>

						<p class="text-muted">

							<?= $participant['email'] ?>

						</p>

						<span class="badge badge-success px-3 py-2">

                            <i class="fas fa-check-circle mr-1"></i>

                            Peserta Disetujui

                        </span>

					</div>

				</div>

			</div>

			<div class="col-lg-8">

				<div class="card shadow">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi Sertifikat

						</h6>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Nomor Sertifikat

							</label>

							<input
								type="text"
								name="certificate_number"
								class="form-control"
								value="CERT-<?= date('Y') ?>-<?= str_pad($participant['registration_id'],5,'0',STR_PAD_LEFT) ?>"
								required>

							<small class="text-muted">

								Nomor sertifikat dapat diubah apabila diperlukan.

							</small>

						</div>

						<div class="form-group">

							<label>

								Kode Verifikasi

							</label>

							<input
								type="text"
								class="form-control"
								value="Otomatis dibuat oleh sistem"
								readonly>

						</div>

						<div class="form-group">

							<label>

								Tanggal Terbit

							</label>

							<input
								type="date"
								name="issued_at"
								class="form-control"
								value="<?= date('Y-m-d') ?>"
								required>

						</div>

						<hr>

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Nama Peserta

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= $participant['name'] ?>"
										readonly>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label>

										Email

									</label>

									<input
										type="text"
										class="form-control"
										value="<?= $participant['email'] ?>"
										readonly>

								</div>

							</div>

						</div>

						<div class="form-group">

							<label>

								Pelatihan

							</label>

							<input
								type="text"
								class="form-control"
								value="<?= $participant['training_name'] ?>"
								readonly>

						</div>

						<div class="form-group">

							<label>

								Bidang Pelatihan

							</label>

							<input
								type="text"
								class="form-control"
								value="<?= $participant['field_name'] ?>"
								readonly>

						</div>

					</div>

					<div class="card-footer bg-white">

						<div class="d-flex justify-content-between">

							<a
								href="<?= url('/pegawai/participants/show?id='.$participant['registration_id']) ?>"
								class="btn btn-secondary">

								<i class="fas fa-arrow-left mr-2"></i>

								Kembali

							</a>

							<button
								type="submit"
								class="btn btn-success">

								<i class="fas fa-award mr-2"></i>

								Terbitkan Sertifikat

							</button>

						</div>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>