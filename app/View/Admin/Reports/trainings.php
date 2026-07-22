<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Data Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Laporan seluruh program pelatihan beserta informasi peserta, pelatih, dan status pelaksanaan.

					</p>


				</div>




				<a
					href="<?= url('/admin/reports/trainings/print?' . http_build_query($filters)) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak Laporan


				</a>


			</div>


		</div>


	</div>





	<?php


		$totalTraining = $trainings->count();



		$totalParticipant = $trainings->sum(
			fn($training) =>
			$training->registrations->count()
		);



		$totalQuota = $trainings->sum(
			fn($training) =>
			$training->quota
		);



		$totalRunning = $trainings->filter(
			fn($training) =>
			$training->isRunning()
		)->count();


	?>





	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-primary text-uppercase">

								Total Pelatihan

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalTraining ?>

							</h2>


						</div>



						<i class="fas fa-book-open fa-2x text-gray-300"></i>


					</div>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-success shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-success text-uppercase">

								Total Peserta

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalParticipant ?>

							</h2>


						</div>



						<i class="fas fa-users fa-2x text-gray-300"></i>


					</div>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-warning shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-warning text-uppercase">

								Total Kuota

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalQuota ?>

							</h2>


						</div>



						<i class="fas fa-user-friends fa-2x text-gray-300"></i>


					</div>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-info shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-info text-uppercase">

								Sedang Berjalan

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalRunning ?>

							</h2>


						</div>



						<i class="fas fa-play-circle fa-2x text-gray-300"></i>


					</div>


				</div>


			</div>


		</div>


	</div>
	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>


				Filter Laporan Pelatihan


			</h5>


		</div>





		<div class="card-body">


			<form method="GET" action="<?= url('/admin/reports/trainings') ?>">



				<div class="row">



					<div class="col-md-4">


						<div class="form-group">


							<label>

								Pencarian

							</label>


							<input
								type="text"
								name="keyword"
								class="form-control"
								placeholder="Nama / kode pelatihan"
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

								Pelatih

							</label>


							<select
								name="trainer"
								class="form-control">


								<option value="">

									Semua Pelatih

								</option>


								<?php foreach($trainers as $trainer): ?>


									<option
										value="<?= $trainer->id ?>"
										<?= ($filters['trainer'] ?? '') == $trainer->id ? 'selected' : '' ?>>


										<?= $trainer->user?->name ?? '-' ?>


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

								Status

							</label>


							<select
								name="status"
								class="form-control">


								<option value="">

									Semua Status

								</option>



								<option value="draft"
									<?= ($filters['status'] ?? '') == 'draft' ? 'selected' : '' ?>>

									Draft

								</option>



								<option value="open"
									<?= ($filters['status'] ?? '') == 'open' ? 'selected' : '' ?>>

									Buka Pendaftaran

								</option>



								<option value="running"
									<?= ($filters['status'] ?? '') == 'running' ? 'selected' : '' ?>>

									Berjalan

								</option>



								<option value="completed"
									<?= ($filters['status'] ?? '') == 'completed' ? 'selected' : '' ?>>

									Selesai

								</option>



								<option value="cancelled"
									<?= ($filters['status'] ?? '') == 'cancelled' ? 'selected' : '' ?>>

									Dibatalkan

								</option>


							</select>


						</div>


					</div>





					<div class="col-md-3">


						<div class="form-group">


							<label>

								Tanggal Mulai

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

								Tanggal Akhir

							</label>


							<input
								type="date"
								name="end_date"
								class="form-control"
								value="<?= $filters['end_date'] ?? '' ?>">


						</div>


					</div>





					<div class="col-md-2 d-flex align-items-end">


						<div class="form-group w-100">


							<button
								type="submit"
								class="btn btn-primary btn-block">


								<i class="fas fa-search mr-2"></i>

								Cari


							</button>


						</div>


					</div>


				</div>


			</form>


		</div>


	</div>
	<div class="card shadow">


		<div class="card-header bg-white">


			<div class="d-flex justify-content-between align-items-center">


				<h5 class="font-weight-bold text-primary mb-0">


					<i class="fas fa-book-open mr-2"></i>


					Data Pelatihan


				</h5>


			</div>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="trainingReportTable"
					class="table table-bordered table-hover">


					<thead class="thead-light">


					<tr>


						<th width="50">

							No

						</th>


						<th>

							Kode

						</th>


						<th>

							Nama Pelatihan

						</th>


						<th>

							Bidang

						</th>


						<th>

							Pelatih

						</th>


						<th>

							Periode

						</th>


						<th>

							Kuota

						</th>


						<th>

							Peserta

						</th>


						<th>

							Status

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($trainings as $i => $training): ?>


						<tr>


							<td class="text-center">


								<?= $i + 1 ?>


							</td>





							<td>


								<?= $training->code ?? '-' ?>


							</td>





							<td>


								<strong>

									<?= $training->name ?>

								</strong>


								<br>


								<small class="text-muted">

									<?= $training->location ?? '-' ?>

								</small>


							</td>





							<td>


								<?= $training->trainingField?->name ?? '-' ?>


							</td>





							<td>


								<?= $training->trainer?->user?->name ?? '-' ?>


							</td>





							<td>


								<?= $training->training_start?->format('d/m/Y') ?? '-' ?>


								<br>


								<span class="text-muted">

									s/d

								</span>

								<br>


								<?= $training->training_end?->format('d/m/Y') ?? '-' ?>


							</td>





							<td class="text-center">


								<?= $training->quota ?>


							</td>





							<td class="text-center">


								<span class="badge badge-primary">


									<?= $training->registrations->count() ?>


								</span>


							</td>





							<td class="text-center">


								<?php if($training->isDraft()): ?>


									<span class="badge badge-secondary">

										Draft

									</span>



								<?php elseif($training->isOpen()): ?>


									<span class="badge badge-success">

										Dibuka

									</span>



								<?php elseif($training->isClosed()): ?>


									<span class="badge badge-warning">

										Ditutup

									</span>



								<?php elseif($training->isRunning()): ?>


									<span class="badge badge-primary">

										Berjalan

									</span>



								<?php elseif($training->isCompleted()): ?>


									<span class="badge badge-info">

										Selesai

									</span>



								<?php elseif($training->isCancelled()): ?>


									<span class="badge badge-danger">

										Dibatalkan

									</span>



								<?php else: ?>


									<span class="badge badge-secondary">

										-

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


		$('#trainingReportTable').DataTable({


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
