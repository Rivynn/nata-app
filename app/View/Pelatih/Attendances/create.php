<?php

	/**
	 * @var string $title
	 * @var \Illuminate\Support\Collection|\Natasya\NataApp\Model\TrainingSchedule[] $schedules
	 */

?>

<div class="container-fluid">

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/attendances') ?>">

					Kelola Absensi

				</a>

			</li>

			<li class="breadcrumb-item active">

				Buka Absensi

			</li>

		</ol>

	</nav>

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<h3 class="font-weight-bold text-primary mb-2">

				<?= e($title) ?>

			</h3>

			<p class="text-muted mb-0">

				Pilih pertemuan dan konfigurasi sesi absensi yang akan dibuka.

			</p>

		</div>

	</div>
	<?php if ($schedules->isEmpty()): ?>

		<div class="alert alert-warning">

			<h5 class="alert-heading">

				Belum Ada Pertemuan

			</h5>

			<p class="mb-0">

				Saat ini belum ada pertemuan yang dapat dibuka absensinya.
				Pertemuan akan tersedia setelah dibuat oleh administrator.

			</p>

		</div>

	<?php else: ?>

		<form
			action="<?= url('/pelatih/attendances/store') ?>"
			method="post">

			<div class="card shadow">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Konfigurasi Absensi

					</h6>

				</div>

				<div class="card-body">

					<div class="form-group">

						<label>

							Pertemuan

						</label>

						<select
							name="schedule_id"
							class="form-control"
							required>

							<option value="">

								-- Pilih Pertemuan --

							</option>

							<?php foreach ($schedules as $schedule): ?>

								<option value="<?= $schedule->id ?>">

									<?= e($schedule->training->name) ?>

									—

									<?= e($schedule->getMeetingLabel()) ?>

									(<?= $schedule->schedule_date->format('d M Y') ?>)

								</option>

							<?php endforeach; ?>

						</select>

						<small class="form-text text-muted">

							Pilih pertemuan yang akan dibuka sesi absensinya.

						</small>

					</div>

					<div class="form-group">

						<label>

							Metode Absensi

						</label>

						<select
							name="attendance_type"
							class="form-control"
							required>

							<option value="qr">

								QR Code

							</option>

							<option value="manual">

								Manual

							</option>

							<option value="hybrid">

								Hybrid

							</option>

						</select>

					</div>

					<div class="form-group">

						<label>

							Durasi Sesi Absensi (Menit)

						</label>

						<input
							type="number"
							name="duration"
							class="form-control"
							value="60"
							min="1"
							required>

						<small class="form-text text-muted">

							Sesi absensi akan otomatis ditutup setelah durasi berakhir.

						</small>

					</div>

				</div>

				<div class="card-footer d-flex justify-content-between">

					<a
						href="<?= url('/pelatih/attendances') ?>"
						class="btn btn-secondary">

						Kembali

					</a>

					<button
						type="submit"
						class="btn btn-primary">

						<i class="fas fa-door-open mr-2"></i>

						Buka Absensi

					</button>

				</div>

			</div>

		</form>

	<?php endif; ?>


</div>
