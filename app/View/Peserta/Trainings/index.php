<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-2">

						Pelatihan Saya

					</h3>

					<p class="text-muted mb-0">

						Kelola seluruh pelatihan yang sedang Anda ikuti maupun yang telah selesai.

					</p>

				</div>

				<div>

                    <span class="badge badge-primary px-3 py-2">

                        <?= $registrations->count() ?>

                        Pelatihan

                    </span>

				</div>

			</div>

		</div>

	</div>

	<?php if ($registrations->isEmpty()): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-graduation-cap fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Mengikuti Pelatihan

				</h4>

				<p class="text-muted mb-4">

					Anda belum memiliki pelatihan yang sedang berlangsung ataupun selesai.

				</p>

				<a
					href="<?= url('/peserta/registrations') ?>"
					class="btn btn-primary">

					<i class="fas fa-search mr-2"></i>

					Cari Pelatihan

				</a>

			</div>

		</div>

	<?php else: ?>

	<div class="row">

		<?php foreach ($registrations as $registration): ?>

<?php

	$training = $registration->training;

	$schedule = $training->schedules->sortBy('schedule_date')->first();

	$statusColor = match ($registration->status) {

		'approved' => 'success',

		'completed' => 'primary',

		'pending' => 'warning',

		'rejected' => 'danger',

		default => 'secondary',

	};

?>
		<div class="col-xl-6 mb-4">

			<div class="card shadow h-100 border-0">

				<div class="card-header bg-white">

					<div class="d-flex justify-content-between align-items-center">

                <span class="badge badge-<?= $training->trainingField?->color ?? 'primary' ?>">

                    <i class="<?= $training->trainingField?->icon ?? 'fas fa-book-open' ?> mr-1"></i>

                    <?= e($training->trainingField?->name ?? '-') ?>

                </span>

						<span class="badge badge-<?= $statusColor ?>">

                    <?= ucfirst($registration->status) ?>

                </span>

					</div>

				</div>

				<div class="card-body">

					<h5 class="font-weight-bold">

						<?= e($training->name) ?>

					</h5>

					<p class="text-muted small mb-3">

						<?= e($training->description) ?>

					</p>

					<hr>

					<div class="row">

						<div class="col-6 mb-3">

							<small class="text-muted">

								Kategori

							</small>

							<div class="font-weight-bold">

								<?= e($training->trainingField?->name ?? '-') ?>

							</div>

						</div>

						<div class="col-6 mb-3">

							<small class="text-muted">

								Pelatih

							</small>

							<div class="font-weight-bold">

								<?= e($training->trainer?->getDisplayName() ?? '-') ?>

							</div>

						</div>

						<div class="col-6 mb-3">

							<small class="text-muted">

								Lokasi

							</small>

							<div>

								<?= e($training->location ?: '-') ?>

							</div>

						</div>

						<div class="col-6 mb-3">

							<small class="text-muted">

								Ruangan

							</small>

							<div>

								<?= e($schedule?->room ?? '-') ?>

							</div>

						</div>

						<div class="col-6">

							<small class="text-muted">

								Jadwal

							</small>

							<div>

								<?= $schedule?->schedule_date?->format('d M Y') ?? '-' ?>

							</div>

						</div>

						<div class="col-6">

							<small class="text-muted">

								Durasi

							</small>

							<div>

								<?= $training->duration ?>

								Hari

							</div>

						</div>

					</div>

					<hr>

					<?php
						$progress = match ($registration->status) {

							'pending'   => 10,

							'approved'  => 30,

							'running'   => 70,

							'completed' => 90,

							'certified' => 100,

							default => 0,

						};

					?>

					<small class="text-muted">

						Progress Pelatihan

					</small>

					<div class="progress mt-2 mb-2" style="height:10px;">

						<div
							class="progress-bar bg-success"
							style="width: <?= $progress ?>%">

						</div>

					</div>

					<small class="font-weight-bold text-success">

						<?= $progress ?>%

					</small>

				</div>
				<div class="card-footer bg-white">

					<div class="row">

						<div class="col-6">

							<a
								href="<?= url('/peserta/trainings/show?id=' . $training->id) ?>"
								class="btn btn-outline-primary btn-block">

								<i class="fas fa-eye mr-2"></i>

								Detail

							</a>

						</div>

						<div class="col-6">

							<?php if ($registration->isCompleted() && $registration->certificate): ?>

								<a
									href="<?= url('/peserta/certificates/show?id=' . $registration->certificate->id) ?>"
									class="btn btn-success btn-block">

									<i class="fas fa-certificate mr-2"></i>

									Sertifikat

								</a>

							<?php elseif ($registration->isApproved()): ?>

								<div class="alert alert-info mb-0">

									<i class="fas fa-info-circle mr-2"></i>

									Silakan hadir sesuai jadwal pelatihan.
									Absensi dilakukan melalui Trainer atau QR Code di lokasi pelatihan.

								</div>

							<?php else: ?>

								<button
									class="btn btn-secondary btn-block"
									disabled>

									<i class="fas fa-clock mr-2"></i>

									Menunggu Persetujuan

								</button>

							<?php endif; ?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php endforeach; ?>

	</div>

	<?php endif; ?>

</div>
