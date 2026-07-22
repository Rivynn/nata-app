<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Rekapitulasi Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Ringkasan data pelatihan, peserta, kehadiran, dan kelulusan.

					</p>


				</div>





				<a
					href="<?= url('/admin/reports/recapitulation/print?' . http_build_query($filters ?? [])) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak


				</a>


			</div>


		</div>


	</div>





	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-primary text-uppercase">

						Total Pelatihan

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $summary['total_training'] ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-success shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-success text-uppercase">

						Total Peserta

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $summary['total_participant'] ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-info shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-info text-uppercase">

						Kehadiran

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $summary['total_attendance'] ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-warning shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-warning text-uppercase">

						Lulusan

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $summary['total_graduation'] ?>

					</h2>


				</div>


			</div>


		</div>


	</div>
	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>

				Filter Rekapitulasi


			</h5>


		</div>





		<div class="card-body">


			<form
				method="GET"
				action="<?= url('/admin/reports/recapitulation') ?>">



				<div class="row">


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
								href="<?= url('/admin/reports/recapitulation') ?>"
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


				<i class="fas fa-table mr-2"></i>


				Detail Rekap Pelatihan


			</h5>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="recapitulationTable"
					class="table table-bordered table-hover">


					<thead class="thead-light">


					<tr>


						<th width="40">

							No

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Bidang

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

							Kehadiran

						</th>


						<th>

							Lulus

						</th>


						<th>

							Status

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($summary['trainings'] as $i => $training): ?>


						<?php


						$registrationCount = $training
							->registrations
							->count();



						$participantCount = $training
							->registrations
							->pluck('participant_id')
							->unique()
							->count();



						$graduationCount = \Natasya\NataApp\Model\TrainingScore::query()

							->whereIn(
								'registration_id',
								$training
									->registrations
									->pluck('id')
							)

							->where(
								'is_passed',
								true
							)

							->count();



						?>



						<tr>


							<td class="text-center">


								<?= $i + 1 ?>


							</td>





							<td>


								<?= $training->name ?>


							</td>





							<td>


								<?= $training
									->trainingField
									?->name ?? '-' ?>


							</td>





							<td>


								<?= $training->training_start

									?->format('d/m/Y')

									?? '-'

								?>

								-

								<?= $training->training_end

									?->format('d/m/Y')

									?? '-'

								?>


							</td>





							<td class="text-center">


								<?= $training->quota ?? 0 ?>


							</td>





							<td class="text-center">


								<?= $participantCount ?>


							</td>





							<td class="text-center">


								<?= $registrationCount ?>


							</td>





							<td class="text-center">


								<?= $graduationCount ?>


							</td>





							<td class="text-center">


								<?php if($training->status === 'open'): ?>


									<span class="badge badge-success">

								Buka

							</span>



								<?php elseif($training->status === 'completed'): ?>


									<span class="badge badge-primary">

								Selesai

							</span>



								<?php else: ?>


									<span class="badge badge-secondary">

								<?= ucfirst($training->status) ?>

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


			$('#recapitulationTable').DataTable({


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
