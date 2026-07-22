<?php

	$hasRegistration = !empty($registrations);

	$hasTraining = false;

	foreach ($registrations as $registration) {

		if (
			in_array(
				$registration['status'],
				[
					'approved',
					'completed'
				]
			)
		) {
			$hasTraining = true;
			break;
		}

	}

	$hasCertificate = !empty($certificates);

?>

<div class="container-fluid">

	<!-- Welcome -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<h3 class="font-weight-bold text-primary">

				Halo, <?= explode(' ', user()->name)[0] ?> 👋

			</h3>

			<p class="text-muted mb-4">

				Selamat datang di
				<strong><?= app_name() ?></strong>.
				Lengkapi profil Anda terlebih dahulu, kemudian pilih pelatihan sesuai minat dan pantau proses pendaftaran hingga memperoleh sertifikat.

			</p>

			<?php if($profileCompleted): ?>

				<a
					href="<?= url('/peserta/registrations') ?>"
					class="btn btn-primary mr-2">

					<i class="fas fa-plus-circle mr-2"></i>

					Daftar Pelatihan

				</a>

			<?php else: ?>

				<a
					href="<?= url('peserta/profile') ?>"
					class="btn btn-warning mr-2">

					<i class="fas fa-user-edit mr-2"></i>

					Lengkapi Profil

				</a>

			<?php endif; ?>

			<a
				href="<?= url('/peserta/status') ?>"
				class="btn btn-outline-primary">

				<i class="fas fa-info-circle mr-2"></i>

				Lihat Status

			</a>

		</div>

	</div>

	<!-- Status Profil -->

	<div class="card <?= $profileCompleted ? 'border-left-success' : 'border-left-warning' ?> shadow mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-9">

					<div class="d-flex">

						<div class="mr-4">

							<div
								class="rounded-circle bg-<?= $profileCompleted ? 'success' : 'warning' ?> text-white d-flex align-items-center justify-content-center"
								style="width:70px;height:70px;">

								<i class="fas <?= $profileCompleted ? 'fa-check-circle' : 'fa-user-edit' ?> fa-2x"></i>

							</div>

						</div>

						<div>

							<h5 class="font-weight-bold text-<?= $profileCompleted ? 'success' : 'warning' ?> mb-2">

								<?= $profileCompleted ? 'Profil Anda Sudah Lengkap' : 'Lengkapi Profil Anda' ?>

							</h5>

							<p class="text-muted mb-2">

								<?php if ($profileCompleted): ?>

									Data profil Anda telah lengkap dan siap digunakan untuk mengikuti seluruh proses pelatihan.

								<?php else: ?>

									Sebelum mengikuti pelatihan, Anda wajib melengkapi data diri seperti NIK, alamat, pendidikan terakhir, pekerjaan, dan informasi lainnya.

								<?php endif; ?>

							</p>

							<span class="badge badge-<?= $profileCompleted ? 'success' : 'warning' ?> px-3 py-2">

							<i class="fas <?= $profileCompleted ? 'fa-check-circle' : 'fa-exclamation-circle' ?> mr-1"></i>

							<?= $profileCompleted ? 'Profil Lengkap' : 'Profil Belum Lengkap' ?>

						</span>

						</div>

					</div>

				</div>

				<div class="col-lg-3 text-lg-right mt-3 mt-lg-0">
					<a
						href="<?= url('/peserta/profile') ?>"
						class="btn btn-<?= $profileCompleted ? 'success' : 'warning' ?> btn-lg">

						<i class="fas <?= $profileCompleted ? 'fa-id-card' : 'fa-user-edit' ?> mr-2"></i>

						<?= $profileCompleted ? 'Lihat Biodata' : 'Lengkapi Biodata' ?>

					</a>
				</div>

			</div>

		</div>

	</div>

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				Kategori Pelatihan

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<?php foreach ($fields->take(3) as $field): ?>

					<div class="col-lg-4 mb-4">

						<div class="card h-100 border-0 shadow-sm">

							<div class="card-body text-center">

								<div
									class="rounded-circle bg-<?= htmlspecialchars($field['color'] ?: 'primary') ?> text-white d-inline-flex align-items-center justify-content-center mb-3"
									style="width:75px;height:75px;">

									<i class="<?= htmlspecialchars($field['icon'] ?: 'fas fa-book-open') ?> fa-2x"></i>

								</div>

								<h5 class="font-weight-bold">

									<?= htmlspecialchars($field['name']) ?>

								</h5>

								<p class="text-muted mb-4">

									<?= htmlspecialchars(
										$field['description']
											?: 'Lihat seluruh pelatihan pada kategori ini.'
									) ?>

								</p>

								<a
									href="<?= url('/peserta/registrations?field=' . $field['id']) ?>"
									class="btn btn-<?= htmlspecialchars($field['color'] ?: 'primary') ?>">

									<i class="fas fa-arrow-right mr-2"></i>

									Lihat Pelatihan

								</a>

							</div>

						</div>

					</div>

				<?php endforeach; ?>

			</div>
		</div>

	</div>

	<!-- Progress -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				Progress Peserta

			</h6>

		</div>

		<div class="card-body">

			<div class="row text-center">

				<div class="col">

					<div class="text-success mb-2">

						<i class="fas fa-check-circle fa-2x"></i>

					</div>

					<strong>Akun</strong>

					<br>

					<small class="text-success">

						Selesai

					</small>

				</div>
				<div class="col">

					<div class="<?= $profileCompleted ? 'text-success' : 'text-warning' ?> mb-2">

						<i class="fas <?= $profileCompleted ? 'fa-check-circle' : 'fa-user-edit' ?> fa-2x"></i>

					</div>

					<strong>Profil</strong>

					<br>

					<small class="<?= $profileCompleted ? 'text-success' : 'text-warning' ?>">

						<?= $profileCompleted ? 'Selesai' : 'Belum Lengkap' ?>

					</small>

				</div>

				<div class="col">

					<div class="<?= $hasRegistration ? 'text-success' : 'text-muted' ?> mb-2">

						<i class="fas <?= $hasRegistration ? 'fa-check-circle' : 'fa-clipboard-list' ?> fa-2x"></i>

					</div>

					<strong>Pendaftaran</strong>

					<br>

					<small class="<?= $hasRegistration ? 'text-success' : 'text-muted' ?>">

						<?= $hasRegistration ? 'Sudah Mendaftar' : 'Belum' ?>

					</small>

				</div>
				<div class="col">

					<div class="<?= $hasTraining ? 'text-success' : 'text-muted' ?> mb-2">

						<i class="fas <?= $hasTraining ? 'fa-check-circle' : 'fa-graduation-cap' ?> fa-2x"></i>

					</div>

					<strong>Pelatihan</strong>

					<br>

					<small class="<?= $hasTraining ? 'text-success' : 'text-muted' ?>">

						<?= $hasTraining ? 'Sedang / Selesai' : 'Belum' ?>

					</small>

				</div>
				<div class="col">

					<div class="<?= $hasTraining ? 'text-success' : 'text-muted' ?> mb-2">

						<i class="fas <?= $hasTraining ? 'fa-check-circle' : 'fa-graduation-cap' ?> fa-2x"></i>

					</div>

					<strong>Pelatihan</strong>

					<br>

					<small class="<?= $hasTraining ? 'text-success' : 'text-muted' ?>">

						<?= $hasTraining ? 'Sedang / Selesai' : 'Belum' ?>

					</small>

				</div>
			</div>

		</div>

	</div>
</div>
