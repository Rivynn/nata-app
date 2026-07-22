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

			<li class="breadcrumb-item">
				<a href="<?= url('/pelatih/schedules/show?id=' . $schedule->id) ?>">
					Detail Jadwal
				</a>
			</li>

			<li class="breadcrumb-item active">
				Monitoring Absensi
			</li>
		</ol>
	</nav>

	<div class="card shadow border-left-success mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-9">

					<h2 class="font-weight-bold text-gray-800 mb-2">
						Monitoring Absensi
					</h2>

					<div class="mb-2">

                        <span class="badge badge-primary">
                            <?= e($schedule->training->name) ?>
                        </span>

						<span class="badge badge-info">
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

					<?php if ($session->isActive()): ?>

						<span class="badge badge-success px-4 py-2">

                            <i class="fas fa-circle mr-1"></i>

                            Sedang Dibuka

                        </span>

					<?php else: ?>

						<span class="badge badge-secondary px-4 py-2">

                            Sudah Ditutup

                        </span>

					<?php endif; ?>

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

							<div class="h3 font-weight-bold">

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

								<?= $presentCount + $lateCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-user-check fa-2x text-gray-300"></i>

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

	<?php

		$progress = $participantCount > 0
			? round((($presentCount + $lateCount) / $participantCount) * 100)
			: 0;

	?>

	<div class="card shadow mb-4">

		<div class="card-header">

			<h6 class="m-0 font-weight-bold text-primary">

				Progress Kehadiran

			</h6>

		</div>

		<div class="card-body">

			<div class="d-flex justify-content-between mb-2">

                <span>

                    <?= ($presentCount + $lateCount) ?>

                    dari

                    <?= $participantCount ?>

                    peserta telah melakukan check-in

                </span>

				<strong>

					<?= $progress ?>%

				</strong>

			</div>

			<div class="progress" style="height:22px">

				<div
					class="progress-bar bg-success"
					role="progressbar"
					style="width: <?= $progress ?>%;">

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header py-3 d-flex justify-content-between align-items-center">

					<h6 class="m-0 font-weight-bold text-primary">

						Daftar Peserta

					</h6>

					<span class="badge badge-primary">

                    <?= $participantCount ?> Peserta

                </span>

				</div>

				<div class="card-body">

					<div class="form-group">

						<input
							type="text"
							class="form-control"
							id="participantSearch"
							placeholder="Cari peserta...">

					</div>

					<div class="table-responsive">

						<table
							class="table table-hover align-middle"
							id="participantTable">

							<thead class="thead-light">

							<tr>

								<th width="50">

									#

								</th>

								<th>

									Peserta

								</th>

								<th width="120">

									Check In

								</th>

								<th width="100">

									Metode

								</th>

								<th width="120">

									Status

								</th>

								<th width="220">

									Aksi

								</th>

							</tr>

							</thead>

							<tbody>

							<?php foreach ($participants as $index => $registration): ?>

								<?php

								$attendance = $registration
									->attendances
									->firstWhere(
										'attendance_session_id',
										$session->id
									);

								?>

								<tr>

									<td>

										<?= $index + 1 ?>

									</td>

									<td>

										<strong>

											<?= e($registration->getParticipantName()) ?>

										</strong>

									</td>

									<td>

										<?php if ($attendance && $attendance->check_in_at): ?>

											<?= $attendance->check_in_at->format('H:i') ?>

										<?php else: ?>

											-

										<?php endif; ?>

									</td>

									<td>

										<?php if (!$attendance): ?>

											-

										<?php elseif ($attendance->isQrCode()): ?>

											<span class="badge badge-info">

                                            QR Code

                                        </span>

										<?php else: ?>

											<span class="badge badge-secondary">

                                            Manual

                                        </span>

										<?php endif; ?>

									</td>

									<td>

										<?php if (!$attendance): ?>

											<span class="badge badge-light">

                                            Belum Hadir

                                        </span>

										<?php elseif ($attendance->isPresent()): ?>

											<span class="badge badge-success">

                                            Hadir

                                        </span>

										<?php elseif ($attendance->isLate()): ?>

											<span class="badge badge-warning">

                                            Terlambat

                                        </span>

										<?php elseif ($attendance->isPermission()): ?>

											<span class="badge badge-info">

                                            Izin

                                        </span>

										<?php else: ?>

											<span class="badge badge-danger">

                                            Alfa

                                        </span>

										<?php endif; ?>

									</td>

									<td>

										<div class="dropdown">

											<button
												class="btn btn-outline-primary btn-sm dropdown-toggle"
												type="button"
												data-toggle="dropdown">

												<i class="fas fa-edit mr-1"></i>

												Edit Status

											</button>

											<div class="dropdown-menu dropdown-menu-right">

												<form
													action="<?= url('/pelatih/attendances/update-status') ?>"
													method="post"
													class="px-2 py-1">

													<input
														type="hidden"
														name="session_id"
														value="<?= $session->id ?>">

													<input
														type="hidden"
														name="registration_id"
														value="<?= $registration->id ?>">

													<input
														type="hidden"
														name="status"
														value="present">

													<button
														type="submit"
														class="dropdown-item text-success"
														onclick="return confirm('Tandai peserta ini sebagai HADIR?')">

														<i class="fas fa-check-circle mr-2"></i>

														Hadir

													</button>

												</form>

												<form
													action="<?= url('/pelatih/attendances/update-status') ?>"
													method="post"
													class="px-2 py-1">

													<input
														type="hidden"
														name="session_id"
														value="<?= $session->id ?>">

													<input
														type="hidden"
														name="registration_id"
														value="<?= $registration->id ?>">

													<input
														type="hidden"
														name="status"
														value="late">

													<button
														type="submit"
														class="dropdown-item text-warning"
														onclick="return confirm('Tandai peserta ini sebagai TERLAMBAT?')">

														<i class="fas fa-clock mr-2"></i>

														Terlambat

													</button>

												</form>

												<form
													action="<?= url('/pelatih/attendances/update-status') ?>"
													method="post"
													class="px-2 py-1">

													<input
														type="hidden"
														name="session_id"
														value="<?= $session->id ?>">

													<input
														type="hidden"
														name="registration_id"
														value="<?= $registration->id ?>">

													<input
														type="hidden"
														name="status"
														value="permission">

													<button
														type="submit"
														class="dropdown-item text-info"
														onclick="return confirm('Tandai peserta ini sebagai IZIN?')">

														<i class="fas fa-user-clock mr-2"></i>

														Izin

													</button>

												</form>

												<div class="dropdown-divider"></div>

												<form
													action="<?= url('/pelatih/attendances/update-status') ?>"
													method="post"
													class="px-2 py-1">

													<input
														type="hidden"
														name="session_id"
														value="<?= $session->id ?>">

													<input
														type="hidden"
														name="registration_id"
														value="<?= $registration->id ?>">

													<input
														type="hidden"
														name="status"
														value="absent">

													<button
														type="submit"
														class="dropdown-item text-danger"
														onclick="return confirm('Yakin ingin menandai peserta ini sebagai ALFA?')">

														<i class="fas fa-times-circle mr-2"></i>

														Alfa

													</button>

												</form>

											</div>

										</div>

									</td>

								</tr>

							<?php endforeach; ?>

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>
		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Control Panel

					</h6>

				</div>

				<div class="card-body">

					<div class="mb-3">

						<small class="text-muted d-block">

							Status Sesi

						</small>

						<?php if ($session->isActive()): ?>

							<span class="badge badge-success px-3 py-2">

                        Sedang Dibuka

                    </span>

						<?php elseif ($session->isClosed()): ?>

							<span class="badge badge-secondary px-3 py-2">

                        Sudah Ditutup

                    </span>

						<?php else: ?>

							<span class="badge badge-warning px-3 py-2">

                        Berakhir

                    </span>

						<?php endif; ?>

					</div>

					<table class="table table-borderless table-sm">

						<tr>

							<th width="120">

								Metode

							</th>

							<td>

								<?= e(ucfirst($session->attendance_type)) ?>

							</td>

						</tr>

						<tr>

							<th>

								Dibuka

							</th>

							<td>

								<?= $session->opened_at?->format('d M Y H:i') ?: '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Berakhir

							</th>

							<td>

								<?= $session->expired_at?->format('d M Y H:i') ?: '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Radius

							</th>

							<td>

								<?= e($session->getRadiusLabel()) ?>

							</td>

						</tr>
						<?php if($session->isManual() || $session->isHybrid()): ?>

							<tr>
								<th>
									Kode Absensi
								</th>

								<td>

									<strong class="text-primary"
											style="font-size:20px;letter-spacing:3px">

										<?= e($session->attendance_code ?? '-') ?>

									</strong>

								</td>
							</tr>

						<?php endif; ?>
						<tr>

							<th>

								Token

							</th>

							<td>

								<code><?= e($session->qr_token) ?></code>

							</td>

						</tr>

					</table>

					<hr>

					<?php if ($session->isActive()): ?>

						<a
							href="<?= url('/pelatih/attendances/qrcode?session=' . $session->id) ?>"
							class="btn btn-primary btn-block mb-2">

							<i class="fas fa-qrcode mr-2"></i>

							Tampilkan QR Code

						</a>

						<a
							href="<?= url('/pelatih/attendances/refresh?session=' . $session->id) ?>"
							class="btn btn-info btn-block mb-2">

							<i class="fas fa-sync-alt mr-2"></i>

							Refresh QR Token

						</a>

						<form
							action="<?= url('/pelatih/attendances/close') ?>"
							method="post">

							<input
								type="hidden"
								name="session_id"
								value="<?= $session->id ?>">

							<button
								class="btn btn-danger btn-block">

								<i class="fas fa-door-closed mr-2"></i>

								Tutup Absensi

							</button>

						</form>

					<?php else: ?>

						<a
							href="<?= url('/pelatih/schedules/show?id=' . $schedule->id) ?>"
							class="btn btn-outline-primary btn-block">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali ke Jadwal

						</a>

					<?php endif; ?>

				</div>

			</div>

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Statistik

					</h6>

				</div>

				<div class="card-body">

					<div class="mb-3">

						<small class="text-muted">

							Hadir

						</small>

						<div class="progress">

							<div
								class="progress-bar bg-success"
								style="width: <?= $participantCount ? (($presentCount + $lateCount) / $participantCount) * 100 : 0 ?>%">

							</div>

						</div>

					</div>

					<div class="mb-3">

						<small class="text-muted">

							Izin

						</small>

						<div class="progress">

							<div
								class="progress-bar bg-info"
								style="width: <?= $participantCount ? ($permissionCount / $participantCount) * 100 : 0 ?>%">

							</div>

						</div>

					</div>

					<div>

						<small class="text-muted">

							Belum Hadir

						</small>

						<div class="progress">

							<div
								class="progress-bar bg-danger"
								style="width: <?= $participantCount ? ($absentCount / $participantCount) * 100 : 0 ?>%">

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="card shadow">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Quick Action

					</h6>

				</div>

				<div class="card-body">

					<a
						href="<?= url('/pelatih/schedules/show?id=' . $schedule->id) ?>"
						class="btn btn-outline-secondary btn-block mb-2">

						<i class="fas fa-calendar mr-2"></i>

						Detail Jadwal

					</a>


					<a
						href="<?= url('/pelatih/scores?schedule=' . $schedule->id) ?>"
						class="btn btn-outline-success btn-block">

						<i class="fas fa-star mr-2"></i>

						Penilaian

					</a>

				</div>

			</div>

		</div>

	</div>


</div>
