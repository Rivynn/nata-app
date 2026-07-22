<div class="container-fluid">

	<!-- ==========================================================
	| Header
	=========================================================== -->

	<div class="card shadow border-0 bg-gradient-primary text-white mb-4">

		<div class="card-body py-4">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h2 class="font-weight-bold mb-2">

						Halo,
						<?= explode(' ', user()->name)[0] ?> 👋

					</h2>

					<p class="mb-0 text-white-50">

						Selamat datang di
						<strong><?= app_name() ?></strong>.

						Kelola proses verifikasi peserta,
						pantau perkembangan pelatihan,
						serta lakukan validasi data secara cepat.

					</p>

				</div>

				<div class="col-lg-4 text-right d-none d-lg-block">

					<i class="fas fa-user-tie fa-5x text-white-50"></i>

				</div>

			</div>

		</div>

	</div>

	<!-- ==========================================================
	| Statistik
	=========================================================== -->

	<div class="row">

		<!-- Pending -->

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-warning text-uppercase mb-2">

								Pending

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $pending ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-hourglass-half fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Approved -->

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-2">

								Approved

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $approved ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Running -->

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-info text-uppercase mb-2">

								Running

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $running ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-play-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Completed -->

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-2">

								Completed

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $completed ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-medal fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- Rejected -->

		<div class="col-xl-4 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-danger text-uppercase mb-2">

								Rejected

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $rejected ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-times-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Peserta -->

		<div class="col-xl-4 mb-4">

			<div class="card border-left-secondary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">

								Total Peserta

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $participants ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Pelatihan -->

		<div class="col-xl-4 mb-4">

			<div class="card border-left-dark shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-dark text-uppercase mb-2">

								Total Pelatihan

							</div>

							<div class="h2 font-weight-bold mb-0">

								<?= $trainings ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-book fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Progress & Quick Menu
=========================================================== -->

	<div class="row">

		<!-- Progress -->

		<div class="col-lg-4 mb-4">

			<div class="card shadow border-0 h-100">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Progress Verifikasi

					</h6>

				</div>

				<div class="card-body">

					<h6 class="small font-weight-bold">

						Disetujui

						<span class="float-right">

                            <?= $approvedPercent ?>%

                        </span>

					</h6>

					<div class="progress mb-4">

						<div
							class="progress-bar bg-success"
							role="progressbar"
							style="width: <?= $approvedPercent ?>%">

						</div>

					</div>

					<h6 class="small font-weight-bold">

						Pending

						<span class="float-right">

                            <?= $pendingPercent ?>%

                        </span>

					</h6>

					<div class="progress mb-4">

						<div
							class="progress-bar bg-warning"
							role="progressbar"
							style="width: <?= $pendingPercent ?>%">

						</div>

					</div>

					<h6 class="small font-weight-bold">

						Ditolak

						<span class="float-right">

                            <?= $rejectedPercent ?>%

                        </span>

					</h6>

					<div class="progress">

						<div
							class="progress-bar bg-danger"
							role="progressbar"
							style="width: <?= $rejectedPercent ?>%">

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Quick Menu -->

		<div class="col-lg-8 mb-4">

			<div class="card shadow border-0 h-100">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Menu Cepat

					</h6>

				</div>

				<div class="card-body">

					<div class="row">

						<!-- Verifikasi -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/verifications') ?>"
								class="text-decoration-none">

								<div class="card border-left-success shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-user-check fa-2x text-success mb-3"></i>

										<h6 class="font-weight-bold">

											Verifikasi

										</h6>

										<small class="text-muted">

											Approve / Reject

										</small>

									</div>

								</div>

							</a>

						</div>

						<!-- Peserta -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/participants') ?>"
								class="text-decoration-none">

								<div class="card border-left-primary shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-users fa-2x text-primary mb-3"></i>

										<h6 class="font-weight-bold">

											Peserta

										</h6>

										<small class="text-muted">

											Data Peserta

										</small>

									</div>

								</div>

							</a>

						</div>

						<!-- Pelatihan -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/trainings') ?>"
								class="text-decoration-none">

								<div class="card border-left-info shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-book fa-2x text-info mb-3"></i>

										<h6 class="font-weight-bold">

											Pelatihan

										</h6>

										<small class="text-muted">

											Data Pelatihan

										</small>

									</div>

								</div>

							</a>

						</div>

						<!-- Pengumuman -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/announcements') ?>"
								class="text-decoration-none">

								<div class="card border-left-warning shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-bullhorn fa-2x text-warning mb-3"></i>

										<h6 class="font-weight-bold">

											Pengumuman

										</h6>

										<small class="text-muted">

											Informasi

										</small>

									</div>

								</div>

							</a>

						</div>

						<!-- Sertifikat -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/certificates') ?>"
								class="text-decoration-none">

								<div class="card border-left-success shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-award fa-2x text-success mb-3"></i>

										<h6 class="font-weight-bold">

											Sertifikat

										</h6>

										<small class="text-muted">

											Kelola Sertifikat

										</small>

									</div>

								</div>

							</a>

						</div>

						<!-- Laporan -->

						<div class="col-md-4 mb-3">

							<a
								href="<?= url('/pegawai/reports') ?>"
								class="text-decoration-none">

								<div class="card border-left-dark shadow-sm h-100">

									<div class="card-body text-center">

										<i class="fas fa-chart-bar fa-2x text-dark mb-3"></i>

										<h6 class="font-weight-bold">

											Laporan

										</h6>

										<small class="text-muted">

											Statistik

										</small>

									</div>

								</div>

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Registrasi Terbaru & Aktivitas
=========================================================== -->

	<div class="row">

		<!-- Registrasi Terbaru -->

		<div class="col-lg-8 mb-4">

			<div class="card shadow border-0">

				<div class="card-header bg-white d-flex justify-content-between align-items-center">

					<h6 class="font-weight-bold text-primary mb-0">

						Registrasi Terbaru

					</h6>

					<a
						href="<?= url('/pegawai/verifications') ?>"
						class="btn btn-sm btn-primary">

						Lihat Semua

					</a>

				</div>

				<div class="card-body p-0">

					<?php if($latestRegistrations->isEmpty()): ?>

						<div class="text-center py-5">

							<i class="fas fa-inbox fa-4x text-gray-300 mb-3"></i>

							<h5 class="font-weight-bold">

								Belum Ada Registrasi

							</h5>

							<p class="text-muted mb-0">

								Data registrasi peserta akan muncul di sini.

							</p>

						</div>

					<?php else: ?>

						<div class="table-responsive">

							<table class="table table-hover mb-0">

								<thead class="bg-light">

								<tr>

									<th>Peserta</th>

									<th>Pelatihan</th>

									<th>Status</th>

									<th>Tanggal</th>

								</tr>

								</thead>

								<tbody>

								<?php foreach($latestRegistrations as $registration): ?>

									<?php

									$badge = match ($registration->status) {

										'pending' => 'warning',

										'approved' => 'success',

										'running' => 'info',

										'completed' => 'primary',

										'rejected' => 'danger',

										default => 'secondary',

									};

									?>

									<tr>

										<td>

											<strong>

												<?= e(
													$registration
														->participant
														?->user
														?->name
													?? '-'
												) ?>

											</strong>

										</td>

										<td>

											<?= e($registration->training->name) ?>

										</td>

										<td>

                                            <span class="badge badge-<?= $badge ?>">

                                                <?= ucfirst($registration->status) ?>

                                            </span>

										</td>

										<td>

											<?= $registration->created_at?->format('d M Y') ?>

										</td>

									</tr>

								<?php endforeach; ?>

								</tbody>

							</table>

						</div>

					<?php endif; ?>

				</div>

			</div>

		</div>

		<!-- Sidebar -->

		<div class="col-lg-4">

			<!-- Aktivitas -->

			<div class="card shadow border-0 mb-4">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Aktivitas Hari Ini

					</h6>

				</div>

				<div class="card-body">

					<div class="mb-3">

						<i class="fas fa-circle text-warning mr-2"></i>

						<strong><?= $pendingToday ?></strong>

						pendaftaran baru menunggu verifikasi.

					</div>

					<div class="mb-3">

						<i class="fas fa-circle text-success mr-2"></i>

						<strong><?= $approvedToday ?></strong>

						peserta disetujui hari ini.

					</div>

					<div>

						<i class="fas fa-circle text-danger mr-2"></i>

						<strong><?= $rejectedToday ?></strong>

						peserta ditolak hari ini.

					</div>

				</div>

			</div>

			<!-- Ringkasan -->

			<div class="card shadow border-0">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Ringkasan Sistem

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="150">

								Total Registrasi

							</th>

							<td>

								<?= $totalRegistrations ?>

							</td>

						</tr>

						<tr>

							<th>

								Total Peserta

							</th>

							<td>

								<?= $participants ?>

							</td>

						</tr>

						<tr>

							<th>

								Total Pelatihan

							</th>

							<td>

								<?= $trainings ?>

							</td>

						</tr>

						<tr>

							<th>

								Status Pending

							</th>

							<td>

								<?= $pending ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Tips & Informasi Sistem
