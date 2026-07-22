<div class="container-fluid">

	<!-- Hero -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

                    <span class="badge badge-primary px-3 py-2 mb-3">

                        Administrator Dashboard

                    </span>

					<h2 class="font-weight-bold text-gray-800 mb-2">

						Halo, <?= e(user()->name) ?> 👋

					</h2>

					<p class="text-muted mb-4">

						Selamat datang di
						<strong><?= app_name() ?></strong>.
						Kelola seluruh data pelatihan, peserta, pelatih dan laporan melalui satu dashboard.

					</p>

					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-primary">

						<i class="fas fa-book mr-2"></i>

						Kelola Pelatihan

					</a>

					<a
						href="<?= url('/admin/reports') ?>"
						class="btn btn-outline-primary ml-2">

						<i class="fas fa-chart-bar mr-2"></i>

						Laporan

					</a>

				</div>

				<div class="col-lg-4">

					<div class="card border-left-primary shadow-sm">

						<div class="card-body">

							<small class="text-muted">

								Hari Ini

							</small>

							<h4 class="font-weight-bold mb-3">

								<?= date('d M Y') ?>

							</h4>

							<div class="small text-muted">

								Sistem Monitoring Pelatihan Tenaga Kerja

							</div>

							<hr>

							<div class="d-flex justify-content-between">

								<span>Status Sistem</span>

								<span class="badge badge-success">

                                    Online

                                </span>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-primary h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total User

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $totalUsers ?>

							</h2>

						</div>

						<i class="fas fa-users fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-success h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Pegawai

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $totalEmployees ?>

							</h2>

						</div>

						<i class="fas fa-id-card fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-info h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-info font-weight-bold text-uppercase">

								Peserta

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $totalParticipants ?>

							</h2>

						</div>

						<i class="fas fa-user-graduate fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-warning h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Total Pelatihan

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $totalTrainings ?>

							</h2>

						</div>

						<i class="fas fa-book fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-primary h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Pelatihan Aktif

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $activeTrainings ?>

							</h2>

						</div>

						<i class="fas fa-play-circle fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card shadow border-left-secondary h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-secondary font-weight-bold text-uppercase">

								Pelatihan Selesai

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $completedTrainings ?>

							</h2>

						</div>

						<i class="fas fa-check-circle fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>
	<!-- Quick Access -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<h5 class="m-0 font-weight-bold text-primary">

				<i class="fas fa-bolt mr-2"></i>

				Menu Cepat

			</h5>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-primary shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-users fa-3x text-primary mb-3"></i>

							<h5 class="font-weight-bold">

								Kelola User

							</h5>

							<p class="text-muted mb-4">

								Tambah, ubah dan kelola akun pengguna sistem.

							</p>

							<a
								href="<?= url('/admin/users') ?>"
								class="btn btn-primary btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-success shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-user-graduate fa-3x text-success mb-3"></i>

							<h5 class="font-weight-bold">

								Peserta

							</h5>

							<p class="text-muted mb-4">

								Kelola seluruh data peserta pelatihan.

							</p>

							<a
								href="<?= url('/admin/participants') ?>"
								class="btn btn-success btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-info shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-chalkboard-teacher fa-3x text-info mb-3"></i>

							<h5 class="font-weight-bold">

								Pelatih

							</h5>

							<p class="text-muted mb-4">

								Kelola data pelatih dan kompetensi.

							</p>

							<a
								href="<?= url('/admin/trainers') ?>"
								class="btn btn-info btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-warning shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-book fa-3x text-warning mb-3"></i>

							<h5 class="font-weight-bold">

								Pelatihan

							</h5>

							<p class="text-muted mb-4">

								Kelola seluruh kegiatan pelatihan.

							</p>

							<a
								href="<?= url('/admin/trainings') ?>"
								class="btn btn-warning btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-danger shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-award fa-3x text-danger mb-3"></i>

							<h5 class="font-weight-bold">

								Sertifikat

							</h5>

							<p class="text-muted mb-4">

								Kelola sertifikat hasil pelatihan.

							</p>

							<a
								href="<?= url('/admin/certificates') ?>"
								class="btn btn-danger btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-4 col-md-6 mb-4">

					<div class="card border-left-secondary shadow-sm h-100">

						<div class="card-body text-center">

							<i class="fas fa-chart-bar fa-3x text-secondary mb-3"></i>

							<h5 class="font-weight-bold">

								Laporan

							</h5>

							<p class="text-muted mb-4">

								Lihat laporan dan statistik pelatihan.

							</p>

							<a
								href="<?= url('/admin/reports') ?>"
								class="btn btn-secondary btn-sm btn-block">

								Buka Modul

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-8 mb-4">

			<div class="card shadow border-0">

				<div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

					<h5 class="m-0 font-weight-bold text-primary">

						<i class="fas fa-book-open mr-2"></i>

						Pelatihan Terbaru

					</h5>

					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-outline-primary btn-sm">

						Lihat Semua

					</a>

				</div>

				<div class="table-responsive">

					<table class="table table-hover mb-0">

						<thead class="thead-light">

						<tr>

							<th>Pelatihan</th>

							<th>Bidang</th>

							<th>Pelatih</th>

							<th>Status</th>

						</tr>

						</thead>

						<tbody>

						<?php if ($recentTrainings->isEmpty()): ?>

							<tr>

								<td colspan="4" class="text-center py-5 text-muted">

									Belum ada data pelatihan.

								</td>

							</tr>

						<?php else: ?>

							<?php foreach ($recentTrainings as $training): ?>

								<tr>

									<td>

										<strong>

											<?= e($training->name) ?>

										</strong>

									</td>

									<td>

										<?= e($training->trainingField->name ?? '-') ?>

									</td>

									<td>

										<?= e($training->trainer->user->name ?? '-') ?>

									</td>

									<td>

										<?php if ($training->status === 'active'): ?>

											<span class="badge badge-success">

                                                Aktif

                                            </span>

										<?php else: ?>

											<span class="badge badge-secondary">

                                                Selesai

                                            </span>

										<?php endif; ?>

									</td>

								</tr>

							<?php endforeach; ?>

						<?php endif; ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>
		<div class="col-lg-4 mb-4">

			<div class="card shadow border-0 mb-4">

				<div class="card-header bg-white py-3">

					<h5 class="m-0 font-weight-bold text-primary">

						<i class="fas fa-server mr-2"></i>

						Ringkasan Sistem

					</h5>

				</div>

				<div class="card-body">

					<div class="d-flex justify-content-between mb-3">

						<span>Total User</span>

						<strong><?= $totalUsers ?></strong>

					</div>

					<div class="d-flex justify-content-between mb-3">

						<span>Pegawai</span>

						<strong><?= $totalEmployees ?></strong>

					</div>

					<div class="d-flex justify-content-between mb-3">

						<span>Peserta</span>

						<strong><?= $totalParticipants ?></strong>

					</div>

					<div class="d-flex justify-content-between mb-3">

						<span>Total Pelatihan</span>

						<strong><?= $totalTrainings ?></strong>

					</div>

					<div class="d-flex justify-content-between mb-3">

						<span>Pelatihan Aktif</span>

						<span class="badge badge-success">

                            <?= $activeTrainings ?>

                        </span>

					</div>

					<div class="d-flex justify-content-between">

						<span>Pelatihan Selesai</span>

						<span class="badge badge-secondary">

                            <?= $completedTrainings ?>

                        </span>

					</div>

				</div>

			</div>

			<div class="card shadow border-0">

				<div class="card-header bg-white py-3">

					<h5 class="m-0 font-weight-bold text-primary">

						<i class="fas fa-lightbulb mr-2"></i>

						Informasi

					</h5>

				</div>

				<div class="card-body">

					<div class="alert alert-primary mb-3">

						<strong>

							Dashboard Administrator

						</strong>

						<br>

						Seluruh data master dan transaksi pelatihan dikelola melalui halaman ini.

					</div>

					<ul class="pl-3 mb-0">

						<li class="mb-2">

							Kelola User dan Hak Akses.

						</li>

						<li class="mb-2">

							Kelola Pelatih serta Peserta.

						</li>

						<li class="mb-2">

							Monitoring Pelatihan.

						</li>

						<li class="mb-2">

							Monitoring Sertifikat.

						</li>

						<li>

							Cetak Laporan Pelatihan.

						</li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<style>

		.card{

			border-radius:12px;

		}

		.card-header{

			border-bottom:1px solid #eef2f7;

		}

		.card .btn{

			border-radius:8px;

		}

		.card.shadow{

			transition:.25s ease;

		}

		.card.shadow:hover{

			transform:translateY(-4px);

			box-shadow:0 .75rem 1.5rem rgba(58,59,69,.15)!important;

		}

		.table tbody tr{

			transition:.2s;

		}

		.table tbody tr:hover{

			background:#f8f9fc;

		}

		.badge{

			font-size:11px;

			padding:.45rem .65rem;

		}

		.alert{

			border-radius:10px;

		}

	</style>

</div>
