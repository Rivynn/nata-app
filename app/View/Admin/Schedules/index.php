<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Jadwal Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Monitoring seluruh jadwal kegiatan pelatihan.

					</p>


				</div>


			</div>


		</div>


	</div>





	<?php

		$today = $schedules->filter(
			fn($schedule) => $schedule->isToday()
		)->count();



		$upcoming = $schedules->filter(
			fn($schedule) => $schedule->isUpcoming()
		)->count();



		$past = $schedules->filter(
			fn($schedule) => $schedule->isPast()
		)->count();

	?>





	<div class="row">



		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow h-100">


				<div class="card-body">


					<div class="text-xs text-primary font-weight-bold text-uppercase">

						Total Jadwal

					</div>


					<h2 class="font-weight-bold mb-0">


						<?= $schedules->count() ?>


					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-success shadow h-100">


				<div class="card-body">


					<div class="text-xs text-success font-weight-bold text-uppercase">

						Hari Ini

					</div>


					<h2 class="font-weight-bold mb-0">


						<?= $today ?>


					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-info shadow h-100">


				<div class="card-body">


					<div class="text-xs text-info font-weight-bold text-uppercase">

						Akan Datang

					</div>


					<h2 class="font-weight-bold mb-0">


						<?= $upcoming ?>


					</h2>


				</div>


			</div>


		</div>





		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-secondary shadow h-100">


				<div class="card-body">


					<div class="text-xs text-secondary font-weight-bold text-uppercase">

						Selesai

					</div>


					<h2 class="font-weight-bold mb-0">


						<?= $past ?>


					</h2>


				</div>


			</div>


		</div>



	</div>
	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>


				Filter Jadwal


			</h5>


		</div>




		<div class="card-body">


			<div class="row">


				<div class="col-md-4">


					<label>

						Pelatihan

					</label>


					<select
						id="trainingFilter"
						class="form-control">


						<option value="">

							Semua Pelatihan

						</option>


						<?php foreach(
							$schedules
								->pluck('training.name')
								->unique()
							as $trainingName
						): ?>


							<option value="<?= $trainingName ?>">


								<?= $trainingName ?>


							</option>


						<?php endforeach; ?>


					</select>


				</div>





				<div class="col-md-4">


					<label>

						Status

					</label>


					<select
						id="statusFilter"
						class="form-control">


						<option value="">

							Semua

						</option>


						<option value="today">

							Hari Ini

						</option>


						<option value="upcoming">

							Akan Datang

						</option>


						<option value="past">

							Selesai

						</option>


					</select>


				</div>





				<div class="col-md-4">


					<label>

						Pencarian

					</label>


					<input
						type="text"
						id="searchSchedule"
						class="form-control"
						placeholder="Cari jadwal...">


				</div>


			</div>


		</div>


	</div>
	<div class="card shadow">


		<div class="card-header bg-white">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h5 class="font-weight-bold text-primary mb-1">


						Daftar Jadwal


					</h5>


					<small class="text-muted">


						Seluruh jadwal pelatihan.


					</small>


				</div>



				<span class="badge badge-primary px-3 py-2">


					<?= $schedules->count() ?>


					Jadwal


				</span>


			</div>


		</div>




		<div class="card-body">


			<?php if($schedules->isEmpty()): ?>


				<div class="text-center py-5">


					<i class="fas fa-calendar-times fa-5x text-gray-300 mb-3"></i>


					<h5 class="font-weight-bold">


						Belum Ada Jadwal


					</h5>


					<p class="text-muted">


						Belum ada jadwal pelatihan yang tersedia.


					</p>


				</div>


			<?php else: ?>


			<div class="table-responsive">


				<table
					id="scheduleTable"
					class="table table-hover">


					<thead class="thead-light">


					<tr>


						<th width="60">

							#

						</th>


						<th>

							Pelatihan

						</th>

						<th>
							Pelatih
						</th>

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

							Ruangan

						</th>


						<th>

							Status

						</th>


						<th width="120">

							Aksi

						</th>


					</tr>


					</thead>



					<tbody>
					<?php foreach($schedules as $i => $schedule): ?>


					<tr>


						<td>


							<?= $i + 1 ?>


						</td>





						<td>


							<div class="font-weight-bold">


								<?= $schedule->training?->name ?? '-' ?>


							</div>



							<small class="text-muted">


								<?= $schedule->training?->code ?? '' ?>


							</small>



							<br>



							<span class="badge badge-light mt-1">


										<?= $schedule->training?->trainingField?->name ?? '-' ?>


									</span>


						</td>


						<td>


							<div class="font-weight-bold">


								<?= $schedule->training?->trainer?->user?->name ?? '-' ?>


							</div>


						</td>


						<td>


									<span class="badge badge-primary px-3">


										Pertemuan <?= $schedule->meeting_number ?>


									</span>



							<?php if(
								$schedule->topic
							): ?>


								<br>


								<small class="text-muted">


									<?= $schedule->topic ?>


								</small>


							<?php endif; ?>


						</td>





						<td>


							<i class="fas fa-calendar text-primary mr-1"></i>


							<?= $schedule->schedule_date?->format('d M Y') ?>


						</td>





						<td>


							<i class="fas fa-clock text-warning mr-1"></i>


							<?= $schedule->getTimeRange() ?>


						</td>





						<td>


							<i class="fas fa-map-marker-alt text-danger mr-1"></i>


							<?= $schedule->getRoom() ?>


						</td>





						<td>


							<?php if($schedule->isToday()): ?>


								<span class="badge badge-success px-3 py-2">


											<i class="fas fa-play mr-1"></i>


											Hari Ini


										</span>



							<?php elseif($schedule->isUpcoming()): ?>


								<span class="badge badge-info px-3 py-2">


											<i class="fas fa-clock mr-1"></i>


											Akan Datang


										</span>



							<?php elseif($schedule->isPast()): ?>


								<span class="badge badge-secondary px-3 py-2">


											<i class="fas fa-check mr-1"></i>


											Selesai


										</span>



							<?php else: ?>


								<span class="badge badge-light">


											-


										</span>


							<?php endif; ?>


						</td>





						<td>


							<div class="btn-group shadow-sm">



								<a
									href="<?= url('/admin/schedules/edit?id=' . $schedule->id) ?>"
									class="btn btn-outline-warning btn-sm"
									title="Edit">


									<i class="fas fa-edit"></i>


								</a>





								<form
									method="POST"
									action="<?= url('/admin/schedules/delete') ?>">



									<input
										type="hidden"
										name="id"
										value="<?= $schedule->id ?>">



									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										onclick="return confirm('Yakin ingin menghapus jadwal ini?')">


										<i class="fas fa-trash"></i>


									</button>



								</form>



							</div>


						</td>


					</tr>


