<div class="container-fluid">

	<nav aria-label="breadcrumb" class="mb-3">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/dashboard') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/schedules') ?>">

					Jadwal Mengajar

				</a>

			</li>

			<li class="breadcrumb-item active">

				Detail Jadwal

			</li>

		</ol>

	</nav>

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-9">

					<h2 class="font-weight-bold text-gray-800 mb-2">

						<?= e($schedule->training->name) ?>

					</h2>

					<div class="mb-2">

                        <span class="badge badge-primary">

                            <?= e($schedule->getMeetingLabel()) ?>

                        </span>

					</div>

					<div class="text-muted">

						<i class="fas fa-calendar-alt mr-1"></i>

						<?= $schedule->schedule_date->format('d F Y') ?>

						&nbsp;&nbsp;

						<i class="fas fa-clock mr-1"></i>

						<?= e($schedule->getTimeRange()) ?>

						&nbsp;&nbsp;

						<i class="fas fa-map-marker-alt mr-1"></i>

						<?= e($schedule->getRoom()) ?>

					</div>

				</div>

				<div class="col-lg-3 text-lg-right mt-3 mt-lg-0">

					<a
						href="<?= url('/pelatih/schedules') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

	<div class="card shadow mb-4">

		<div class="card-header">

			<h6 class="m-0 font-weight-bold text-primary">

				Informasi Jadwal

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-md-6">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="180">

								Pelatihan

							</th>

							<td>

								<?= e($schedule->training->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= e($schedule->training->trainingField->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Pertemuan

							</th>

							<td>

								<?= e($schedule->getMeetingLabel()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Tanggal

							</th>

							<td>

								<?= $schedule->schedule_date->format('d F Y') ?>

							</td>

						</tr>

					</table>

				</div>

				<div class="col-md-6">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="180">

								Jam

							</th>

							<td>

								<?= e($schedule->getTimeRange()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Ruangan

							</th>

							<td>

								<?= e($schedule->getRoom()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Topik

							</th>

							<td>

								<?= e($schedule->topic ?: '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

								<?php if ($schedule->isToday()): ?>

									<span class="badge badge-success">

                                        Hari Ini

                                    </span>

								<?php elseif ($schedule->isUpcoming()): ?>

									<span class="badge badge-info">

                                        Akan Datang

                                    </span>

								<?php else: ?>

									<span class="badge badge-secondary">

                                        Selesai

                                    </span>

								<?php endif; ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Total Peserta

							</div>

							<div class="h3 font-weight-bold text-gray-800">

								<?= $participantCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Hadir

							</div>

							<div class="h3 font-weight-bold">

								<?= $presentCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

								Izin

							</div>

							<div class="h3 font-weight-bold">

								<?= $permissionCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-user-clock fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

								Belum Hadir

							</div>

							<div class="h3 font-weight-bold">

								<?= $absentCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-user-times fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<div class="col-lg-8">
			<div class="card shadow mb-4">

				<div class="card-header py-3 d-flex justify-content-between align-items-center">

					<h6 class="m-0 font-weight-bold text-primary">

						Ringkasan Pertemuan

					</h6>

					<span class="badge badge-light">

            <?= e($schedule->getMeetingLabel()) ?>

        </span>

				</div>

				<div class="card-body">

					<div class="row text-center">

						<div class="col-md-3 mb-3">

							<i class="fas fa-calendar-day fa-2x text-primary mb-2"></i>

							<div class="small text-muted">

								Tanggal

							</div>

							<strong>

								<?= $schedule->schedule_date->format('d M Y') ?>

							</strong>

						</div>

						<div class="col-md-3 mb-3">

							<i class="fas fa-clock fa-2x text-success mb-2"></i>

							<div class="small text-muted">

								Jam

							</div>

							<strong>

								<?= e($schedule->getTimeRange()) ?>

							</strong>

						</div>

						<div class="col-md-3 mb-3">

							<i class="fas fa-map-marker-alt fa-2x text-danger mb-2"></i>

							<div class="small text-muted">

								Ruangan

							</div>

							<strong>

								<?= e($schedule->getRoom()) ?>

							</strong>

						</div>

						<div class="col-md-3 mb-3">

							<i class="fas fa-users fa-2x text-info mb-2"></i>

							<div class="small text-muted">

								Peserta

							</div>

							<strong>

								<?= $participantCount ?>

							</strong>

						</div>

					</div>

				</div>

			</div>
			<div class="card shadow mb-4">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Progress Pelatihan

					</h6>

				</div>

				<div class="card-body">


					<div class="d-flex justify-content-between mb-2">

            <span>

                Pertemuan <?= $schedule->meeting_number ?>

                dari

                <?= $totalMeeting ?>

            </span>

						<strong>

							<?= $meetingProgress ?>%

						</strong>

					</div>

					<div class="progress" style="height:20px;">

						<div
							class="progress-bar bg-primary"
							style="width:<?= $progress ?>%;">

						</div>

					</div>

				</div>

			</div>
			<div class="card shadow mb-4">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Akses Cepat

					</h6>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pelatih/attendances/detail?session=' . ($attendanceSession?->id ?? 0)) ?>"
								class="btn btn-outline-primary btn-block">

								<i class="fas fa-user-check fa-2x mb-2"></i>

								<br>

								Monitoring

							</a>

						</div>

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pelatih/materials?schedule=' . $schedule->id) ?>"
								class="btn btn-outline-info btn-block">

								<i class="fas fa-book fa-2x mb-2"></i>

								<br>

								Materi

							</a>

						</div>

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pelatih/schedules') ?>"
								class="btn btn-outline-secondary btn-block">

								<i class="fas fa-list fa-2x mb-2"></i>

								<br>

								Semua Jadwal

							</a>

						</div>

					</div>

				</div>

			</div>
		</div>

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Control Panel Absensi

					</h6>

				</div>

				<div class="card-body">

					<?php if ($attendanceSession): ?>

						<div class="mb-3">

							<small class="text-muted d-block">

								Status

							</small>

							<?php if ($attendanceSession->isActive()): ?>

								<span class="badge badge-success px-3 py-2">

                                Sedang Dibuka

                            </span>

							<?php elseif ($attendanceSession->isClosed()): ?>

								<span class="badge badge-secondary px-3 py-2">

                                Sudah Ditutup

                            </span>

							<?php else: ?>

								<span class="badge badge-warning px-3 py-2">

                                Belum Dimulai

                            </span>

							<?php endif; ?>

						</div>

						<table class="table table-borderless table-sm mb-4">

							<tr>

								<th width="120">

									Metode

								</th>

								<td>

									<?= e($attendanceSession->attendance_type) ?>

								</td>

							</tr>
							<?php if (
								$attendanceSession->isManual()
								||
								$attendanceSession->isHybrid()
							): ?>

								<tr>

									<th>

										Kode Absensi

									</th>

									<td>

										<div class="d-flex align-items-center">

			<span
				class="badge badge-primary px-3 py-2 mr-2"
				style="font-size:16px; letter-spacing:2px;">

				<?= e($attendanceSession->attendance_code ?? '-') ?>

			</span>


											<button
												type="button"
												class="btn btn-sm btn-outline-secondary"
												onclick="navigator.clipboard.writeText('<?= $attendanceSession->attendance_code ?>')">

												<i class="fas fa-copy"></i>

											</button>

										</div>

									</td>

								</tr>

							<?php endif; ?>
							<tr>

								<th>

									Dibuka

								</th>

								<td>

									<?= $attendanceSession->opened_at?->format('d M Y H:i') ?: '-' ?>

								</td>

							</tr>

							<tr>

								<th>

									Berakhir

								</th>

								<td>

									<?= $attendanceSession->expired_at?->format('d M Y H:i') ?: '-' ?>

								</td>

							</tr>

							<tr>

								<th>

									Radius

								</th>

								<td>

									<?= e($attendanceSession->getRadiusLabel()) ?>

								</td>

							</tr>

						</table>

						<?php if ($attendanceSession->isActive()): ?>

							<a
								href="<?= url('/pelatih/attendances/show?session=' . $attendanceSession->id) ?>"
								class="btn btn-primary btn-block mb-2">

								<i class="fas fa-users mr-2"></i>

								Monitoring Absensi

							</a>

							<?php if ($attendanceSession->isQr()): ?>

								<a
									href="<?= url('/pelatih/attendances/qrcode?session=' . $attendanceSession->id) ?>"
									class="btn btn-info btn-block mb-2">

									<i class="fas fa-qrcode mr-2"></i>

									Tampilkan QR Code

								</a>

							<?php endif; ?>

							<a
								href="<?= url('/pelatih/attendances/close?session=' . $attendanceSession->id) ?>"
								class="btn btn-danger btn-block">

								<i class="fas fa-door-closed mr-2"></i>

								Tutup Absensi

							</a>

						<?php else: ?>

							<a
								href="<?= url('/pelatih/attendances/show?session=' . $attendanceSession->id) ?>"
								class="btn btn-outline-primary btn-block">

								<i class="fas fa-eye mr-2"></i>

								Detail Absensi

							</a>

						<?php endif; ?>

					<?php else: ?>

						<div class="alert alert-light border mb-3">

							Belum ada sesi absensi untuk pertemuan ini.

						</div>

						<a
							href="<?= url('/pelatih/attendances/create?schedule=' . $schedule->id) ?>"
							class="btn btn-success btn-block">

							<i class="fas fa-play-circle mr-2"></i>

							Buka Absensi

						</a>

					<?php endif; ?>

				</div>

			</div>
			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Penilaian

					</h6>

				</div>

				<div class="card-body">

					<?php if ($schedule->training->isCompleted()): ?>

						<p class="text-muted">

							Pelatihan telah selesai. Anda dapat melakukan input nilai peserta.

						</p>

						<a
							href="<?= url('/pelatih/scores?schedule=' . $schedule->id) ?>"
							class="btn btn-success btn-block">

							<i class="fas fa-star mr-2"></i>

							Input Nilai

						</a>

					<?php else: ?>

						<div class="alert alert-warning mb-0">

							Input nilai akan tersedia setelah seluruh sesi pelatihan selesai.

						</div>

					<?php endif; ?>

				</div>

			</div>

		</div>

	</div>

</div>
