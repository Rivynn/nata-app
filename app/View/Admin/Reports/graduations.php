<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Kelulusan Peserta

					</h4>


					<p class="text-muted mb-0">

						Rekap peserta yang telah menyelesaikan pelatihan dan dinyatakan lulus.

					</p>


				</div>




				<a
					href="<?= url('/admin/reports/graduations/print?' . http_build_query($filters ?? [])) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak


				</a>


			</div>


		</div>


	</div>





	<?php


		$totalGraduation = $scores->count();



		$totalAverage = $scores->avg('final_score') ?? 0;



		$totalTraining = $scores

			->pluck('registration.training_id')

			->unique()

			->count();


	?>





	<div class="row">


		<div class="col-lg-4 col-md-6 mb-4">


			<div class="card border-left-success shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-success text-uppercase">

						Total Lulusan

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalGraduation ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-4 col-md-6 mb-4">


			<div class="card border-left-primary shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-primary text-uppercase">

						Rata-rata Nilai

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= number_format($totalAverage,2) ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-4 col-md-6 mb-4">


			<div class="card border-left-info shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-info text-uppercase">

						Program Pelatihan

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalTraining ?>

					</h2>


				</div>


			</div>


		</div>


	</div>
	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>

				Filter Kelulusan


			</h5>


		</div>





		<div class="card-body">


			<form
				method="GET"
				action="<?= url('/admin/reports/graduations') ?>">



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


					<div class="col-md-5">


						<div class="form-group">


							<label>

								Dari Tanggal Lulus

							</label>


							<input
								type="date"
								name="start_date"
								class="form-control"
								value="<?= $filters['start_date'] ?? '' ?>">


						</div>


					</div>





					<div class="col-md-5">


						<div class="form-group">


							<label>

								Sampai Tanggal Lulus

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
								href="<?= url('/admin/reports/graduations') ?>"
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


				<i class="fas fa-award mr-2"></i>


				Data Peserta Lulus


			</h5>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="graduationTable"
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

							Email

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Bidang

						</th>


						<th>

							Nilai Akhir

						</th>


						<th>

							Predikat

						</th>


						<th>

							Tanggal Lulus

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


							</td>





							<td>


								<?= $user?->email ?? '-' ?>


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


								<strong>

									<?= $score->getFinalScore() ?>

								</strong>


							</td>





							<td class="text-center">


								<?= $score->getPredicateLabel() ?>


							</td>





							<td>


								<?= $score->published_at

									?->format('d/m/Y')

									?? '-'

								?>


							</td>





							<td class="text-center">


							<span class="badge badge-success">


								Lulus


							</span>


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


			$('#graduationTable').DataTable({


				responsive:true,


				autoWidth:false,


				pageLength:10,


				order:[

					[0,'asc']

				],


				columnDefs:[

					{

						orderable:false,

						targets:[8]

					}

				]


			});


		});


	</script>
