<div class="container-fluid">

	<!-- Welcome -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col">

					<h3 class="font-weight-bold text-primary mb-2">

						Halo, <?= explode(' ', user()['name'])[0] ?> 👋

					</h3>

					<p class="text-muted mb-0">

						Selamat datang di
						<strong><?= app_name() ?></strong>.

						Kelola proses verifikasi peserta pelatihan tenaga kerja secara cepat dan terintegrasi.

					</p>

				</div>

				<div class="col-auto d-none d-lg-block">

					<i class="fas fa-user-tie fa-4x text-gray-300"></i>

				</div>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

								Menunggu Verifikasi

							</div>

							<div class="h2 font-weight-bold">

								<?= $pending ?? 0 ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-hourglass-half fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Disetujui

							</div>

							<div class="h2 font-weight-bold">

								<?= $approved ?? 0 ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

								Ditolak

							</div>

							<div class="h2 font-weight-bold">

								<?= $rejected ?? 0 ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-times-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Total Peserta

							</div>

							<div class="h2 font-weight-bold">

								<?= $participants ?? 0 ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Menu Cepat -->

	<div class="row">

		<div class="col-lg-8">

			<div class="card shadow border-0 h-100">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary m-0">

						Menu Cepat

					</h6>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-3">

							<a
								href="<?= url('/pegawai/verifications') ?>"
								class="text-decoration-none">

								<div class="card border-left-success shadow-sm">

									<div class="card-body">

										<div class="d-flex justify-content-between align-items-center">

											<div>

												<h5 class="font-weight-bold mb-1">

													Verifikasi Peserta

												</h5>

												<small class="text-muted">

													Approve atau tolak pendaftaran.

												</small>

											</div>

											<i class="fas fa-user-check fa-2x text-success"></i>

										</div>

									</div>

								</div>

							</a>

						</div>

						<div class="col-md-6 mb-3">

							<a
								href="<?= url('/pegawai/participants') ?>"
								class="text-decoration-none">

								<div class="card border-left-primary shadow-sm">

									<div class="card-body">

										<div class="d-flex justify-content-between align-items-center">

											<div>

												<h5 class="font-weight-bold mb-1">

													Data Peserta

												</h5>

												<small class="text-muted">

													Lihat seluruh data peserta.

												</small>

											</div>

											<i class="fas fa-users fa-2x text-primary"></i>

										</div>

									</div>

								</div>

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Aktivitas -->

		<div class="col-lg-4">

			<div class="card shadow border-0 h-100">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary m-0">

						Aktivitas Hari Ini

					</h6>

				</div>

				<div class="card-body">

					<div class="small text-muted mb-2">

						<i class="fas fa-circle text-warning mr-2"></i>

						<?= $pending ?? 0 ?> peserta menunggu verifikasi.

					</div>

					<div class="small text-muted mb-2">

						<i class="fas fa-circle text-success mr-2"></i>

						<?= $approvedToday ?? 0 ?> peserta disetujui hari ini.

					</div>

					<div class="small text-muted">

						<i class="fas fa-circle text-danger mr-2"></i>

						<?= $rejectedToday ?? 0 ?> peserta ditolak hari ini.

					</div>

				</div>

			</div>

		</div>

	</div>

</div>