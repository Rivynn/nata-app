<?php

	use Carbon\Carbon;

	/**
	 * @var string $title
	 * @var \Illuminate\Support\Collection|\Natasya\NataApp\Model\TrainingSchedule[] $schedules
	 * @var int $totalMeeting
	 * @var int $openedMeeting
	 * @var int $activeMeeting
	 * @var int $closedMeeting
	 */

?>

<div class="container-fluid">

	<!-- Breadcrumb -->

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">
				<a href="<?= url('/pelatih') ?>">
					Dashboard
				</a>
			</li>

			<?php if ($training): ?>

				<li class="breadcrumb-item">

					<a href="<?= url('/pelatih/trainings') ?>">

						Pelatihan Saya

					</a>

				</li>

				<li class="breadcrumb-item">

					<a href="<?= url('/pelatih/trainings/show?id=' . $training->id) ?>">

						<?= e($training->name) ?>

					</a>

				</li>

			<?php endif; ?>

			<li class="breadcrumb-item active">

				Kelola Absensi

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-primary mb-2">

						<?= e($title) ?>

					</h3>
					<?php if ($training): ?>

						<p class="text-muted mb-3">

							Monitoring absensi pelatihan
							<strong><?= e($training->name) ?></strong>.

						</p>

					<?php else: ?>

						<p class="text-muted mb-3">

							Monitoring seluruh sesi absensi pelatihan yang Anda ampu.

						</p>

					<?php endif; ?>

					<span class="badge badge-primary">

                        <?= $totalMeeting ?> Pertemuan

                    </span>

					<span class="badge badge-success">

                        <?= $activeMeeting ?> Aktif

                    </span>

					<span class="badge badge-secondary">

                        <?= $closedMeeting ?> Ditutup

                    </span>

				</div>
				<div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
					<?php if ($training): ?>

						<a
							href="<?= url('/pelatih/trainings/show?id=' . $training->id) ?>"
							class="btn btn-outline-secondary mr-2">

							<i class="fas fa-arrow-left mr-1"></i>

							Kembali

						</a>

					<?php endif; ?>

					<a
						href="<?= url('/pelatih/attendances/create') ?>"
						class="btn btn-primary shadow">

						<i class="fas fa-plus-circle mr-2"></i>

						Buka Absensi

					</a>

				</div>
			</div>

		</div>

	</div>

	<!-- Summary -->

	<div class="row mb-4">

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Total Pertemuan

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $totalMeeting ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-calendar fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">

								Sudah Dibuka

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $openedMeeting ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-door-open fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Sedang Aktif

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $activeMeeting ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-broadcast-tower fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-secondary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">

								Ditutup

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $closedMeeting ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="card shadow mb-4">

		<div class="card-header py-3 d-flex justify-content-between align-items-center">

			<h6 class="m-0 font-weight-bold text-primary">

				<?php if ($training): ?>

					Daftar Pertemuan -
					<?= e($training->name) ?>

				<?php else: ?>

					Daftar Pertemuan

				<?php endif; ?>

			</h6>
			<input
				type="text"
				id="attendanceSearch"
				class="form-control form-control-sm"
				placeholder="Cari meeting..."
				style="max-width:250px;">

		</div>

		<div class="card-body p-0">

			<div class="table-responsive">

				<table class="table table-hover mb-0" id="attendanceTable">

					<thead class="thead-light">

					<tr>

						<th width="90">Meeting</th>
						<?php if (!$training): ?>

							<th>Pelatihan</th>

						<?php endif; ?>

						<th width="140">Tanggal</th>

						<th width="130">Jam</th>

						<th width="140">Ruangan</th>

						<th width="170">Status</th>

						<th width="170">Kehadiran</th>

						<th width="150">Metode</th>

						<th width="180">Dibuka Oleh</th>

						<th width="220">Aksi</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach ($schedules as $schedule): ?>

					<?php

						$session = $schedule
							->attendanceSessions
							->first();

						$totalParticipant = $schedule
							->training
							->registrations
							->count();

						$presentParticipant = 0;

						if ($session) {

							$presentParticipant = $session
								->attendances
								->whereIn('status', [
									'present',
									'late',
								])
								->count();

						}

					?>

					<tr>

						<td>

							<strong>

								<?= $schedule->getMeetingLabel() ?>

							</strong>

						</td>
						<?php if (!$training): ?>

						<td>

							<div class="font-weight-bold">

								<?= e($schedule->training->name) ?>

							</div>

							<small class="text-muted">

								<?= e($schedule->topic ?: '-') ?>

							</small>

						</td>
						<?php endif; ?>
						<td>

							<?= $schedule->schedule_date
								? $schedule->schedule_date->format('d M Y')
								: '-' ?>

						</td>

						<td>

							<?= e($schedule->getTimeRange()) ?>

						</td>

						<td>

							<?= e($schedule->getRoom()) ?>

						</td>

						<td>

							<?php if (!$session): ?>

								<span class="badge badge-light">

                                    Belum Dibuka

                                </span>

							<?php elseif ($session->isActive()): ?>

								<span class="badge badge-success">

                                    Sedang Berlangsung

                                </span>

							<?php else: ?>

								<span class="badge badge-secondary">

                                    Ditutup

                                </span>

							<?php endif; ?>

						</td>

						<td>

							<strong>

								<?= $presentParticipant ?>

							</strong>

							/

							<?= $totalParticipant ?>

							<div class="progress mt-1">

								<div
									class="progress-bar bg-success"
									style="width: <?= $totalParticipant > 0 ? ($presentParticipant / $totalParticipant) * 100 : 0 ?>%">

								</div>

							</div>

						</td>

						<td>

							<?php if (!$session): ?>

								-

							<?php elseif ($session->attendance_type === 'qr'): ?>

								<span class="badge badge-info">

                                    QR Code

                                </span>

							<?php elseif ($session->attendance_type === 'manual'): ?>

								<span class="badge badge-primary">

                                    Manual

                                </span>

							<?php else: ?>

								<span class="badge badge-warning">

                                    Hybrid

                                </span>

							<?php endif; ?>

						</td>

						<td>

							<?php if ($session && $session->opener): ?>

								<?= e($session->opener->name) ?>

							<?php else: ?>

								-

							<?php endif; ?>

						</td>

						<td>
