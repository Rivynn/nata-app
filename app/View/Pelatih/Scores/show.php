<div class="container-fluid">

	<!-- Breadcrumb -->

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">
				<a href="<?= url('/pelatih') ?>">
					Dashboard
				</a>
			</li>

			<li class="breadcrumb-item">
				<a href="<?= url('/pelatih/scores') ?>">
					Nilai Peserta
				</a>
			</li>

			<li class="breadcrumb-item active">
				<?= e($training->name) ?>
			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-primary mb-2">

						<?= e($training->name) ?>

					</h3>

					<p class="mb-1 text-muted">

						Bidang Pelatihan :
						<strong><?= e($training->trainingField->name) ?></strong>

					</p>

					<p class="mb-0 text-muted">

						Kelola nilai seluruh peserta pada pelatihan ini.

					</p>

				</div>

				<div class="col-lg-4 text-right">

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

					<div class="text-xs font-weight-bold text-primary text-uppercase mb-2">

						Total Peserta

					</div>

					<div class="h3 font-weight-bold">

						<?= $totalParticipants ?>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-success text-uppercase mb-2">

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

					<div class="text-xs font-weight-bold text-danger text-uppercase mb-2">

						Belum Dinilai

					</div>

					<div class="h3 font-weight-bold">

						<?= $pendingParticipants ?>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="text-xs font-weight-bold text-info text-uppercase mb-2">

						Progress

					</div>

					<div class="progress mb-2">

						<div
							class="progress-bar bg-success"
							style="width: <?= $totalParticipants > 0 ? round(($scoredParticipants / $totalParticipants) * 100) : 0 ?>%;">

						</div>

					</div>

					<strong>

						<?= $totalParticipants > 0 ? round(($scoredParticipants / $totalParticipants) * 100) : 0 ?>%

					</strong>

				</div>

			</div>

		</div>

	</div>

	<!-- Search -->

	<div class="card shadow mb-4">

		<div class="card-body">

			<input
				type="text"
				id="participantSearch"
				class="form-control"
				placeholder="Cari peserta...">

		</div>

	</div>
	<!-- Participants -->

	<div class="card shadow mb-4">

		<div class="card-header py-3 d-flex justify-content-between align-items-center">

			<h6 class="m-0 font-weight-bold text-primary">

				Daftar Peserta

			</h6>

			<span class="badge badge-primary">

				<?= count($registrations) ?> Peserta

			</span>

		</div>

		<div class="card-body p-0">

			<?php if (count($registrations)): ?>

			<div class="table-responsive">

				<table class="table table-hover mb-0">

					<thead class="thead-light">

					<tr>

						<th width="60">

							#

						</th>

						<th>

							Peserta

						</th>

						<th>

							Instansi

						</th>

						<th width="130">

							Status

						</th>

						<th width="120">

							Nilai Akhir

						</th>

						<th width="120">

							Predikat

						</th>

						<th width="180" class="text-center">

							Aksi

						</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach ($registrations as $index => $registration): ?>

					<?php

						$participant = $registration->participant;

						$user = $participant->user;

						$score = $registration->score;

					?>

					<tr class="participant-item">

						<td>

							<?= $index + 1 ?>

						</td>

						<td>

							<div class="font-weight-bold">

								<?= e($user->name) ?>

							</div>

							<div class="small text-muted">

								<?= e($participant->phone ?: '-') ?>

							</div>

						</td>

						<td>

							<?= e($participant->institution ?: '-') ?>

						</td>

						<td>

							<?php if ($score): ?>

								<span class="badge badge-success">

												Sudah Dinilai

											</span>

							<?php else: ?>

								<span class="badge badge-warning">

												Belum Dinilai

											</span>

							<?php endif; ?>

						</td>

						<td>

							<?php if ($score): ?>

								<strong>

									<?= number_format($score->final_score, 2) ?>

								</strong>

							<?php else: ?>

								-

							<?php endif; ?>

						</td>

						<td>

							<?php if ($score): ?>

								<?= e($score->predicate) ?>

							<?php else: ?>

								-

							<?php endif; ?>

						</td>

						<td class="text-center">

							<?php if ($score): ?>

								<div class="btn-group" role="group">

									<a
										href="<?= url('/pelatih/scores/detail?id=' . $score->id) ?>"
										class="btn btn-sm btn-info"
										title="Lihat Detail">

										<i class="fas fa-eye"></i>

										Detail

									</a>

									<a
										href="<?= url('/pelatih/scores/edit?id=' . $score->id) ?>"
										class="btn btn-sm btn-warning"
										title="Edit Nilai">

										<i class="fas fa-edit"></i>

										Edit

									</a>

								</div>

							<?php else: ?>

								<a
									href="<?= url('/pelatih/scores/create?id=' . $registration->id) ?>"
									class="btn btn-sm btn-primary">

									<i class="fas fa-plus-circle mr-1"></i>

									Input Nilai

								</a>

							<?php endif; ?>

						</td>

					</tr>

					<?php endforeach; ?>

					</tbody>

				</table>

			</div>

			<?php else: ?>

				<div class="text-center py-5">

					<i class="fas fa-users-slash fa-4x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold text-gray-600">

						Belum Ada Peserta

					</h5>

					<p class="text-muted mb-0">

						Pelatihan ini belum memiliki peserta yang terdaftar.

					</p>

				</div>

			<?php endif; ?>

		</div>

	</div>

</div>

<script>

	const searchInput = document.getElementById('participantSearch');

	searchInput.addEventListener('keyup', function () {

		const keyword = this.value.toLowerCase();

		document
			.querySelectorAll('.participant-item')
			.forEach(function (row) {

				const text = row.innerText.toLowerCase();

				row.style.display = text.includes(keyword)
					? ''
					: 'none';

			});

	});

</script>
