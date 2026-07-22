<div class="container-fluid">

	<div class="card shadow border-0 mb-4 bg-gradient-primary text-white">

		<div class="card-body py-4">

			<div class="row align-items-center">

				<div class="col">

					<h2 class="font-weight-bold mb-2">

						Sertifikat Saya

					</h2>

					<p class="mb-0 text-white-50">

						Seluruh sertifikat pelatihan yang telah berhasil Anda peroleh.

					</p>

				</div>

				<div class="col-auto">

					<i class="fas fa-award fa-4x text-white-50"></i>

				</div>

			</div>

		</div>

	</div>

	<?php if ($certificates->isEmpty()): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-certificate fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Sertifikat

				</h4>

				<p class="text-muted mb-4">

					Sertifikat akan tersedia setelah Anda menyelesaikan pelatihan
					dan dinyatakan lulus.

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

		<?php foreach ($certificates as $certificate): ?>

		<?php

			$registration = $certificate->registration;

			$training = $registration->training;

			$field = $training->trainingField;

			$score = $registration->score;

		?>

		<div class="col-lg-6 mb-4">

			<div class="card shadow border-left-success h-100">

				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-4">

						<div>

        <span class="badge badge-success px-3 py-2">

            <i class="fas fa-check-circle mr-2"></i>

            VALID

        </span>

						</div>

						<i class="fas fa-award fa-3x text-warning"></i>

					</div>

					<h4 class="font-weight-bold mb-2">

						<?= e($training->name) ?>

					</h4>

					<p class="text-muted mb-4">

						<?= e($field?->name ?? '-') ?>

					</p>

					<div class="row text-center mb-4">

						<div class="col">

							<small class="text-muted d-block">

								Nilai

							</small>

							<h4 class="font-weight-bold text-primary mb-0">

								<?= $score?->final_score ?? '-' ?>

							</h4>

						</div>

						<div class="col">

							<small class="text-muted d-block">

								Status

							</small>

							<h5 class="font-weight-bold text-success mb-0">

								Lulus

							</h5>

						</div>

					</div>

					<table class="table table-borderless table-sm mb-0">

						<tbody>

						<tr>

							<th width="180">

								Nomor Sertifikat

							</th>

							<td>

								<?= e($certificate->certificate_number) ?>

							</td>

						</tr>

						<tr>

							<th>

								Tanggal Terbit

							</th>

							<td>

								<?= $certificate->issued_at?->format('d F Y') ?? '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Kode Verifikasi

							</th>

							<td>

								<code>

									<?= e($certificate->verification_code) ?>

								</code>

							</td>

						</tr>

						<tr>

							<th>

								Pelatih

							</th>

							<td>

								<?= e($training->trainer?->getDisplayName() ?? '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= e($field?->name ?? '-') ?>

							</td>

						</tr>

						</tbody>

					</table>
				</div>

				<div class="card-footer bg-white">

					<div class="row">

						<div class="col-md-6 mb-2 mb-md-0">

							<a
								href="<?= url('/peserta/certificates/show?id=' . $certificate->id) ?>"
								class="btn btn-success btn-block">

								<i class="fas fa-eye mr-2"></i>

								Lihat Sertifikat

							</a>

						</div>

						<div class="col-md-6">

							<?php if (! empty($certificate->verification_code)): ?>

								<a
									href="<?= url('/verify?code=' . urlencode($certificate->verification_code)) ?>"
									target="_blank"
									class="btn btn-outline-primary btn-block">

									<i class="fas fa-shield-alt mr-2"></i>

									Verifikasi

								</a>

							<?php else: ?>

								<button
									class="btn btn-outline-secondary btn-block"
									disabled>

									<i class="fas fa-ban mr-2"></i>

									Tidak Tersedia

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
