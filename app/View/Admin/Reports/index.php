<div class="container-fluid">

	<style>

		.report-header{

			background:linear-gradient(135deg,#4e73df 0%,#224abe 100%);

			border-radius:18px;

			color:#fff;

			overflow:hidden;

			position:relative;

		}

		.report-header::before{

			content:'';

			position:absolute;

			right:-80px;

			top:-80px;

			width:250px;

			height:250px;

			border-radius:50%;

			background:rgba(255,255,255,.08);

		}

		.report-header::after{

			content:'';

			position:absolute;

			right:50px;

			bottom:-60px;

			width:140px;

			height:140px;

			border-radius:50%;

			background:rgba(255,255,255,.05);

		}

		.report-card{

			border:none;

			border-radius:18px;

			overflow:hidden;

			transition:.25s;

			position:relative;

		}

		.report-card:hover{

			transform:translateY(-8px);

			box-shadow:0 20px 45px rgba(0,0,0,.12);

		}

		.report-icon{

			width:74px;

			height:74px;

			border-radius:18px;

			display:flex;

			align-items:center;

			justify-content:center;

			color:#fff;

			font-size:30px;

			box-shadow:0 10px 25px rgba(0,0,0,.15);

		}

		.report-description{

			min-height:70px;

		}

		.report-footer{

			border-top:1px solid #edf2f7;

			padding-top:18px;

		}

		.report-badge{

			position:absolute;

			top:18px;

			right:18px;

			background:#f8f9fc;

			color:#858796;

			padding:6px 12px;

			border-radius:20px;

			font-size:11px;

			font-weight:600;

			text-transform:uppercase;

			letter-spacing:.5px;

		}

		.report-arrow{

			transition:.2s;

		}

		.report-card:hover .report-arrow{

			transform:translateX(6px);

		}

		.stats-card{

			border:none;

			border-radius:16px;

		}

	</style>

	<!-- Hero -->

	<div class="card shadow-lg border-0 report-header mb-4">

		<div class="card-body py-5 px-5">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h2 class="font-weight-bold mb-3">

						<i class="fas fa-chart-line mr-2"></i>

						Pusat Laporan

					</h2>

					<p class="mb-4 text-white-50">

						Akses seluruh laporan sistem pelatihan, lakukan pencarian data,
						cetak dokumen resmi, serta ekspor ke PDF maupun Excel
						dalam satu halaman.

					</p>

				</div>

				<div class="col-lg-4 text-lg-right mt-4 mt-lg-0">

					<div class="display-4 font-weight-bold">

						<?= count($reports) ?>

					</div>

					<div class="text-white-50">

						Jenis Laporan

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row mb-2">

		<div class="col-md-4 mb-4">

			<div class="card stats-card shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary text-uppercase font-weight-bold">

								Total Laporan

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count($reports) ?>

							</h2>

						</div>

						<i class="fas fa-file-alt fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-4 mb-4">

			<div class="card stats-card shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success text-uppercase font-weight-bold">

								Export

							</div>

							<h2 class="font-weight-bold mb-0">

								PDF / Excel

							</h2>

						</div>

						<i class="fas fa-file-export fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-4 mb-4">

			<div class="card stats-card shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-info text-uppercase font-weight-bold">

								Status

							</div>

							<h2 class="font-weight-bold mb-0">

								Aktif

							</h2>

						</div>

						<i class="fas fa-check-circle fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Report Cards -->

	<div class="row">

		<?php foreach($reports as $report): ?>

			<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

				<div class="card report-card shadow h-100">

					<span class="report-badge">

						Report

					</span>

					<div class="card-body d-flex flex-column">

						<div class="mb-4">

							<div class="report-icon bg-<?= $report['color'] ?>">

								<i class="<?= $report['icon'] ?>"></i>

							</div>

						</div>

						<h5 class="font-weight-bold">

							<?= $report['title'] ?>

						</h5>

						<p class="text-muted report-description">

							<?= $report['description'] ?>

						</p>

						<div class="mt-auto report-footer">

							<a
								href="<?= $report['url'] ?>"
								class="btn btn-outline-<?= $report['color'] ?> btn-block">

								<span>

									Buka Laporan

								</span>

								<i class="fas fa-arrow-right float-right mt-1 report-arrow"></i>

							</a>

						</div>

					</div>

				</div>

			</div>

		<?php endforeach; ?>

	</div>

</div>
