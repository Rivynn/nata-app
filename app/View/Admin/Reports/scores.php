<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Penilaian Peserta

					</h4>


					<p class="text-muted mb-0">

						Rekap hasil penilaian peserta pelatihan.

					</p>


				</div>





				<a
					href="<?= url('/admin/reports/scores/print?' . http_build_query($filters ?? [])) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak


				</a>


			</div>


		</div>


	</div>





	<?php


		$totalScore = $scores->count();


		$totalPassed = $scores->where('is_passed', true)->count();


		$totalFailed = $scores->where('is_passed', false)->count();


		$totalAverage = $scores->avg('final_score') ?? 0;


	?>





	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-primary text-uppercase">

						Total Penilaian

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalScore ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-success shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-success text-uppercase">

						Lulus

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalPassed ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-danger shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-danger text-uppercase">

						Tidak Lulus

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalFailed ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-info shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-info text-uppercase">

						Rata-rata Nilai

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= number_format($totalAverage,2) ?>

					</h2>


				</div>


			</div>


		</div>


	</div>





	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>

				Filter Penilaian


			</h5>


		</div>





		<div class="card-body">


			<form
				method="GET"
				action="<?= url('/admin/reports/scores') ?>">



				<div class="row">



					<div class="col-md-4">


						<div class="form-group">


							<label>

								Pencarian Peserta

							</label>


							<input
								type="text"
								name="keyword"
								class="form-control"
								placeholder="Nama / Email peserta"
								value="<?= $filters['keyword'] ?? '' ?>">


						</div>


					</div>





					<div class="col-md-4">


						<div class="form-group">


							<label>

								Bidang Pelatihan

							</label>


							<select
								name="field"
								class="form-control">


								<option value="">

									Semua Bidang

								</option>


								<?php foreach($fields as $field): ?>


									<option
										value="<?= $field->id ?>"
										<?= ($filters['field'] ?? '') == $field->id ? 'selected' : '' ?>>


										<?= $field->name ?>


									</option>


								<?php endforeach; ?>


							</select>


						</div>


					</div>





					<div class="col-md-4">


						<div class="form-group">


							<label>

								Program Pelatihan

							</label>


							<select
								name="training"
								class="form-control">


								<option value="">

									Semua Pelatihan

								</option>


								<?php foreach($trainings as $training): ?>


									<option
										value="<?= $training->id ?>"
										<?= ($filters['training'] ?? '') == $training->id ? 'selected' : '' ?>>


										<?= $training->name ?>


									</option>


								<?php endforeach; ?>


							</select>


						</div>


					</div>


				</div>





				<div class="row">



					<div class="col-md-4">


						<div class="form-group">


							<label>

								Status Kelulusan

							</label>


							<select
								name="status"
								class="form-control">


								<option value="">

									Semua Status

								</option>


								<option
									value="passed"
									<?= ($filters['status'] ?? '') == 'passed' ? 'selected' : '' ?>>


									Lulus


								</option>


								<option
									value="failed"
									<?= ($filters['status'] ?? '') == 'failed' ? 'selected' : '' ?>>


									Tidak Lulus


								</option>


							</select>


						</div>


					</div>





					<div class="col-md-3">


						<div class="form-group">


							<label>

								Dari Tanggal

							</label>


							<input
								type="date"
								name="start_date"
								class="form-control"
								value="<?= $filters['start_date'] ?? '' ?>">


						</div>


					</div>





					<div class="col-md-3">


						<div class="form-group">


							<label>

								Sampai Tanggal

							</label>


							<input
								type="date"
								name="end_date"
								class="form-control"
								value="<?= $filters['end_date'] ?? '' ?>">


						</div>


					</div>





					<div class="col-md-2 d-flex align-items-end">


						<div class="btn-group w-100 mb-3">


							<button
								type="submit"
								class="btn btn-primary">


								<i class="fas fa-search mr-2"></i>

								Cari


							</button>




							<a
								href="<?= url('/admin/reports/scores') ?>"
								class="btn btn-outline-secondary">


								<i class="fas fa-redo"></i>


							</a>


						</div>


					</div>


				</div>


			</form>


		</div>


	</div>
	<div class="card shadow">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-star mr-2"></i>


				Data Penilaian Peserta


			</h5>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="scoreTable"
					class="table table-bordered table-hover">


					<thead class="thead-light">


					<tr>


						<th width="40">

							No

						</th>


						<th>

							Nama Peserta

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Bidang

						</th>


						<th>

							Pengetahuan

						</th>


						<th>

							Keterampilan

						</th>


						<th>

							Sikap

						</th>


						<th>

							Kehadiran

						</th>


						<th>

							Nilai Akhir

						</th>


						<th>

							Predikat

						</th>


						<th>

							Status

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($scores as $i => $score): ?>


						<?php

						$registration = $score->registration;

						$participant = $registration?->participant;

						$user = $participant?->user;

						$training = $registration?->training;

						?>



						<tr>


							<td class="text-center">

								<?= $i + 1 ?>

							</td>





							<td>


								<?= $user?->name ?? '-' ?>


								<br>


								<small class="text-muted">

									<?= $user?->email ?? '-' ?>

								</small>


							</td>





							<td>


								<?= $training?->name ?? '-' ?>


							</td>





							<td>


								<?= $training
									?->trainingField
									?->name ?? '-' ?>


							</td>





							<td class="text-center">


								<?= number_format(
									$score->knowledge_score ?? 0,
									2
								) ?>


							</td>





							<td class="text-center">


								<?= number_format(
									$score->skill_score ?? 0,
									2
								) ?>


							</td>





							<td class="text-center">


								<?= number_format(
									$score->attitude_score ?? 0,
									2
								) ?>


							</td>





							<td class="text-center">


								<?= number_format(
									$score->attendance_percentage ?? 0,
									2
								) ?>%


							</td>





							<td class="text-center">


								<strong>


									<?= $score->getFinalScore() ?>


								</strong>


							</td>





							<td class="text-center">


								<?= $score->getPredicateLabel() ?>


							</td>





							<td class="text-center">


								<?php if($score->isPassed()): ?>


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


					<?php endforeach; ?>


					</tbody>


				</table>


			</div>


		</div>


	</div>
</div>




	<script>

		document.addEventListener('DOMContentLoaded', function(){


			$('#scoreTable').DataTable({


				responsive:true,


				autoWidth:false,


				pageLength:10,


				order:[

					[0,'asc']

				],


			});


		});


	</script>
