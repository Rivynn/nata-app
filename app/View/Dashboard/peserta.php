<div class="container-fluid">

	<!-- Welcome -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<h3 class="font-weight-bold text-primary">

				Halo, <?= explode(' ', user()['name'])[0] ?> 👋

			</h3>

			<p class="text-muted mb-4">

				Selamat datang di
				<strong><?= app_name() ?></strong>.
				Silakan pilih pelatihan sesuai minat dan pantau status pendaftaran Anda.

			</p>

			<a
				href="<?= url('/peserta/registrations') ?>"
				class="btn btn-primary mr-2">

				<i class="fas fa-plus-circle mr-2"></i>

				Daftar Pelatihan

			</a>

			<a
				href="<?= url('/peserta/status') ?>"
				class="btn btn-outline-primary">

				<i class="fas fa-info-circle mr-2"></i>

				Lihat Status

			</a>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-lg-3 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="text-xs text-primary text-uppercase">

						Total Pelatihan

					</div>

					<div class="h3 font-weight-bold">

						15

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="text-xs text-warning text-uppercase">

						Menunggu

					</div>

					<div class="h3 font-weight-bold">

						1

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="text-xs text-success text-uppercase">

						Disetujui

					</div>

					<div class="h3 font-weight-bold">

						2

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="text-xs text-info text-uppercase">

						Sertifikat

					</div>

					<div class="h3 font-weight-bold">

						1

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Pelatihan -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				Kategori Pelatihan

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-lg-4 mb-4">

					<div class="card h-100 border-0 shadow-sm">

						<div class="card-body text-center">

							<i class="fas fa-laptop fa-3x text-primary mb-3"></i>

							<h5 class="font-weight-bold">

								Komputer

							</h5>

							<p class="text-muted">

								Microsoft Office, Web, Desain Grafis.

							</p>

							<a
								href="<?= url('/peserta/registrations') ?>"
								class="btn btn-primary btn-sm">

								Daftar

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 mb-4">

					<div class="card h-100 border-0 shadow-sm">

						<div class="card-body text-center">

							<i class="fas fa-truck-moving fa-3x text-success mb-3"></i>

							<h5 class="font-weight-bold">

								Alat Berat

							</h5>

							<p class="text-muted">

								Forklift, Excavator dan Operator.

							</p>

							<a
								href="<?= url('/peserta/registrations') ?>"
								class="btn btn-success btn-sm">

								Daftar

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 mb-4">

					<div class="card h-100 border-0 shadow-sm">

						<div class="card-body text-center">

							<i class="fas fa-user-shield fa-3x text-warning mb-3"></i>

							<h5 class="font-weight-bold">

								Security

							</h5>

							<p class="text-muted">

								Pelatihan Satpam dan Gada Pratama.

							</p>

							<a
								href="<?= url('/peserta/registrations') ?>"
								class="btn btn-warning btn-sm">

								Daftar

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>