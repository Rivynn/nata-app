<div class="container-fluid">

	<!-- Breadcrumb -->

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item active">

				Nilai Peserta

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-primary mb-2">

						Manajemen Nilai Peserta

					</h3>

					<p class="text-muted mb-0">

						Pilih pelatihan yang ingin Anda kelola nilainya.

					</p>

				</div>

				<div class="col-lg-4 text-lg-right">

					<i class="fas fa-award fa-4x text-gray-300"></i>

				</div>

			</div>

		</div>

	</div>

	<!-- Summary -->

	<div class="row mb-4">

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

						Total Pelatihan

					</div>

					<div class="h3 font-weight-bold">

						<?= $totalTrainings ?>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

						Total Peserta

					</div>

					<div class="h3 font-weight-bold">

						<?= $totalParticipants ?>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

						Sudah Dinilai

					</div>

					<div class="h3 font-weight-bold">

						<?= $scoredParticipants ?>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

						Belum Dinilai

					</div>

					<div class="h3 font-weight-bold">

						<?= $pendingParticipants ?>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Search -->

	<div class="card shadow mb-4">

		<div class="card-body">

			<input
				type="text"
				id="trainingSearch"
				class="form-control"
				placeholder="Cari pelatihan...">

		</div>

	</div>

	<!-- Training List -->

	<div class="row" id="trainingContainer">

		<?php foreach ($trainings as $training): ?>

			<div class="col-lg-6 mb-4 training-item">

				<div class="card shadow h-100 border-left-info">

					<div class="card-body">

						<div class="d-flex justify-content-between">

							<div>

								<h5 class="font-weight-bold text-primary mb-1">

									<?= e($training->name) ?>

								</h5>

								<p class="text-muted mb-2">

									<?= e($training->trainingField->name) ?>

								</p>

							</div>

							<div>

								<span class="badge badge-success">

									<?= $training->registrations->count() ?> Peserta

								</span>

							</div>

						</div>

						<hr>

						<div class="row text-center">

							<div class="col-4">

								<h5 class="font-weight-bold text-primary">

									<?= $training->registrations->count() ?>

								</h5>

								<small class="text-muted">

									Peserta

								</small>

							</div>

							<div class="col-4">

								<h5 class="font-weight-bold text-success">

									<?= $training->scores->count() ?>

								</h5>

								<small class="text-muted">

									Dinilai

								</small>

							</div>

							<div class="col-4">

								<h5 class="font-weight-bold text-danger">

									<?= $training->registrations->count() - $training->scores->count() ?>

								</h5>

								<small class="text-muted">

									Belum

								</small>

							</div>

						</div>

					</div>

					<div class="card-footer bg-white">

						<a
							href="<?= url('/pelatih/scores/show?id=' . $training->id) ?>"
							class="btn btn-primary btn-block">

							<i class="fas fa-users mr-2"></i>

							Kelola Nilai

						</a>

					</div>

				</div>

			</div>

		<?php endforeach; ?>

	</div>

</div>

<script>

	document
		.getElementById('trainingSearch')
		.addEventListener('keyup', function () {

			const keyword = this.value.toLowerCase();

			document
				.querySelectorAll('.training-item')
				.forEach(function (item) {

					item.style.display = item.innerText
						.toLowerCase()
						.includes(keyword)
						? ''
						: 'none';

				});

		});

</script>
