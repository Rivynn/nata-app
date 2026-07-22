<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Data Peserta

					</h4>


					<p class="text-muted mb-0">

						Laporan seluruh peserta yang terdaftar pada sistem pelatihan.

					</p>


				</div>



				<a
					href="<?= url('/admin/reports/participants/print?' . http_build_query($filters ?? [])) ?>"
					target="_blank"
					class="btn btn-outline-primary">


					<i class="fas fa-print mr-2"></i>

					Cetak


				</a>

			</div>


		</div>


	</div>





	<?php

		$totalParticipant = $participants->count();


		$completedProfile = $participants->filter(
			fn($participant) =>
			$participant->profile?->is_completed
		)->count();



		$totalMale = $participants->filter(
			fn($participant) =>
				$participant->gender === 'L'
		)->count();



		$totalFemale = $participants->filter(
			fn($participant) =>
				$participant->gender === 'P'
		)->count();


	?>





	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-primary text-uppercase">

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


			<div class="card border-left-success shadow h-100">


				<div class="card-body">


					<div class="d-flex justify-content-between">


						<div>


							<div class="text-xs font-weight-bold text-success text-uppercase">

								Profil Lengkap

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $completedProfile ?>

							</h2>


						</div>


						<i class="fas fa-user-check fa-2x text-gray-300"></i>


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

								Laki-laki

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalMale ?>

							</h2>


						</div>


						<i class="fas fa-male fa-2x text-gray-300"></i>


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

								Perempuan

							</div>


							<h2 class="font-weight-bold mb-0">

								<?= $totalFemale ?>

							</h2>


						</div>


						<i class="fas fa-female fa-2x text-gray-300"></i>


					</div>


				</div>


			</div>


		</div>


	</div>
	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h5 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>


				Filter Laporan Peserta


			</h5>


		</div>





		<div class="card-body">


			<form
				method="GET"
				action="<?= url('/admin/reports/participants') ?>">



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

								Status Registrasi

							</label>




							<select
								name="status"
								class="form-control">


								<option value="">

									Semua Status

								</option>



								<option
									value="pending"
									<?= ($filters['status'] ?? '') == 'pending' ? 'selected' : '' ?>>

									Menunggu


								</option>




								<option
									value="approved"
									<?= ($filters['status'] ?? '') == 'approved' ? 'selected' : '' ?>>

									Disetujui


								</option>




								<option
									value="rejected"
									<?= ($filters['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>

									Ditolak


								</option>




								<option
									value="completed"
									<?= ($filters['status'] ?? '') == 'completed' ? 'selected' : '' ?>>

									Selesai


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
								href="<?= url('/admin/reports/participants') ?>"
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


			<div class="d-flex justify-content-between align-items-center">


				<div>


					<h5 class="font-weight-bold text-primary mb-1">


						Data Peserta


					</h5>


					<small class="text-muted">


						Daftar peserta beserta riwayat pelatihan.


					</small>


				</div>




				<span class="badge badge-primary px-3 py-2">


					<?= $participants->count() ?>


					Peserta


				</span>


			</div>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					id="participantReportTable"
					class="table table-hover">


					<thead class="thead-light">


					<tr>


						<th width="60">

							#

						</th>


						<th>

							Peserta

						</th>


						<th>

							Kontak

						</th>


						<th>

							Pendidikan

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Bidang

						</th>


						<th>

							Status

						</th>


						<th>

							Terdaftar

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($participants as $i => $participant): ?>


						<tr>


							<td>


								<?= $i + 1 ?>


							</td>





							<td>


								<div class="d-flex align-items-center">


									<?php if($participant->user?->avatar_url): ?>


										<img
											src="<?= $participant->user->avatar_url ?>"
											width="45"
											height="45"
											class="rounded-circle mr-3"
											style="object-fit:cover;">


									<?php else: ?>


										<div class="avatar-circle mr-3">


											<?= initials(
												$participant->user?->name ?? '-'
											) ?>


										</div>


									<?php endif; ?>




									<div>


										<div class="font-weight-bold">


											<?= $participant->user?->name ?? '-' ?>


										</div>



										<small class="text-muted">


											ID #<?= $participant->id ?>


										</small>


									</div>


								</div>


							</td>





							<td>


								<div>


									<i class="fas fa-envelope text-primary mr-1"></i>


									<?= $participant->user?->email ?? '-' ?>


								</div>



								<div class="mt-1">


									<i class="fas fa-phone text-success mr-1"></i>


									<?= $participant->phone ?: '-' ?>


								</div>


							</td>





							<td>


								<?= $participant->education ?: '-' ?>


							</td>





							<td>


								<?php if($participant->registrations->count()): ?>


									<?php foreach(
										$participant->registrations
										as $registration
									): ?>


										<span class="badge badge-light mb-1">


											<?= $registration->training?->name ?? '-' ?>


										</span>


										<br>


									<?php endforeach; ?>


								<?php else: ?>


									<span class="text-muted">

										Belum ada

									</span>


								<?php endif; ?>


							</td>





							<td>


								<?php if($participant->registrations->count()): ?>


									<?php foreach(
										$participant->registrations
										as $registration
									): ?>


										<span class="badge badge-info mb-1">


											<?= $registration
												->training
												?->trainingField
												?->name ?? '-' ?>


										</span>


										<br>


									<?php endforeach; ?>


								<?php else: ?>


									-


								<?php endif; ?>


							</td>





							<td>


								<?php if($participant->registrations->count()): ?>


									<?php foreach(
										$participant->registrations
										as $registration
									): ?>


										<?php if($registration->status === 'approved'): ?>


											<span class="badge badge-success mb-1">


												Disetujui


											</span>



										<?php elseif($registration->status === 'pending'): ?>


											<span class="badge badge-warning mb-1">


												Menunggu


											</span>



										<?php elseif($registration->status === 'rejected'): ?>


											<span class="badge badge-danger mb-1">


												Ditolak


											</span>



										<?php elseif($registration->status === 'completed'): ?>


											<span class="badge badge-primary mb-1">


												Selesai


											</span>



										<?php endif; ?>



										<br>


									<?php endforeach; ?>


								<?php else: ?>


									<span class="badge badge-secondary">


										Belum Daftar


									</span>


								<?php endif; ?>


							</td>





							<td>


								<?= $participant->created_at?->format('d M Y') ?>


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



		let table = $('#participantReportTable').DataTable({


			responsive:true,


			autoWidth:false,


			pageLength:10,



			order:[

				[0,'asc']

			],



			columnDefs:[


				{

					orderable:false,

					targets:[0]

				}


			],



			language:{


				search:"Cari:",


				lengthMenu:
					"Tampilkan _MENU_ data",


				info:
					"Menampilkan _START_ - _END_ dari _TOTAL_ peserta",


				emptyTable:
					"Tidak ada data peserta",



				paginate:{


					first:"Awal",


					last:"Akhir",


					next:"›",


					previous:"‹"


				}


			}


		});



	});

</script>