<?php if (!$session): ?>

    <a
        href="<?= url('/pelatih/attendances/create?schedule=' . $schedule->id) ?>"
        class="btn btn-sm btn-primary">

        <i class="fas fa-door-open mr-1"></i>

        Buka

    </a>

<?php elseif ($session->isActive()): ?>

    <a
        href="<?= url('/pelatih/attendances/show?session=' . $session->id) ?>"
        class="btn btn-sm btn-success">

        <i class="fas fa-eye mr-1"></i>

        Monitoring

    </a>

    <form
        action="<?= url('/pelatih/attendances/close') ?>"
        method="post"
        class="d-inline">

        <input
            type="hidden"
            name="session_id"
            value="<?= $session->id ?>">

        <button
            type="submit"
            class="btn btn-sm btn-outline-danger"
            onclick="return confirm('Tutup sesi absensi ini?')">

            <i class="fas fa-lock"></i>

        </button>

    </form>

<?php else: ?>

    <a
        href="<?= url('/pelatih/attendances/show?session=' . $session->id) ?>"
        class="btn btn-sm btn-outline-primary">

        <i class="fas fa-search mr-1"></i>

        Detail

    </a>

<?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php if ($schedules->isEmpty()): ?>

    <div class="card shadow">

        <div class="card-body text-center py-5">

            <i class="fas fa-calendar-times fa-5x text-gray-300 mb-4"></i>

            <h4 class="font-weight-bold text-gray-700">

                Belum Ada Jadwal Pelatihan

            </h4>

            <p class="text-muted mb-0">

                Belum terdapat jadwal pelatihan yang dapat dikelola.

            </p>

        </div>

    </div>

<?php endif; ?>
	<div class="card shadow mt-4">

		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">

				Keterangan Status

			</h6>

		</div>

		<div class="card-body">

			<div class="row text-center">

				<div class="col-md-3 mb-2">

                <span class="badge badge-success px-3 py-2">

                    Sedang Berlangsung

                </span>

				</div>

				<div class="col-md-3 mb-2">

                <span class="badge badge-secondary px-3 py-2">

                    Ditutup

                </span>

				</div>

				<div class="col-md-3 mb-2">

                <span class="badge badge-light px-3 py-2">

                    Belum Dibuka

                </span>

				</div>

				<div class="col-md-3 mb-2">

                <span class="badge badge-info px-3 py-2">

                    QR / Manual

                </span>

				</div>

			</div>

		</div>

	</div>

	<div class="alert alert-info shadow-sm mt-4">

		<div class="d-flex">

			<div class="mr-3">

				<i class="fas fa-info-circle fa-2x"></i>

			</div>

			<div>

				<strong>Informasi</strong>

				<br>

				• Setiap pertemuan hanya dapat memiliki satu sesi absensi.

				<br>

				• Sesi yang sudah ditutup tidak dapat digunakan untuk check-in peserta.

				<br>

				• Monitoring tetap dapat dibuka untuk melihat riwayat absensi.

			</div>

		</div>

	</div>

	<script>

		document
			.getElementById('attendanceSearch')
			.addEventListener('keyup', function () {

				const keyword = this.value.toLowerCase();

				document
					.querySelectorAll('#attendanceTable tbody tr')
					.forEach(function (row) {

						row.style.display = row.innerText
							.toLowerCase()
							.includes(keyword)
							? ''
							: 'none';

					});

			});

	</script>

	<?php if ($activeMeeting > 0): ?>

		<script>

			setTimeout(function () {

				location.reload();

			}, 30000);

		</script>

	<?php endif; ?>

</div>
