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

				Detail Nilai

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-9">

					<h3 class="font-weight-bold text-primary mb-2">

						<?= e($participant->user->name) ?>

					</h3>

					<p class="text-muted mb-1">

						<?= e($training->name) ?>

					</p>

					<p class="text-muted mb-0">

						<?= e($training->trainingField->name) ?>

					</p>

				</div>

				<div class="col-lg-3 text-right">

					<i class="fas fa-user-graduate fa-5x text-gray-300"></i>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header">

					<b>

						Informasi Peserta

					</b>

				</div>

				<div class="card-body">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="170">

								Nama

							</th>

							<td>

								<?= e($participant->user->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Nomor HP

							</th>

							<td>

								<?= e($participant->phone ?: '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Jenis Kelamin

							</th>

							<td>

								<?= e($participant->getGenderLabel()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Instansi

							</th>

							<td>

								<?= e($participant->institution ?: '-') ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header">

					<b>

						Informasi Pelatihan

					</b>

				</div>

				<div class="card-body">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="170">

								Pelatihan

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

								<?= e($training->trainingField->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Pelatih

							</th>

							<td>

								<?= e($score->trainer->user->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

								<?php if ($score->is_passed): ?>

									<span class="badge badge-success">

										Lulus

									</span>

								<?php else: ?>

									<span class="badge badge-danger">

										Tidak Lulus

									</span>

								<?php endif; ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>
	<!-- Nilai -->

	<div class="card shadow mb-4">

		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">

				Hasil Penilaian

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-md-3 mb-4">

					<div class="card border-left-primary shadow h-100">

						<div class="card-body text-center">

							<div class="text-xs text-uppercase text-primary font-weight-bold mb-2">

								Pengetahuan

							</div>

							<h2 class="font-weight-bold text-primary mb-3">

								<?= number_format($score->knowledge_score, 2) ?>

							</h2>

							<div class="progress">

								<div
									class="progress-bar bg-primary"
									style="width: <?= $score->knowledge_score ?>%;">

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="col-md-3 mb-4">

					<div class="card border-left-success shadow h-100">

						<div class="card-body text-center">

							<div class="text-xs text-uppercase text-success font-weight-bold mb-2">

								Keterampilan

							</div>

							<h2 class="font-weight-bold text-success mb-3">

								<?= number_format($score->skill_score, 2) ?>

							</h2>

							<div class="progress">

								<div
									class="progress-bar bg-success"
									style="width: <?= $score->skill_score ?>%;">

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="col-md-3 mb-4">

					<div class="card border-left-warning shadow h-100">

						<div class="card-body text-center">

							<div class="text-xs text-uppercase text-warning font-weight-bold mb-2">

								Sikap

							</div>

							<h2 class="font-weight-bold text-warning mb-3">

								<?= number_format($score->attitude_score, 2) ?>

							</h2>

							<div class="progress">

								<div
									class="progress-bar bg-warning"
									style="width: <?= $score->attitude_score ?>%;">

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="col-md-3 mb-4">

					<div class="card border-left-info shadow h-100">

						<div class="card-body text-center">

							<div class="text-xs text-uppercase text-info font-weight-bold mb-2">

								Nilai Akhir

							</div>

							<h1 class="font-weight-bold text-info mb-3">

								<?= number_format($score->final_score, 2) ?>

							</h1>

							<div class="progress">

								<div
									class="progress-bar bg-info"
									style="width: <?= $score->final_score ?>%;">

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<!-- Ringkasan -->

	<div class="row">

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Ringkasan Penilaian

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="220">

								Persentase Kehadiran

							</th>

							<td>

								<span class="badge badge-success">

									<?= number_format($score->attendance_percentage, 2) ?>%

								</span>

							</td>

						</tr>

						<tr>

							<th>

								Predikat

							</th>

							<td>

								<span class="badge badge-info px-3 py-2">

									<?= e($score->predicate) ?>

								</span>

							</td>

						</tr>

						<tr>

							<th>

								Status Kelulusan

							</th>

							<td>

								<?php if ($score->is_passed): ?>

									<span class="badge badge-success px-3 py-2">

										<i class="fas fa-check-circle mr-1"></i>

										Lulus

									</span>

								<?php else: ?>

									<span class="badge badge-danger px-3 py-2">

										<i class="fas fa-times-circle mr-1"></i>

										Tidak Lulus

									</span>

								<?php endif; ?>

							</td>

						</tr>

						<tr>

							<th>

								Dipublikasikan

							</th>

							<td>

								<?= $score->published_at ?: '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Dinilai Oleh

							</th>

							<td>

								<?= e($score->trainer->user->name) ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

		<div class="col-lg-6">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Catatan Pelatih

					</h6>

				</div>

				<div class="card-body">

					<?php if (!empty($score->notes)): ?>

						<div class="alert alert-light border mb-0">

							<?= nl2br(e($score->notes)) ?>

						</div>

					<?php else: ?>

						<div class="text-center py-5">

							<i class="fas fa-sticky-note fa-3x text-gray-300 mb-3"></i>

							<p class="text-muted mb-0">

								Tidak ada catatan dari pelatih.

							</p>

						</div>

					<?php endif; ?>

				</div>

			</div>

		</div>

	</div>
	<!-- Metadata -->

	<div class="card shadow mb-4">

		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">

				Informasi Data

			</h6>

		</div>

		<div class="card-body">

			<div class="row">

				<div class="col-md-6">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="180">

								ID Nilai

							</th>

							<td>

								#<?= $score->id ?>

							</td>

						</tr>

						<tr>

							<th>

								Registration ID

							</th>

							<td>

								#<?= $registration->id ?>

							</td>

						</tr>

						<tr>

							<th>

								Dibuat

							</th>

							<td>

								<?= $score->created_at ?>

							</td>

						</tr>

						<tr>

							<th>

								Terakhir Diubah

							</th>

							<td>

								<?= $score->updated_at ?>

							</td>

						</tr>

					</table>

				</div>

				<div class="col-md-6">

					<div class="alert alert-info mb-0">

						<h6 class="font-weight-bold">

							Informasi

						</h6>

						<ul class="mb-0 pl-3">

							<li>
								Data ini merupakan hasil penilaian resmi pelatih.
							</li>

							<li>
								Nilai dapat diperbarui melalui menu <b>Edit Nilai</b>.
							</li>

							<li>
								Seluruh perubahan akan tersimpan pada sistem.
							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Footer Action -->

	<div class="card shadow">

		<div class="card-body d-flex justify-content-between align-items-center">

			<div>

				<a
					href="<?= url('/pelatih/scores/show?id=' . $training->id) ?>"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left mr-2"></i>

					Kembali

				</a>

			</div>

			<div>

				<a
					href="<?= url('/pelatih/scores/edit?id=' . $score->id) ?>"
					class="btn btn-warning">

					<i class="fas fa-edit mr-2"></i>

					Edit Nilai

				</a>

			</div>

		</div>

	</div>

</div>
