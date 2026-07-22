<div class="container-fluid">

	<?php

		$completedCount = $histories
			->where('status', 'completed')
			->count();

		$rejectedCount = $histories
			->where('status', 'rejected')
			->count();

	?>

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-primary mb-2">

						Riwayat Pelatihan

					</h3>

					<p class="text-muted mb-0">

						Seluruh riwayat pelatihan yang pernah Anda ikuti beserta hasil akhir,
						nilai, dan sertifikat.

					</p>

				</div>

				<div class="col-lg-4">

					<div class="row text-center mt-4 mt-lg-0">

						<div class="col">

							<h3 class="font-weight-bold text-success mb-0">

								<?= $completedCount ?>

							</h3>

							<small class="text-muted">

								Selesai

							</small>

						</div>

						<div class="col">

							<h3 class="font-weight-bold text-danger mb-0">

								<?= $rejectedCount ?>

							</h3>

							<small class="text-muted">

								Ditolak

							</small>

						</div>

						<div class="col">

							<h3 class="font-weight-bold text-primary mb-0">

								<?= $histories->count() ?>

							</h3>

							<small class="text-muted">

								Total

							</small>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php if ($histories->isEmpty()): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-history fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Riwayat Pelatihan

				</h4>

				<p class="text-muted mb-4">

					Riwayat pelatihan akan muncul setelah Anda menyelesaikan
					atau pernah mengikuti pelatihan.

				</p>

				<a
					href="<?= url('/peserta/trainings') ?>"
					class="btn btn-primary">

					<i class="fas fa-graduation-cap mr-2"></i>

					Pelatihan Saya

				</a>

			</div>

		</div>

	<?php else: ?>

		<div class="row">

			<?php foreach ($histories as $history): ?>

				<?php

				$training = $history->training;

				$field = $training->trainingField;

				$trainer = $training->trainer;

				$certificate = $history->certificate;

				$score = $history->score;

				$schedule = $training->schedules
					->sortBy('schedule_date')
					->first();

				$color = $history->status === 'completed'
					? 'success'
					: 'danger';

				$icon = $history->status === 'completed'
					? 'check-circle'
					: 'times-circle';

				$label = $history->status === 'completed'
					? 'Selesai'
					: 'Ditolak';

				?>

				<div class="col-xl-6 mb-4">

					<div class="card shadow border-0 h-100">

						<div class="card-header bg-white">

							<div class="d-flex justify-content-between align-items-center">

                                <span class="badge badge-<?= $field?->color ?? 'primary' ?>">

                                    <i class="<?= $field?->icon ?? 'fas fa-book-open' ?> mr-1"></i>

                                    <?= e($field?->name ?? '-') ?>

                                </span>

								<span class="badge badge-<?= $color ?> px-3 py-2">

                                    <i class="fas fa-<?= $icon ?> mr-2"></i>

                                    <?= $label ?>

                                </span>

							</div>

						</div>

						<div class="card-body">
							<h4 class="font-weight-bold mb-2">

								<?= e($training->name) ?>

							</h4>

							<p class="text-muted small mb-4">

								<?= e($training->description) ?>

							</p>

							<div class="row">

								<div class="col-md-6 mb-3">

									<small class="text-muted d-block">

										Pelatih

									</small>

									<strong>

										<?= e($trainer?->getDisplayName() ?? '-') ?>

									</strong>

									<div class="small text-muted">

										<?= e($trainer?->institution ?? '-') ?>

									</div>

								</div>

								<div class="col-md-6 mb-3">

									<small class="text-muted d-block">

										Lokasi

									</small>

									<strong>

										<?= e($training->location ?: '-') ?>

									</strong>

								</div>

								<div class="col-md-6 mb-3">

									<small class="text-muted d-block">

										Jadwal

									</small>

									<strong>

										<?= $schedule?->schedule_date?->format('d M Y') ?? '-' ?>

									</strong>

								</div>

								<div class="col-md-6 mb-3">

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

							<div class="row text-center">

								<div class="col">

									<div class="border rounded py-3">

										<small class="text-muted d-block">

											Status

										</small>

										<h6 class="font-weight-bold text-<?= $color ?> mb-0">

											<?= $label ?>

										</h6>

									</div>

								</div>

								<div class="col">

									<div class="border rounded py-3">

										<small class="text-muted d-block">

											Nilai

										</small>

										<h5 class="font-weight-bold text-primary mb-0">

											<?= $score?->final_score ?? '-' ?>

										</h5>

									</div>

								</div>

								<div class="col">

									<div class="border rounded py-3">

										<small class="text-muted d-block">

											Sertifikat

										</small>

										<h6 class="font-weight-bold mb-0">

											<?= $certificate ? 'Tersedia' : '-' ?>

										</h6>

									</div>

								</div>

							</div>

							<hr>

							<small class="text-muted">

								Tanggal Pendaftaran

							</small>

							<div class="font-weight-bold">

								<?= $history->created_at?->format('d F Y H:i') ?>

							</div>
							<?php if (
								$history->status === 'rejected'
								&& ! empty($history->rejected_reason)
							): ?>

								<div class="alert alert-danger mt-4 mb-0">

									<h6 class="font-weight-bold">

										<i class="fas fa-times-circle mr-2"></i>

										Alasan Penolakan

									</h6>

									<p class="mb-0">

										<?= e($history->rejected_reason) ?>

									</p>

								</div>

							<?php endif; ?>

						</div>

						<div class="card-footer bg-white">

							<div class="row">

								<div class="col-md-6 mb-2 mb-md-0">

									<a
										href="<?= url('/peserta/trainings/show?id=' . $training->id) ?>"
										class="btn btn-outline-primary btn-block">

										<i class="fas fa-eye mr-2"></i>

										Detail Pelatihan

									</a>

								</div>

								<div class="col-md-6">

									<?php if ($certificate): ?>

										<a
											href="<?= url('/peserta/certificates/show?id=' . $certificate->id) ?>"
											class="btn btn-success btn-block">

											<i class="fas fa-certificate mr-2"></i>

											Lihat Sertifikat

										</a>

									<?php else: ?>

										<button
											class="btn btn-secondary btn-block"
											disabled>

											<i class="fas fa-ban mr-2"></i>

											Sertifikat Belum Tersedia

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
