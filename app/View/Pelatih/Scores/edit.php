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

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/scores/detail?id=' . $score->id) ?>">

					Detail

				</a>

			</li>

			<li class="breadcrumb-item active">

				Edit Nilai

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-warning mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-warning">

						Edit Nilai Peserta

					</h3>

					<p class="text-muted mb-0">

						Perbarui hasil penilaian peserta pelatihan.

					</p>

				</div>

				<div class="col-lg-4 text-right">

					<i class="fas fa-edit fa-5x text-gray-300"></i>

				</div>

			</div>

		</div>

	</div>

	<form
		action="<?= url('/pelatih/scores/update') ?>"
		method="POST">

		<input
			type="hidden"
			name="id"
			value="<?= $score->id ?>">

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

									Instansi

								</th>

								<td>

									<?= e($participant->institution ?: '-') ?>

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

									<?= e($trainer->user->name) ?>

								</td>

							</tr>

						</table>

					</div>

				</div>

			</div>

		</div>
		<div class="card shadow mb-4">

			<div class="card-header py-3">

				<h6 class="m-0 font-weight-bold text-primary">

					Form Penilaian

				</h6>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>

								Nilai Pengetahuan

							</label>

							<input
								type="number"
								name="knowledge_score"
								class="form-control"
								min="0"
								max="100"
								step="0.01"
								value="<?= $score->knowledge_score ?>"
								required>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>

								Nilai Keterampilan

							</label>

							<input
								type="number"
								name="skill_score"
								class="form-control"
								min="0"
								max="100"
								step="0.01"
								value="<?= $score->skill_score ?>"
								required>

						</div>

					</div>

				</div>

				<div class="row">

					<div class="col-md-6">

						<div class="form-group">

							<label>

								Nilai Sikap

							</label>

							<input
								type="number"
								name="attitude_score"
								class="form-control"
								min="0"
								max="100"
								step="0.01"
								value="<?= $score->attitude_score ?>"
								required>

						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">

							<label>

								Persentase Kehadiran

							</label>

							<input
								type="number"
								name="attendance_percentage"
								class="form-control"
								min="0"
								max="100"
								step="0.01"
								value="<?= $score->attendance_percentage ?>"
								required>

						</div>

					</div>

				</div>

				<div class="form-group">

					<label>

						Catatan Pelatih

					</label>

					<textarea
						name="notes"
						rows="5"
						class="form-control"
						placeholder="Masukkan catatan atau evaluasi peserta..."><?= e($score->notes) ?></textarea>

				</div>

			</div>

		</div>
		<!-- Preview -->

		<div class="card shadow mb-4">

			<div class="card-header py-3">

				<h6 class="m-0 font-weight-bold text-primary">

					Preview Hasil Penilaian

				</h6>

			</div>

			<div class="card-body">

				<div class="row">

					<div class="col-md-4 text-center">

						<div class="text-muted small">

							Nilai Akhir

						</div>

						<h1
							id="previewFinalScore"
							class="font-weight-bold text-primary">

							<?= number_format($score->final_score, 2) ?>

						</h1>

					</div>

					<div class="col-md-4 text-center">

						<div class="text-muted small">

							Predikat

						</div>

						<h2
							id="previewPredicate"
							class="font-weight-bold text-info">

							<?= e($score->predicate) ?>

						</h2>

					</div>

					<div class="col-md-4 text-center">

						<div class="text-muted small">

							Status

						</div>

						<h3
							id="previewStatus"
							class="font-weight-bold <?= $score->is_passed ? 'text-success' : 'text-danger' ?>">

							<?= $score->is_passed ? 'LULUS' : 'TIDAK LULUS' ?>

						</h3>

					</div>

				</div>

			</div>

		</div>

		<!-- Action -->

		<div class="card shadow">

			<div class="card-body d-flex justify-content-between">

				<a
					href="<?= url('/pelatih/scores/detail?id=' . $score->id) ?>"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left mr-2"></i>

					Batal

				</a>

				<button
					type="submit"
					class="btn btn-warning">

					<i class="fas fa-save mr-2"></i>

					Simpan Perubahan

				</button>

			</div>

		</div>

	</form>

</div>

<script>

	function calculateScore() {

		const knowledge = parseFloat(document.querySelector('[name="knowledge_score"]').value) || 0;

		const skill = parseFloat(document.querySelector('[name="skill_score"]').value) || 0;

		const attitude = parseFloat(document.querySelector('[name="attitude_score"]').value) || 0;

		const finalScore = ((knowledge + skill + attitude) / 3);

		document.getElementById('previewFinalScore').innerText = finalScore.toFixed(2);

		let predicate = 'E';

		if (finalScore >= 90) {

			predicate = 'A';

		} else if (finalScore >= 80) {

			predicate = 'B';

		} else if (finalScore >= 70) {

			predicate = 'C';

		} else if (finalScore >= 60) {

			predicate = 'D';

		}

		document.getElementById('previewPredicate').innerText = predicate;

		const status = document.getElementById('previewStatus');

		if (finalScore >= 70) {

			status.innerText = 'LULUS';

			status.classList.remove('text-danger');

			status.classList.add('text-success');

		} else {

			status.innerText = 'TIDAK LULUS';

			status.classList.remove('text-success');

			status.classList.add('text-danger');

		}

	}

	document
		.querySelectorAll(
			'[name="knowledge_score"], [name="skill_score"], [name="attitude_score"]'
		)
		.forEach(function (input) {

			input.addEventListener('input', calculateScore);

		});

	calculateScore();

</script>
