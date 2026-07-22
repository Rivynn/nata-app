<?php

	/**
	 * @var string $title
	 * @var \Natasya\NataApp\Model\Training $training
	 * @var int $participantCount
	 * @var int $meetingCount
	 * @var int $completedMeeting
	 * @var float|null $averageScore
	 * @var int $passedParticipant
	 * @var int $failedParticipant
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

			<li class="breadcrumb-item">
				<a href="<?= url('/pelatih/trainings') ?>">
					Pelatihan Saya
				</a>
			</li>

			<li class="breadcrumb-item active">
				Detail Pelatihan
			</li>

		</ol>

	</nav>

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-2">

						<?= e($training->name) ?>

					</h3>

					<p class="text-muted mb-1">

						<?= e($training->trainingField->name ?? '-') ?>

					</p>

					<span class="badge badge-success">

                        Aktif

                    </span>

				</div>

				<div>

					<a
						href="<?= url('/pelatih/attendances') ?>"
						class="btn btn-success">

						<i class="fas fa-user-check mr-1"></i>

						Absensi

					</a>

					<a
						href="<?= url('/pelatih/scores') ?>"
						class="btn btn-primary">

						<i class="fas fa-award mr-1"></i>

						Nilai

					</a>

				</div>

			</div>

		</div>

	</div>

	<div class="row mb-4">

		<div class="col-md-3">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body text-center">

					<h2 class="font-weight-bold text-primary">

						<?= $participantCount ?>

					</h2>

					<small class="text-muted">

						Peserta

					</small>

				</div>

			</div>

		</div>

		<div class="col-md-3">

			<div class="card border-left-info shadow h-100">

				<div class="card-body text-center">

					<h2 class="font-weight-bold text-info">

						<?= $meetingCount ?>

					</h2>

					<small class="text-muted">

						Pertemuan

					</small>

				</div>

			</div>

		</div>

		<div class="col-md-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body text-center">

					<h2 class="font-weight-bold text-success">

						<?= $passedParticipant ?>

					</h2>

					<small class="text-muted">

						Lulus

					</small>

				</div>

			</div>

		</div>

		<div class="col-md-3">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body text-center">

					<h2 class="font-weight-bold text-danger">

						<?= $failedParticipant ?>

					</h2>

					<small class="text-muted">

						Tidak Lulus

					</small>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Pelatihan

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless">

						<tr>

							<th width="220">

								Nama Pelatihan

							</th>

							<td>

								<?= e($training->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= e($training->trainingField->name ?? '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Total Peserta

							</th>

							<td>

								<?= $participantCount ?>

							</td>

						</tr>

						<tr>

							<th>

								Total Pertemuan

							</th>

							<td>

								<?= $meetingCount ?>

							</td>

						</tr>

						<tr>

							<th>

								Pertemuan Selesai

							</th>

							<td>

								<?= $completedMeeting ?>

							</td>

						</tr>

						<tr>

							<th>

								Rata-rata Nilai

							</th>

							<td>

								<?= $averageScore ?? '-' ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Progress Pelatihan

					</h6>

				</div>

				<div class="card-body">

					<?php

						$progress = $meetingCount > 0
							? round(($completedMeeting / $meetingCount) * 100)
							: 0;

					?>

					<h3 class="font-weight-bold text-primary">

						<?= $progress ?>%

					</h3>

					<div class="progress mb-3">

						<div
							class="progress-bar bg-success"
							style="width: <?= $progress ?>%">

						</div>

					</div>

					<p class="text-muted mb-0">

						<?= $completedMeeting ?>

						dari

						<?= $meetingCount ?>

						pertemuan telah selesai.

					</p>

				</div>

			</div>

			<div class="card shadow">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Aksi Cepat

					</h6>

				</div>

				<div class="list-group list-group-flush">

					<a
						href="<?= url('/pelatih/attendances?training=' . $training->id) ?>"
						class="list-group-item list-group-item-action">

						<i class="fas fa-user-check mr-2"></i>

						Kelola Absensi

					</a>

					<a
						href="<?= url('/pelatih/scores') ?>"
						class="list-group-item list-group-item-action">

						<i class="fas fa-award mr-2"></i>

						Kelola Nilai

					</a>

					<a
						href="<?= url('/pelatih/trainings') ?>"
						class="list-group-item list-group-item-action">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

</div>