=========================================================== -->

	<div class="row">

		<!-- Tips -->

		<div class="col-lg-8 mb-4">

			<div class="card shadow border-0">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Tips Pegawai

					</h6>

				</div>

				<div class="card-body">

					<div class="media mb-4">

						<div class="mr-3">

							<i class="fas fa-lightbulb fa-2x text-warning"></i>

						</div>

						<div class="media-body">

							<h6 class="font-weight-bold">

								Verifikasi Tepat Waktu

							</h6>

							<p class="text-muted mb-0">

								Pastikan seluruh pendaftaran peserta diverifikasi
								sebelum jadwal pelatihan dimulai agar tidak
								menghambat proses administrasi.

							</p>

						</div>

					</div>

					<hr>

					<div class="media mb-4">

						<div class="mr-3">

							<i class="fas fa-user-check fa-2x text-success"></i>

						</div>

						<div class="media-body">

							<h6 class="font-weight-bold">

								Periksa Dokumen

							</h6>

							<p class="text-muted mb-0">

								Pastikan seluruh persyaratan peserta telah
								lengkap sebelum memberikan persetujuan.

							</p>

						</div>

					</div>

					<hr>

					<div class="media">

						<div class="mr-3">

							<i class="fas fa-shield-alt fa-2x text-primary"></i>

						</div>

						<div class="media-body">

							<h6 class="font-weight-bold">

								Jaga Validitas Data

							</h6>

							<p class="text-muted mb-0">

								Seluruh perubahan data peserta akan tercatat
								sebagai riwayat aktivitas sistem.

							</p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Informasi Sistem -->

		<div class="col-lg-4 mb-4">

			<div class="card shadow border-0">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Informasi Sistem

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="130">

								Aplikasi

							</th>

							<td>

								<?= app_name() ?>

							</td>

						</tr>

						<tr>

							<th>

								Versi

							</th>

							<td>

								<?= config('app.version') ?>

							</td>

						</tr>

						<tr>

							<th>

								Role

							</th>

							<td>

								Pegawai

							</td>

						</tr>

						<tr>

							<th>

								Login

							</th>

							<td>

								<?= user()->username ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

                                <span class="badge badge-success">

                                    Online

                                </span>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>

</div>
