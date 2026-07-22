<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-2">

						<i class="fas fa-id-card mr-2"></i>

						Biodata Peserta

					</h3>

					<p class="text-muted mb-0">

						Lengkapi biodata Anda sebelum mengikuti pelatihan.

					</p>

				</div>

				<a
					href="<?= dashboard_url() ?>"
					class="btn btn-light border">

					<i class="fas fa-arrow-left mr-2"></i>

					Kembali

				</a>

			</div>

		</div>

	</div>

	<!-- Status -->

	<div class="card shadow border-left-<?= !empty($profile['is_completed']) ? 'success' : 'warning' ?> mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-md-9">

					<h5 class="font-weight-bold text-<?= !empty($profile['is_completed']) ? 'success' : 'warning' ?>">

						<i class="fas <?= !empty($profile['is_completed']) ? 'fa-check-circle' : 'fa-exclamation-circle' ?> mr-2"></i>

						<?= !empty($profile['is_completed'])
							? 'Biodata Sudah Lengkap'
							: 'Biodata Belum Lengkap' ?>

					</h5>

					<p class="text-muted mb-0">

						<?= !empty($profile['is_completed'])

							? 'Seluruh data telah lengkap. Anda dapat mengikuti proses pendaftaran pelatihan.'

							: 'Silakan lengkapi seluruh data berikut agar dapat mendaftar pelatihan.' ?>

					</p>

				</div>

				<div class="col-md-3 text-right">

					<span class="badge badge-<?= !empty($profile['is_completed']) ? 'success' : 'warning' ?> px-3 py-2">

						<?= !empty($profile['is_completed']) ? 'Lengkap' : 'Belum Lengkap' ?>

					</span>

				</div>

			</div>

		</div>

	</div>

	<form
		action="<?= url('/peserta/profile') ?>"
		method="POST"
		enctype="multipart/form-data">

		<!-- Data Akun -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-user-circle mr-2"></i>

					Data Akun

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-4">

						<div class="form-group">

							<label>Nama Lengkap</label>

							<input
								type="text"
								class="form-control"
								value="<?= user()->name ?>"
								readonly>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Username</label>

							<input
								type="text"
								class="form-control"
								value="<?= user()->username ?>"
								readonly>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Email</label>

							<input
								type="email"
								class="form-control"
								value="<?= user()->email ?>"
								readonly>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Identitas -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-address-card mr-2"></i>

					Identitas Peserta

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>NIK <span class="text-danger">*</span></label>

							<input
								type="text"
								name="nik"
								maxlength="16"
								class="form-control"

								minlength="16"
								pattern="[0-9]{16}"
								value="<?= $profile['nik'] ?? '' ?>"
								required>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>No. Handphone</label>

							<input
								type="text"
								name="phone"
								class="form-control"
								value="<?= $participant['phone'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Tempat Lahir</label>

							<input
								type="text"
								name="birth_place"
								class="form-control"
								value="<?= $profile['birth_place'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Tanggal Lahir</label>

							<input
								type="date"
								name="birth_date"
								class="form-control"
								value="<?= !empty($participant['birth_date'])
									? date('Y-m-d', strtotime($participant['birth_date']))
									: ''
								?>">
						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Jenis Kelamin</label>

							<select
								name="gender"
								class="form-control">

								<option value="">Pilih</option>

								<option value="L"
									<?= (($participant['gender'] ?? '') == 'L') ? 'selected' : '' ?>>

									Laki-laki

								</option>

								<option value="P"
									<?= (($participant['gender'] ?? '') == 'P') ? 'selected' : '' ?>>

									Perempuan

								</option>

							</select>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Agama</label>

							<select
								name="religion"
								class="form-control">

								<option value="">Pilih Agama</option>

								<option value="Islam" <?= (($profile['religion'] ?? '') === 'Islam') ? 'selected' : '' ?>>Islam</option>
								<option value="Kristen" <?= (($profile['religion'] ?? '') === 'Kristen') ? 'selected' : '' ?>>Kristen</option>
								<option value="Katolik" <?= (($profile['religion'] ?? '') === 'Katolik') ? 'selected' : '' ?>>Katolik</option>
								<option value="Hindu" <?= (($profile['religion'] ?? '') === 'Hindu') ? 'selected' : '' ?>>Hindu</option>
								<option value="Buddha" <?= (($profile['religion'] ?? '') === 'Buddha') ? 'selected' : '' ?>>Buddha</option>
								<option value="Islam" <?= (($profile['religion'] ?? '') === 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>

							</select>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Status Pernikahan</label>

							<select
								name="marital_status"
								class="form-control">

								<option value="">Pilih</option>

								<option value="belum_menikah" 	<?= (($profile['marital_status'] ?? '') === 'belum_menikah') ? 'selected' : '' ?>>Belum Menikah</option>
								<option value="menikah" 	<?= (($profile['marital_status'] ?? '') === 'menikah') ? 'selected' : '' ?>>Menikah</option>
								<option value="cerai" 	<?= (($profile['marital_status'] ?? '') === 'cerai') ? 'selected' : '' ?>>Cerai</option>

							</select>

						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- Alamat -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-map-marker-alt mr-2"></i>

					Alamat Domisili

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>Provinsi <span class="text-danger">*</span></label>

							<input
								type="text"
								name="province"
								class="form-control"
								value="<?= $profile['province'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Kabupaten / Kota <span class="text-danger">*</span></label>

							<input
								type="text"
								name="city"
								class="form-control"
								value="<?= $profile['city'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Kecamatan</label>

							<input
								type="text"
								name="district"
								class="form-control"
								value="<?= $profile['district'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>Kelurahan / Desa</label>

							<input
								type="text"
								name="village"
								class="form-control"
								value="<?= $profile['village'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Kode Pos</label>

							<input
								type="text"
								name="postal_code"
								class="form-control"
								value="<?= $profile['postal_code'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-8">

						<div class="form-group">

							<label>Alamat Lengkap <span class="text-danger">*</span></label>

							<textarea
								name="address"
								rows="4"
								class="form-control"><?= $participant['address'] ?? '' ?></textarea>

						</div>

					</div>

				</div>

			</div>

		</div>



		<!-- Pendidikan -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-graduation-cap mr-2"></i>

					Data Pendidikan

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-4">

						<div class="form-group">

							<label>Pendidikan Terakhir</label>

							<select
								name="education"
								class="form-control">

								<option value="">Pilih Pendidikan</option>

								<?php

									$educations = [
										'SD',
										'SMP',
										'SMA/SMK',
										'D1',
										'D2',
										'D3',
										'D4',
										'S1',
										'S2',
										'S3',
										'Lainnya'
									];

									foreach ($educations as $education):

										?>

										<option
											value="<?= $education ?>"
											<?= (($participant['education'] ?? '') == $education) ? 'selected' : '' ?>>

											<?= $education ?>

										</option>

									<?php endforeach; ?>

							</select>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Jurusan</label>

							<input
								type="text"
								name="major"
								class="form-control"
								value="<?= $profile['major'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Tahun Lulus</label>

							<input
								type="number"
								min="1970"
								max="<?= date('Y') ?>"
								name="graduation_year"
								step="1"
								class="form-control"
								value="<?= $profile['graduation_year'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-12">

						<div class="form-group">

							<label>Nama Sekolah / Perguruan Tinggi</label>

							<input
								type="text"
								name="institution"
								class="form-control"
								value="<?= $participant['institution'] ?? '' ?>">

						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- Pekerjaan -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-briefcase mr-2"></i>

					Data Pekerjaan

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-4">

						<div class="form-group">

							<label>Status Pekerjaan</label>

							<select
								name="employment_status"
								class="form-control">

								<option value="">Pilih Status</option>

								<?php

									$statuses = [

										'belum_bekerja' => 'Belum Bekerja',

										'bekerja' => 'Bekerja',

										'wirausaha' => 'Wirausaha',

										'pelajar' => 'Pelajar',

										'mahasiswa' => 'Mahasiswa',

										'lainnya' => 'Lainnya'

									];

									foreach ($statuses as $key => $value):

										?>

										<option
											value="<?= $key ?>"
											<?= (($profile['employment_status'] ?? '') == $key) ? 'selected' : '' ?>>

											<?= $value ?>

										</option>

									<?php endforeach; ?>

							</select>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Pekerjaan</label>

							<input
								type="text"
								name="occupation"
								class="form-control"
								value="<?= $profile['occupation'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Nama Instansi / Perusahaan</label>

							<input
								type="text"
								name="company_name"
								class="form-control"
								value="<?= $profile['company_name'] ?? '' ?>">

						</div>

					</div>

				</div>

			</div>

		</div>



		<!-- Informasi Pelatihan -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-lightbulb mr-2"></i>

					Informasi Pelatihan

				</h5>

			</div>

			<div class="card-body">

				<div class="form-group">

					<label>Tujuan Mengikuti Pelatihan</label>

					<textarea
						name="training_goal"
						rows="4"
						class="form-control"><?= $profile['training_goal'] ?? '' ?></textarea>

				</div>

				<div class="form-group">

					<label>Keahlian / Skill yang Dimiliki</label>

					<textarea
						name="skill"
						rows="4"
						class="form-control"><?= $profile['skill'] ?? '' ?></textarea>

				</div>

			</div>

		</div>



		<!-- Kontak Darurat -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-phone-alt mr-2"></i>

					Kontak Darurat

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>Nama Kontak</label>

							<input
								type="text"
								name="emergency_contact_name"
								class="form-control"
								value="<?= $profile['emergency_contact_name'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>No. Handphone</label>

							<input
								type="text"
								name="emergency_contact_phone"
								class="form-control"
								value="<?= $profile['emergency_contact_phone'] ?? '' ?>">

						</div>

					</div>

				</div>

			</div>

		</div>


		<!-- Dokumen Pendukung -->

		<div class="card shadow mb-4">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold text-primary">

					<i class="fas fa-folder-open mr-2"></i>

					Dokumen Pendukung

				</h5>

			</div>

			<div class="card-body">

				<div class="alert alert-light border mb-4">

					<i class="fas fa-info-circle text-primary mr-2"></i>

					Unggah dokumen dengan format yang didukung.
					File yang telah diunggah dapat diganti kapan saja dengan mengunggah file baru.

				</div>

				<div class="row">

					<!-- KTP -->

					<div class="col-lg-4 mb-4">

						<div class="border rounded p-3 h-100">

							<div class="text-center mb-3">

								<div class="mb-2">

									<i class="fas fa-id-card fa-3x text-primary"></i>

								</div>

								<h6 class="font-weight-bold mb-1">

									Foto KTP

								</h6>

								<small class="text-muted">

									JPG, PNG atau PDF • Maks. 2 MB

								</small>

							</div>

							<?php if(!empty($profile['ktp_file'])): ?>

								<div class="alert alert-success py-2 small">

									<i class="fas fa-check-circle mr-1"></i>

									Dokumen telah diunggah

								</div>

								<a
									href="<?= asset( $profile['ktp_file']) ?>"
									target="_blank"
									class="btn btn-outline-success btn-sm btn-block mb-2">

									<i class="fas fa-eye mr-1"></i>

									Lihat Dokumen

								</a>

							<?php endif; ?>

							<input
								type="file"
								name="ktp_file"
								class="form-control-file"
								accept=".jpg,.jpeg,.png,.pdf">

						</div>

					</div>

					<!-- Pas Foto -->

					<div class="col-lg-4 mb-4">

						<div class="border rounded p-3 h-100">

							<div class="text-center mb-3">

								<div class="mb-2">

									<i class="fas fa-user-circle fa-3x text-success"></i>

								</div>

								<h6 class="font-weight-bold mb-1">

									Pas Foto

								</h6>

								<small class="text-muted">

									JPG, PNG, WEBP • Maks. 2 MB

								</small>

							</div>

							<?php if(!empty($profile['photo'])): ?>

								<div class="text-center mb-3">

									<img
										src="<?= asset( $profile['photo']) ?>"
										class="img-thumbnail"
										style="max-height:160px;">

								</div>

							<?php endif; ?>

							<input
								type="file"
								name="photo"
								class="form-control-file"
								accept=".jpg,.jpeg,.png,.webp">

						</div>

					</div>

					<!-- CV -->


				</div>

			</div>

		</div>



		<!-- Submit -->

		<div class="card shadow">

			<div class="card-body text-right">

				<a
					href="<?= dashboard_url() ?>"
					class="btn btn-light border">

					Batal

				</a>

				<button
					type="submit"
					class="btn btn-primary">

					<i class="fas fa-save mr-2"></i>

					Simpan Biodata

				</button>

			</div>

		</div>

	</form>

</div>
