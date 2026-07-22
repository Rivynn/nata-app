<div class="container-fluid">

	<?php

		$participant = $registration->participant;
		$user = $participant?->user;
		$profile = $participant?->profile;

		$training = $registration->training;
		$field = $training?->trainingField;
		$trainer = $training?->trainer?->user;

	?>

	<!-- ==========================================================
	| Header
	=========================================================== -->

	<div class="d-sm-flex justify-content-between align-items-center mb-4">

		<div>

			<h2 class="font-weight-bold text-primary mb-1">

				Detail Verifikasi Peserta

			</h2>

			<p class="text-muted mb-0">

				Tinjau seluruh informasi peserta sebelum memberikan keputusan
				verifikasi.

			</p>

		</div>

		<a
			href="<?= url('/pegawai/verifications') ?>"
			class="btn btn-outline-secondary shadow-sm">

			<i class="fas fa-arrow-left mr-2"></i>

			Kembali

		</a>

	</div>

	<!-- ==========================================================
	| Hero
	=========================================================== -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-2 text-center">

					<?php if($profile?->photo): ?>

						<img
							src="<?= asset($profile->photo) ?>"
							class="rounded-circle shadow"
							width="140"
							height="140"
							style="object-fit:cover;">

					<?php else: ?>

						<div
							class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
							style="
                                width:140px;
                                height:140px;
                                font-size:48px;
                                font-weight:bold;
                            ">

							<?= initials($user?->name ?? 'P') ?>

						</div>

					<?php endif; ?>

				</div>

				<div class="col-lg-7">

					<h3 class="font-weight-bold mb-1">

						<?= e($user?->name ?? '-') ?>

					</h3>

					<p class="text-muted mb-3">

						<?= e($user?->email ?? '-') ?>

					</p>

					<div class="mb-2">

                        <span class="badge badge-warning px-3 py-2">

                            <i class="fas fa-hourglass-half mr-1"></i>

                            Menunggu Verifikasi

                        </span>

					</div>

					<div class="row mt-4">

						<div class="col-md-6 mb-3">

							<small class="text-muted d-block">

								Pelatihan

							</small>

							<strong>

								<?= e($training?->name ?? '-') ?>

							</strong>

						</div>

						<div class="col-md-6 mb-3">

							<small class="text-muted d-block">

								Bidang

							</small>

							<strong>

								<?= e($field?->name ?? '-') ?>

							</strong>

						</div>

						<div class="col-md-6">

							<small class="text-muted d-block">

								Pelatih

							</small>

							<strong>

								<?= e($trainer?->name ?? '-') ?>

							</strong>

						</div>

						<div class="col-md-6">

							<small class="text-muted d-block">

								Tanggal Daftar

							</small>

							<strong>

								<?= $registration->created_at?->format('d F Y H:i') ?? '-' ?>

							</strong>

						</div>

					</div>

				</div>

				<div class="col-lg-3">

					<div class="card bg-light border-0">

						<div class="card-body">

							<h6 class="font-weight-bold mb-4">

								Ringkasan

							</h6>

							<div class="mb-3">

								<small class="text-muted">

									Status Profil

								</small>

								<br>

								<?php if($profile?->isCompleted()): ?>

									<span class="badge badge-success">

                                        Lengkap

                                    </span>

								<?php else: ?>

									<span class="badge badge-danger">

                                        Belum Lengkap

                                    </span>

								<?php endif; ?>

							</div>

							<div class="mb-3">

								<small class="text-muted">

									Dokumen

								</small>

								<br>

								<?php

									$documents = 0;

									if($profile?->photo) $documents++;
									if($profile?->ktp_file) $documents++;


								?>

								<strong>

									<?= $documents ?>

									/ 2

								</strong>

							</div>

							<div>

								<small class="text-muted">

									Status Registrasi

								</small>

								<br>

								<span class="badge badge-warning">

                                    <?= ucfirst($registration->status) ?>

                                </span>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<!-- ==========================================================
		| Informasi Akun
		=========================================================== -->

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-user-circle mr-2"></i>

						Informasi Akun

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>
							<th width="180">Nama Lengkap</th>
							<td><?= e($user?->name ?? '-') ?></td>
						</tr>

						<tr>
							<th>Username</th>
							<td><?= e($user?->username ?? '-') ?></td>
						</tr>

						<tr>
							<th>Email</th>
							<td><?= e($user?->email ?? '-') ?></td>
						</tr>

						<tr>
							<th>Role</th>
							<td>

                            <span class="badge badge-primary">

                                <?= ucfirst($user?->role ?? '-') ?>

                            </span>

							</td>
						</tr>

						<tr>
							<th>Status Akun</th>
							<td>

								<?php if (($user?->status ?? '') === 'active'): ?>

									<span class="badge badge-success">

                                    Aktif

                                </span>

								<?php else: ?>

									<span class="badge badge-danger">

                                    Tidak Aktif

                                </span>

								<?php endif; ?>

							</td>
						</tr>

						<tr>
							<th>Login Terakhir</th>
							<td>

								<?= $user?->last_login_at
									? $user->last_login_at->format('d F Y H:i')
									: '-' ?>

							</td>
						</tr>

					</table>

				</div>

			</div>

		</div>

		<!-- ==========================================================
		| Biodata
		=========================================================== -->

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-id-card mr-2"></i>

						Biodata Peserta

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>
							<th width="180">NIK</th>
							<td><?= e($profile?->nik ?? '-') ?></td>
						</tr>

						<tr>
							<th>Tempat Lahir</th>
							<td><?= e($profile?->birth_place ?? '-') ?></td>
						</tr>

						<tr>
							<th>Tanggal Lahir</th>
							<td>

								<?= $profile?->birth_date
									? $profile->birth_date->format('d F Y')
									: '-' ?>

							</td>
						</tr>

						<tr>
							<th>Agama</th>
							<td><?= e($profile?->religion ?? '-') ?></td>
						</tr>

						<tr>
							<th>Pendidikan</th>
							<td><?= e($profile?->major ?? '-') ?></td>
						</tr>

						<tr>
							<th>Tahun Lulus</th>
							<td><?= e($profile?->graduation_year ?? '-') ?></td>
						</tr>

						<tr>
							<th>Status Pekerjaan</th>
							<td><?= e($profile?->employment_status ?? '-') ?></td>
						</tr>

						<tr>
							<th>Pekerjaan</th>
							<td><?= e($profile?->occupation ?? '-') ?></td>
						</tr>

						<tr>
							<th>Perusahaan</th>
							<td><?= e($profile?->company_name ?? '-') ?></td>
						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>

	<!-- ==========================================================
	| Skill & Tujuan
	=========================================================== -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-lightbulb mr-2"></i>

				Skill & Tujuan Mengikuti Pelatihan

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-md-6">

					<h6 class="font-weight-bold">

						Skill yang Dimiliki

					</h6>

					<p class="text-muted mb-0">

						<?= nl2br(e($profile?->skill ?? '-')) ?>

					</p>

				</div>

				<div class="col-md-6">

					<h6 class="font-weight-bold">

						Tujuan Mengikuti Pelatihan

					</h6>

					<p class="text-muted mb-0">

						<?= nl2br(e($profile?->training_goal ?? '-')) ?>

					</p>

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<!-- ==========================================================
		| Alamat
		=========================================================== -->

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-map-marker-alt mr-2"></i>

						Informasi Alamat

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>
							<th width="180">Provinsi</th>
							<td><?= e($profile?->province ?? '-') ?></td>
						</tr>

						<tr>
							<th>Kota / Kabupaten</th>
							<td><?= e($profile?->city ?? '-') ?></td>
						</tr>

						<tr>
							<th>Kecamatan</th>
							<td><?= e($profile?->district ?? '-') ?></td>
						</tr>

						<tr>
							<th>Kelurahan</th>
							<td><?= e($profile?->village ?? '-') ?></td>
						</tr>

						<tr>
							<th>Kode Pos</th>
							<td><?= e($profile?->postal_code ?? '-') ?></td>
						</tr>

						<tr>
							<th>Alamat Lengkap</th>
							<td>

								<?= nl2br(e($profile?->address ?? '-')) ?>

							</td>
						</tr>

					</table>

				</div>

			</div>

		</div>

		<!-- ==========================================================
		| Kontak Darurat
		=========================================================== -->

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-phone-alt mr-2"></i>

						Kontak Darurat

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="180">

								Nama

							</th>

							<td>

								<?= e($profile?->emergency_contact_name ?? '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Nomor HP

							</th>

							<td>

								<?= e($profile?->emergency_contact_phone ?? '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Relasi

							</th>

							<td>

								<?= e($profile?->emergency_contact_relation ?? '-') ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>

	<!-- ==========================================================
	| Informasi Pelatihan
	=========================================================== -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-graduation-cap mr-2"></i>

				Informasi Pelatihan

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-md-6">

					<table class="table table-borderless table-sm">

						<tr>
							<th width="180">Nama Pelatihan</th>
							<td><?= e($training?->name ?? '-') ?></td>
						</tr>

						<tr>
							<th>Bidang</th>
							<td><?= e($field?->name ?? '-') ?></td>
						</tr>

						<tr>
							<th>Pelatih</th>
							<td><?= e($trainer?->name ?? '-') ?></td>
						</tr>

						<tr>
							<th>Status Registrasi</th>
							<td>

								<?php

									$badge = [
										'pending' => 'warning',
										'approved' => 'success',
										'rejected' => 'danger',
										'completed' => 'primary',
									];

								?>

								<span class="badge badge-<?= $badge[$registration->status] ?? 'secondary' ?>">

                                <?= ucfirst($registration->status) ?>

                            </span>

							</td>
						</tr>

					</table>

				</div>

				<div class="col-md-6">

					<table class="table table-borderless table-sm">

						<tr>
							<th width="180">Tanggal Daftar</th>
							<td>

								<?= $registration->created_at
									? $registration->created_at->format('d F Y H:i')
									: '-' ?>

							</td>
						</tr>

						<tr>
							<th>Terakhir Diubah</th>
							<td>

								<?= $registration->updated_at
									? $registration->updated_at->format('d F Y H:i')
									: '-' ?>

							</td>
						</tr>

						<tr>
							<th>Menunggu Verifikasi</th>
							<td>

								<?php if($registration->created_at): ?>

									<?= $registration->created_at->diffForHumans() ?>

								<?php else: ?>

									-

								<?php endif; ?>

							</td>
						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Dokumen Peserta
=========================================================== -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white d-flex justify-content-between align-items-center">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-folder-open mr-2"></i>

				Dokumen Peserta

			</h6>

			<?php

				$uploaded = collect([
					$profile?->photo,
					$profile?->ktp_file,

				])->filter()->count();

			?>

			<span class="badge badge-info">

            <?= $uploaded ?> / 2 Dokumen

        </span>

		</div>

		<div class="card-body">

			<div class="row">

				<?php

					$documents = [

						[

							'title' => 'Foto Profil',
							'icon'  => 'fas fa-user-circle',
							'file'  => asset($profile?->photo),

						],

						[

							'title' => 'KTP',
							'icon'  => 'fas fa-id-card',
							'file'  => asset($profile?->ktp_file),

						],



					];

				?>

				<?php foreach ($documents as $index => $doc): ?>

					<?php

					$exists = ! empty($doc['file']);

					$ext = strtolower(pathinfo($doc['file'] ?? '', PATHINFO_EXTENSION));

					$image = in_array($ext, [
						'jpg',
						'jpeg',
						'png',
						'gif',
						'webp',
					]);

					?>

					<div class="col-lg-3 col-md-6 mb-4">

						<div class="card border h-100 shadow-sm">

							<div class="card-body text-center">

								<?php if ($exists && $image): ?>

									<img
										src="<?= $doc['file'] ?>"
										class="img-fluid rounded shadow-sm mb-3"
										style="
                                        height:170px;
                                        width:100%;
                                        object-fit:cover;
                                    ">

								<?php else: ?>

									<div
										class="d-flex align-items-center justify-content-center bg-light rounded mb-3"
										style="height:170px;">

										<i
											class="<?= $doc['icon'] ?> fa-4x text-secondary">

										</i>

									</div>

								<?php endif; ?>

								<h6 class="font-weight-bold">

									<?= $doc['title'] ?>

								</h6>

								<?php if ($exists): ?>

									<span class="badge badge-success mb-3">

                                    Sudah Upload

                                </span>

								<?php else: ?>

									<span class="badge badge-danger mb-3">

                                    Belum Upload

                                </span>

								<?php endif; ?>

							</div>

							<div class="card-footer bg-white">

								<?php if ($exists): ?>

									<div class="btn-group btn-block">

										<a
											href="<?= $doc['file'] ?>"
											target="_blank"
											class="btn btn-sm btn-primary">

											<i class="fas fa-eye"></i>

										</a>

										<a
											href="<?= $doc['file'] ?>"
											download
											class="btn btn-sm btn-success">

											<i class="fas fa-download"></i>

										</a>

									</div>

								<?php else: ?>

									<button
										class="btn btn-secondary btn-block btn-sm"
										disabled>

										Tidak Ada File

									</button>

								<?php endif; ?>

							</div>

						</div>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Timeline Registrasi
=========================================================== -->

	<div class="row">

		<div class="col-lg-5">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-history mr-2"></i>

						Timeline Registrasi

					</h6>

				</div>

				<div class="card-body">

					<div class="timeline">

						<div class="mb-4">

							<div class="small text-muted">

								Dibuat

							</div>

							<strong>

								<?= $registration->created_at
									? $registration->created_at->format('d F Y H:i')
									: '-' ?>

							</strong>

						</div>

						<div class="mb-4">

							<div class="small text-muted">

								Terakhir Diubah

							</div>

							<strong>

								<?= $registration->updated_at
									? $registration->updated_at->format('d F Y H:i')
									: '-' ?>

							</strong>

						</div>

						<div>

							<div class="small text-muted">

								Status Saat Ini

							</div>

							<span class="badge badge-warning">

                            <?= ucfirst($registration->status) ?>

                        </span>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-7">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-clipboard-check mr-2"></i>

						Checklist Verifikasi

					</h6>

				</div>

				<div class="card-body">

					<?php

						$checklist = [

							'Data akun tersedia' =>
								!empty($user),

							'Profil peserta tersedia' =>
								!empty($profile),

							'Foto profil tersedia' =>
								!empty($profile?->photo),

							'KTP tersedia' =>
								!empty($profile?->ktp_file),



							'Pelatihan dipilih' =>
								!empty($training),

						];

					?>

					<?php foreach($checklist as $label => $ok): ?>

						<div class="d-flex justify-content-between border-bottom py-2">

                        <span>

                            <?= $label ?>

                        </span>

							<?php if($ok): ?>

								<span class="text-success">

                                <i class="fas fa-check-circle"></i>

                            </span>

							<?php else: ?>

								<span class="text-danger">

                                <i class="fas fa-times-circle"></i>

                            </span>

							<?php endif; ?>

						</div>

					<?php endforeach; ?>

				</div>

			</div>

		</div>

	</div>

	<!-- ==========================================================
	| Approval Form
	=========================================================== -->

	<div class="card shadow mb-5">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-gavel mr-2"></i>

				Keputusan Verifikasi

			</h6>

		</div>

		<div class="card-body">

			<form method="POST">

				<input
					type="hidden"
					name="id"
					value="<?= $registration->id ?>">

				<div class="form-group">

					<label>

						Catatan Pegawai

					</label>

					<textarea
						name="reason"
						rows="5"
						class="form-control"
						placeholder="Masukkan catatan verifikasi..."></textarea>

					<small class="text-muted">

						Catatan ini akan tersimpan sebagai riwayat verifikasi.

					</small>

				</div>

				<div class="alert alert-warning">

					<i class="fas fa-exclamation-triangle mr-2"></i>

					Pastikan seluruh data peserta dan dokumen telah diperiksa
					sebelum menyetujui pendaftaran.

				</div>

				<div class="d-flex justify-content-between">

					<a
						href="<?= url('/pegawai/verifications') ?>"
						class="btn btn-light">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

					<div>

						<button
							formaction="<?= url('/pegawai/verifications/reject') ?>"
							class="btn btn-danger">

							<i class="fas fa-times mr-2"></i>

							Tolak

						</button>

						<button
							formaction="<?= url('/pegawai/verifications/approve') ?>"
							class="btn btn-success">

							<i class="fas fa-check mr-2"></i>

							Setujui

						</button>

					</div>

				</div>

			</form>

		</div>

	</div>
	<!-- ==========================================================
| Progress Verifikasi
=========================================================== -->

	<?php

		$totalCheck = 5;

		$passed = 0;

		foreach ($checklist as $value) {
			if ($value) {
				$passed++;
			}
		}

		$percent = round(($passed / $totalCheck) * 100);

	?>

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-tasks mr-2"></i>

				Progress Verifikasi

			</h6>

		</div>

		<div class="card-body">

			<div class="d-flex justify-content-between mb-2">

				<strong>

					Kelengkapan Data

				</strong>

				<strong>

					<?= $percent ?>%

				</strong>

			</div>

			<div class="progress mb-4" style="height:12px;">

				<div
					class="progress-bar bg-success"
					style="width:<?= $percent ?>%">

				</div>

			</div>

			<div class="row text-center">

				<div class="col">

					<h3 class="font-weight-bold text-success">

						<?= $passed ?>

					</h3>

					<small class="text-muted">

						Lengkap

					</small>

				</div>

				<div class="col">

					<h3 class="font-weight-bold text-danger">

						<?= $totalCheck - $passed ?>

					</h3>

					<small class="text-muted">

						Kurang

					</small>

				</div>

			</div>

		</div>

	</div>
	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				<i class="fas fa-history mr-2"></i>

				Riwayat Verifikasi

			</h6>

		</div>

		<div class="card-body">

			<div class="timeline-small">

				<div class="timeline-item">

					<strong>

						Registrasi Dibuat

					</strong>

					<div class="text-muted">

						<?= $registration->created_at
							? $registration->created_at->format('d F Y H:i')
							: '-' ?>

					</div>

				</div>

				<?php if($registration->updated_at): ?>

					<div class="timeline-item">

						<strong>

							Data Terakhir Diubah

						</strong>

						<div class="text-muted">

							<?= $registration->updated_at->format('d F Y H:i') ?>

						</div>

					</div>

				<?php endif; ?>

				<div class="timeline-item">

					<strong>

						Status Saat Ini

					</strong>

					<div>

                    <span class="badge badge-warning">

                        <?= ucfirst($registration->status) ?>

                    </span>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div
		class="modal fade"
		id="imagePreview"
		tabindex="-1">

		<div class="modal-dialog modal-xl">

			<div class="modal-content">

				<div class="modal-header">

					<h5>

						Preview Dokumen

					</h5>

					<button
						class="close"
						data-dismiss="modal">

						&times;

					</button>

				</div>

				<div class="modal-body text-center">

					<img
						id="previewImage"
						class="img-fluid rounded">

				</div>

			</div>

		</div>

	</div>
	<script>

		document.querySelectorAll('.preview-image').forEach(function(button){

			button.addEventListener('click',function(){

				document
					.getElementById('previewImage')
					.src=this.dataset.image;

				$('#imagePreview').modal('show');

			});

		});

	</script>
