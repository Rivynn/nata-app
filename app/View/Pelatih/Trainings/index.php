<?php

	/**
	 * @var string $title
	 * @var \Illuminate\Support\Collection|\Natasya\NataApp\Model\Training[] $trainings
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

			<li class="breadcrumb-item active">

				Pelatihan Saya

			</li>

		</ol>

	</nav>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h1 class="h3 mb-1 text-gray-800">

				<?= e($title) ?>

			</h1>

			<p class="text-muted mb-0">

				Daftar pelatihan yang Anda ampu sebagai pelatih.

			</p>

		</div>

	</div>
	<div class="card shadow-sm mb-4">
		<div class="card-body py-2">

			<div class="btn-group">

				<a
					href="<?= url('/pelatih/trainings?status=running') ?>"
					class="btn <?= $status === 'running' ? 'btn-primary' : 'btn-outline-primary' ?>">

					<i class="fas fa-play-circle mr-1"></i>
					Aktif

				</a>

				<a
					href="<?= url('/pelatih/trainings?status=completed') ?>"
					class="btn <?= $status === 'completed' ? 'btn-success' : 'btn-outline-success' ?>">

					<i class="fas fa-check-circle mr-1"></i>
					Selesai

				</a>

				<a
					href="<?= url('/pelatih/trainings?status=all') ?>"
					class="btn <?= $status === 'all' ? 'btn-secondary' : 'btn-outline-secondary' ?>">

					<i class="fas fa-list mr-1"></i>
					Semua

				</a>

			</div>

		</div>
	</div>
	<?php if ($trainings->isEmpty()): ?>

		<div class="card shadow">

			<div class="card-body text-center py-5">

				<i class="fas fa-chalkboard-teacher fa-4x text-gray-300 mb-3"></i>

				<h5 class="font-weight-bold">

					Belum Ada Pelatihan

				</h5>

				<p class="text-muted mb-0">

					Saat ini Anda belum ditugaskan pada pelatihan apa pun.

				</p>

			</div>

		</div>

	<?php else: ?>

		<div class="row">

			<?php foreach ($trainings as $training): ?>

				<div class="col-lg-6 mb-4">

					<div class="card shadow h-100 border-left-primary">

						<div class="card-body">

							<div class="d-flex justify-content-between">

								<div>

									<h5 class="font-weight-bold text-primary mb-2">

										<?= e($training->name) ?>

									</h5>

									<p class="text-muted mb-3">

										<?= e($training->trainingField->name ?? '-') ?>

									</p>

								</div>

								<span class="badge badge-success">

                                    Aktif

                                </span>

							</div>

							<div class="row text-center mb-4">

								<div class="col">

									<h4 class="font-weight-bold text-primary">

										<?= $training->schedules->count() ?>

									</h4>

									<small class="text-muted">

										Pertemuan

									</small>

								</div>

								<div class="col">

									<h4 class="font-weight-bold text-success">

										<?= $training->registrations->count() ?>

									</h4>

									<small class="text-muted">

										Peserta

									</small>

								</div>

							</div>

						</div>

						<div class="card-footer bg-white">

							<div class="btn-group btn-block">

								<a
									href="<?= url('/pelatih/trainings/show?id=' . $training->id) ?>"
									class="btn btn-outline-primary">

									<i class="fas fa-eye mr-1"></i>

									Detail

								</a>

								<a
									href="<?= url('/pelatih/attendances?training=' . $training->id) ?>"
									class="btn btn-primary">

									<i class="fas fa-user-check mr-1"></i>

									Absensi

								</a>

							</div>

						</div>

					</div>

				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</div>
