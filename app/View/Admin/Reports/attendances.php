<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Kehadiran Peserta

					</h4>


					<p class="text-muted mb-0">

						Rekap kehadiran peserta pada setiap pelaksanaan pelatihan.

					</p>


				</div>




				<a
					href="<?= url('/admin/reports/attendance/print?' . http_build_query($filters ?? [])) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak


				</a>


			</div>


		</div>


	</div>





	<?php


		$totalAttendance = $attendances->count();



		$totalPresent = $attendances->filter(
			fn($attendance) =>
				$attendance->status === 'present'
		)->count();



		$totalAbsent = $attendances->filter(
			fn($attendance) =>
				$attendance->status === 'absent'
		)->count();



		$totalLate = $attendances->filter(
			fn($attendance) =>
				$attendance->status === 'late'
		)->count();


	?>





	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-primary text-uppercase">

						Total Absensi

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalAttendance ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-success shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-success text-uppercase">

						Hadir

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalPresent ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-danger shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-danger text-uppercase">

						Tidak Hadir

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalAbsent ?>

					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-warning shadow">


				<div class="card-body">


					<div class="text-xs font-weight-bold text-warning text-uppercase">

						Terlambat

					</div>


					<h2 class="font-weight-bold mb-0">

						<?= $totalLate ?>

					</h2>


				</div>


			</div>


		</div>


	</div>





	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>


				Filter Kehadiran


			</h5>


		</div>





		<div class="card-body">


			<form method="GET" action="<?= url('/admin/reports/attendance') ?>">



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
								placeholder="Nama / email peserta"
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

								Pelatihan

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

								Status Kehadiran

							</label>


							<select
								name="status"
								class="form-control">


								<option value="">

									Semua Status

								</option>


								<option value="present">

									Hadir

								</option>


								<option value="late">

									Terlambat

								</option>


								<option value="absent">

									Tidak Hadir

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


						<button
							type="submit"
							class="btn btn-primary btn-block mb-3">


							<i class="fas fa-search mr-2"></i>

							Cari


						</button>


					</div>


				</div>


			</form>


		</div>


	</div>
	<div class="card shadow">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-calendar-check mr-2"></i>


				Data Kehadiran Peserta


			</h5>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="attendanceTable"
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

							th>


						<th>

							Pertemuan

						</th>


						<th>

							Tanggal

						</th>


						<th>

							Waktu

						</th>


						<th>

							Status

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($attendances as $i => $attendance): ?>


						<tr>


							<td class="text-center">

								<?= $i + 1 ?>

							</td>





							<td>


								<?= $attendance
									->registration
									?->participant
									?->user
									?->name ?? '-' ?>


							</td>





							<td>


								<?= $attendance
									->registration
									?->participant
									?->user
									?->email ?? '-' ?>


							</td>





							<td>


								<?= $attendance
									->attendanceSession
									?->trainingSchedule
									?->training
									?->name ?? '-' ?>


							</td>





							<td>


								<?php

									$schedule = $attendance
										->attendanceSession
										?->trainingSchedule;


								?>


								<?= $schedule?->getMeetingLabel() ?? '-' ?>


							</td>





							<td>


								<?= $schedule?->schedule_date?->format('d/m/Y') ?? '-' ?>


							</td>





							<td>


								<?= $attendance->check_in_at?->format('H:i') ?? '-' ?>


							</td>





							<td class="text-center">


								<?php if($attendance->status === 'present'): ?>


									<span class="badge badge-success">

									Hadir

								</span>




								<?php elseif($attendance->status === 'late'): ?>


									<span class="badge badge-warning">

									Terlambat

								</span>




								<?php elseif($attendance->status === 'absent'): ?>


									<span class="badge badge-danger">

									Tidak Hadir

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


			$('#attendanceTable').DataTable({


				responsive:true,


				autoWidth:false,


				pageLength:10,


				order:[

					[0,'asc']

				],


				columnDefs:[

					{

						orderable:false,

						targets:[7]

					}

				]


			});


		});


	</script>
