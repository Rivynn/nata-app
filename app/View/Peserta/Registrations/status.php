<div class="container-fluid">

	<div class="card shadow border-0 mb-4 bg-gradient-primary text-white">

		<div class="card-body py-4">

			<div class="row align-items-center">

				<div class="col">

					<h2 class="font-weight-bold mb-2">

						Status Pendaftaran

					</h2>

					<p class="mb-0 text-white-50">

						Pantau perkembangan pendaftaran pelatihan Anda secara realtime.

					</p>

				</div>

				<div class="col-auto">

					<div
						class="rounded-circle bg-white text-primary d-flex justify-content-center align-items-center shadow"
						style="width:70px;height:70px;">

						<i class="fas fa-clipboard-check fa-2x"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php if ($registrations->isEmpty()): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-folder-open fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Pendaftaran

				</h4>

				<p class="text-muted mb-4">

					Anda belum mengikuti pelatihan apa pun.

				</p>

				<a
					href="<?= url('/peserta/registrations') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus mr-2"></i>

					Daftar Pelatihan

				</a>

			</div>

		</div>

	<?php else: ?>

	<?php foreach ($registrations as $registration): ?>

	<?php

		$training = $registration->training;

		$schedule = $training->schedules->sortBy('schedule_date')->first();

		switch ($registration->status) {

			case 'approved':
				$color = 'success';
				$icon = 'check-circle';
				$status = 'Disetujui';
				$progress = 75;
				break;

			case 'completed':
				$color = 'primary';
				$icon = 'award';
				$status = 'Selesai';
				$progress = 100;
				break;

			case 'running':
				$color = 'info';
				$icon = 'play-circle';
				$status = 'Berlangsung';
				$progress = 90;
				break;

			case 'rejected':
				$color = 'danger';
				$icon = 'times-circle';
				$status = 'Ditolak';
				$progress = 100;
				break;

			default:
				$color = 'warning';
				$icon = 'clock';
				$status = 'Menunggu Verifikasi';
				$progress = 35;
		}

	?>

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold mb-1">

						<?= e($training->name) ?>

					</h4>

					<small class="text-muted">

						<?= e($training->trainingField?->name ?? '-') ?>

					</small>

				</div>

				<span class="badge badge-<?= $color ?> px-3 py-2">

                            <i class="fas fa-<?= $icon ?> mr-2"></i>

                            <?= $status ?>

                        </span>

			</div>

			<hr>
			<div class="row">

				<div class="col-md-3">

					<small class="text-muted d-block">

						Lokasi

					</small>

					<strong>

						<?= e($training->location ?: '-') ?>

					</strong>

				</div>

				<div class="col-md-3">

					<small class="text-muted d-block">

						Pelatih

					</small>

					<strong>

						<?= e($training->trainer?->getDisplayName() ?? '-') ?>

					</strong>

				</div>

				<div class="col-md-3">

					<small class="text-muted d-block">

						Jadwal

					</small>

					<strong>

						<?= $schedule?->schedule_date?->format('d M Y') ?? '-' ?>

					</strong>

				</div>

				<div class="col-md-3">

					<small class="text-muted d-block">

						Durasi

					</small>

					<strong>

						<?= $training->duration ?>

						Hari

					</strong>

				</div>

			</div>

			<hr>

			<div class="d-flex justify-content-between align-items-center mb-2">

				<small class="text-muted">

					Progress Pendaftaran

				</small>

				<strong class="text-<?= $color ?>">

					<?= $progress ?>%

				</strong>

			</div>

			<div
				class="progress mb-4"
				style="height:10px;">

				<div
					class="progress-bar bg-<?= $color ?>"
					role="progressbar"
					style="width:<?= $progress ?>%">

				</div>

			</div>

			<div class="row text-center">

				<div class="col">

					<div class="<?= $progress >= 25 ? 'text-success' : 'text-gray-400' ?>">

						<i class="fas fa-file-import fa-lg"></i>

						<div class="small mt-2">

							Dikirim

						</div>

					</div>

				</div>

				<div class="col">

					<div class="<?= $progress >= 50 ? 'text-success' : 'text-gray-400' ?>">

						<i class="fas fa-user-check fa-lg"></i>

						<div class="small mt-2">

							Diverifikasi

						</div>

					</div>

				</div>

				<div class="col">

					<div class="<?= in_array($registration->status, ['approved', 'running', 'completed']) ? 'text-success' : 'text-gray-400' ?>">

						<i class="fas fa-check-circle fa-lg"></i>

						<div class="small mt-2">

							Disetujui

						</div>

					</div>

				</div>

				<div class="col">

					<div class="<?= $registration->status === 'completed' ? 'text-success' : 'text-gray-400' ?>">

						<i class="fas fa-award fa-lg"></i>

						<div class="small mt-2">

							Selesai

						</div>

					</div>

				</div>

			</div>

			<hr>

			<div class="row">

				<div class="col-md-6">

					<a
						href="<?= url('/peserta/trainings/show?id=' . $training->id) ?>"
						class="btn btn-outline-primary btn-block">

						<i class="fas fa-eye mr-2"></i>

						Detail Pelatihan

					</a>

				</div>

				<div class="col-md-6">

					<?php if ($registration->certificate): ?>

						<a
							href="<?= url('/peserta/certificates/show?id=' . $registration->certificate->id) ?>"
							class="btn btn-success btn-block">

							<i class="fas fa-certificate mr-2"></i>

							Sertifikat

						</a>

					<?php else: ?>

						<button
							class="btn btn-secondary btn-block"
							disabled>

							<i class="fas fa-certificate mr-2"></i>

							Belum Tersedia

						</button>

					<?php endif; ?>

				</div>

			</div>
			<?php if (
				$registration->status === 'rejected'
				&& ! empty($registration->rejected_reason)
			): ?>

				<div class="alert alert-danger mt-4 mb-0">

					<h6 class="font-weight-bold">

						<i class="fas fa-times-circle mr-2"></i>

						Pendaftaran Ditolak

					</h6>

					<p class="mb-0">

						<?= e($registration->rejected_reason) ?>

					</p>

				</div>

			<?php endif; ?>

			<?php if (
				$registration->status === 'completed'
				&& $registration->score
			): ?>

				<div class="card bg-light border mt-4">

					<div class="card-body">

						<div class="row text-center">

							<div class="col">

								<small class="text-muted d-block">

									Nilai Akhir

								</small>

								<h2 class="font-weight-bold text-primary mb-0">

									<?= number_format($registration->score->final_score, 0) ?>

								</h2>

							</div>

						</div>

					</div>

				</div>

			<?php endif; ?>

		</div>

	</div>

		<?php endforeach; ?>

	<?php endif; ?>

</div>
