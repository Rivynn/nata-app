<div class="container-fluid">

	<div class="card shadow border-0">

		<div class="card-header py-3">

			<h5 class="m-0 font-weight-bold text-primary">

				Form Pendaftaran Pelatihan

			</h5>

		</div>

		<div class="card-body">

			<form
				method="POST"
				action="<?= url('/peserta/registrations') ?>">

				<input
					type="hidden"
					name="training_id"
					value="<?= $training['id'] ?>">

				<!-- Informasi Peserta -->

				<h6 class="font-weight-bold text-primary mb-3">

					Informasi Peserta

				</h6>

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>Nama Lengkap</label>

							<input
								type="text"
								class="form-control"
								value="<?= user()['name'] ?>"
								readonly>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Email</label>

							<input
								type="email"
								class="form-control"
								value="<?= user()['email'] ?>"
								readonly>

						</div>

					</div>

				</div>

				<div class="form-group">

					<label>Nomor Telepon</label>

					<input
						type="text"
						class="form-control"
						value="<?= $participant['phone'] ?? '-' ?>"
						readonly>

				</div>

				<hr>

				<!-- Informasi Pelatihan -->

				<h6 class="font-weight-bold text-primary mb-3">

					Informasi Pelatihan

				</h6>

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>Bidang</label>

							<input
								type="text"
								class="form-control"
								value="<?= $training['field_name'] ?>"
								readonly>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Nama Pelatihan</label>

							<input
								type="text"
								class="form-control"
								value="<?= $training['name'] ?>"
								readonly>

						</div>

					</div>

				</div>

				<div class="form-group">

					<label>Lokasi</label>

					<input
						type="text"
						class="form-control"
						value="<?= $training['location'] ?>"
						readonly>

				</div>

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>Kuota</label>

							<input
								type="text"
								class="form-control"
								value="<?= $training['quota'] ?> Peserta"
								readonly>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Durasi</label>

							<input
								type="text"
								class="form-control"
								value="<?= $training['duration'] ?> Hari"
								readonly>

						</div>

					</div>

				</div>

				<div class="form-group">

					<label>Deskripsi Pelatihan</label>

					<textarea
						class="form-control"
						rows="4"
						readonly><?= $training['description'] ?></textarea>

				</div>

				<hr>

				<!-- Motivasi -->

				<h6 class="font-weight-bold text-primary mb-3">

					Motivasi Mengikuti Pelatihan

				</h6>

				<div class="form-group">

                    <textarea
	                    name="motivation"
	                    rows="5"
	                    class="form-control"
	                    placeholder="Tuliskan alasan mengapa Anda ingin mengikuti pelatihan ini..."
	                    required></textarea>

				</div>

				<div class="custom-control custom-checkbox mb-4">

					<input
						type="checkbox"
						class="custom-control-input"
						id="agree"
						required>

					<label
						class="custom-control-label"
						for="agree">

						Saya menyatakan seluruh data yang saya kirim adalah benar.

					</label>

				</div>

				<div class="d-flex justify-content-between">

					<a
						href="<?= url('/peserta/registrations') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

					<button
						type="submit"
						class="btn btn-primary">

						<i class="fas fa-paper-plane mr-2"></i>

						Kirim Pendaftaran

					</button>

				</div>

			</form>

		</div>

	</div>

</div>