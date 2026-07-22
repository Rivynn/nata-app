<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-2">

						Absensi Hari Ini

					</h3>

					<p class="text-muted mb-0">

						Lakukan absensi pada sesi pelatihan yang sedang berlangsung.

					</p>

				</div>

				<span class="badge badge-primary px-3 py-2">

                    <?= date('d M Y') ?>

                </span>

			</div>

		</div>

	</div>

	<?php if (empty($session)): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-calendar-times fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Sesi Absensi

				</h4>

				<p class="text-muted mb-0">

					Trainer belum membuka sesi absensi hari ini.

				</p>

			</div>

		</div>

	<?php else: ?>

		<div class="card shadow border-0">

			<div class="card-header bg-white">

				<h5 class="mb-0 font-weight-bold">

					Informasi Pelatihan

				</h5>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-6 mb-3">

						<small class="text-muted">

							Pelatihan

						</small>

						<div class="font-weight-bold">

							<?= e($session->trainingSchedule?->training?->name) ?>

						</div>

					</div>

					<div class="col-md-6 mb-3">

						<small class="text-muted">

							Trainer

						</small>

						<div class="font-weight-bold">

							<?= e($session->trainingSchedule?->training?->trainer?->getDisplayName()) ?>

						</div>

					</div>

					<div class="col-md-6 mb-3">

						<small class="text-muted">

							Tanggal

						</small>

						<div>

							<?= $session->trainingSchedule?->schedule_date?->format('d M Y') ?>

						</div>

					</div>

					<div class="col-md-6 mb-3">

						<small class="text-muted">

							Ruangan

						</small>

						<div>

							<?= e($session->trainingSchedule?->room ?? '-') ?>

						</div>

					</div>

					<div class="col-md-6">

						<small class="text-muted">

							Metode Absensi

						</small>

						<div>

							<?php if ($session->isQr()): ?>

								<span class="badge badge-primary">

                                    QR Code

                                </span>

							<?php elseif ($session->isManual()): ?>

								<span class="badge badge-info">

                                    Manual

                                </span>

							<?php else: ?>

								<span class="badge badge-success">

                                    Hybrid

                                </span>

							<?php endif; ?>

						</div>

					</div>

					<div class="col-md-6">

						<small class="text-muted">

							Status

						</small>

						<div>

							<?php if (!empty($attendance)): ?>

								<span class="badge badge-success">

                                    Sudah Absen

                                </span>

							<?php else: ?>

								<span class="badge badge-warning">

                                    Belum Absen

                                </span>

							<?php endif; ?>

						</div>

					</div>

				</div>

				<hr>

				<?php if (!empty($attendance)): ?>

					<div class="alert alert-success mb-0">

						<i class="fas fa-check-circle mr-2"></i>

						Anda telah melakukan absensi pada

						<strong>

							<?= $attendance->check_in_at?->format('H:i') ?>

						</strong>

						menggunakan

						<strong>

							<?= $attendance->isQrCode() ? 'QR Code' : 'Manual' ?>

						</strong>.

					</div>

				<?php elseif ($session->isManual() || $session->isHybrid()): ?>

					<form
						method="POST"
						action="<?= url('/peserta/attendances') ?>">

						<input
							type="hidden"
							name="attendance_session_id"
							value="<?= $session->id ?>">

						<div class="form-group">

							<label>

								Kode Absensi

							</label>

							<input
								type="text"
								name="code"
								class="form-control"
								placeholder="Masukkan kode yang diberikan trainer"
								required>

						</div>

						<button
							class="btn btn-primary">

							<i class="fas fa-check mr-2"></i>

							Absen Sekarang

						</button>

					</form>

				<?php else: ?>

					<div class="alert alert-info mb-0">

						<i class="fas fa-qrcode mr-2"></i>

						Silakan lakukan absensi dengan memindai QR Code yang ditampilkan oleh trainer.

					</div>

				<?php endif; ?>

			</div>

		</div>

	<?php endif; ?>

</div>
