<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<h4 class="font-weight-bold text-primary mb-1">

				Laporan

			</h4>

			<p class="text-muted mb-0">

				Pilih jenis laporan yang ingin ditampilkan atau dicetak.

			</p>

		</div>

	</div>

	<div class="row">

		<?php foreach ($reports as $report): ?>

			<div class="col-xl-3 col-md-6 mb-4">

				<div class="card shadow border-left-<?= $report['color'] ?> h-100">

					<div class="card-body">

						<div class="d-flex justify-content-between align-items-start mb-3">

							<div>

								<h5 class="font-weight-bold mb-2">

									<?= $report['title'] ?>

								</h5>

								<p class="text-muted small mb-0">

									<?= $report['description'] ?>

								</p>

							</div>

							<div class="text-<?= $report['color'] ?>">

								<i class="<?= $report['icon'] ?> fa-2x"></i>

							</div>

						</div>

						<a
							href="<?= $report['url'] ?>"
							class="btn btn-<?= $report['color'] ?> btn-block">

							<i class="fas fa-arrow-right mr-2"></i>

							Buka Laporan

						</a>

					</div>

				</div>

			</div>

		<?php endforeach; ?>

	</div>

</div>