<?php endforeach; ?>
					</tbody>


				</table>


			</div>


			<?php endif; ?>


		</div>


	</div>


</div>
<script>

	document.addEventListener('DOMContentLoaded', function(){


		let table = $('#scheduleTable').DataTable({

			responsive:true,

			autoWidth:false,

			pageLength:10,

			order:[
				[3,'asc']
			],


			columnDefs:[

				{
					orderable:false,
					targets:[7]
				}

			],


			language: {

				search:"Cari:",

				lengthMenu:
					"Tampilkan _MENU_ data",

				info:
					"Menampilkan _START_ - _END_ dari _TOTAL_ jadwal",

				paginate: {

					first:"Awal",

					last:"Akhir",

					next:"›",

					previous:"‹"

				},

				emptyTable:
					"Tidak ada jadwal"

			}

		});





		// Filter Pelatihan

		$('#trainingFilter').on('change', function(){


			table
				.column(1)
				.search(this.value)
				.draw();


		});





		// Filter Status

		$('#statusFilter').on('change', function(){


			table
				.column(6)
				.search(this.value)
				.draw();


		});





		// Search

		$('#searchSchedule').on('keyup', function(){


			table
				.search(this.value)
				.draw();


		});





		// Reset

		$('#resetFilter').on('click', function(){


			$('#trainingFilter').val('');

			$('#statusFilter').val('');

			$('#searchSchedule').val('');



			table
				.search('')
				.columns()
				.search('')
				.draw();


		});


	});

</script>
