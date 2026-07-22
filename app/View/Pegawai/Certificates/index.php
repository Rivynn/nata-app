<div class="container-fluid">


	<!-- Page Header -->

	<div class="d-sm-flex align-items-center justify-content-between mb-4">


		<div>


			<h1 class="h3 mb-0 text-gray-800">


				Penerbitan Sertifikat


			</h1>


			<p class="text-muted mb-0">


				Kelola sertifikat peserta yang telah menyelesaikan pelatihan.


			</p>


		</div>


	</div>





	<?php


		$total = $registrations->count();


		$passed = $registrations

			->filter(fn($item) => $item->score?->is_passed)

			->count();



		$issued = $registrations

			->filter(fn($item) => $item->certificate)

			->count();



		$waiting = $passed - $issued;


	?>





	<!-- Summary -->

	<div class="row mb-4">


		<div class="col-xl-3 col-md-6 mb-4">


			<div class="card border-left-primary shadow h-100 py-2">


				<div class="card-body">


					<div class="row no-gutters align-items-center">


						<div class="col mr-2">


							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Total Peserta Selesai

							</div>


							<div class="h5 mb-0 font-weight-bold text-gray-800">

								<?= $total ?>

							</div>


						</div>


						<div class="col-auto">

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>


					</div>


				</div>


			</div>


		</div>





		<div class="col-xl-3 col-md-6 mb-4">


			<div class="card border-left-success shadow h-100 py-2">


				<div class="card-body">


					<div class="row no-gutters align-items-center">


						<div class="col mr-2">


							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Lulus

							</div>


							<div class="h5 mb-0 font-weight-bold text-gray-800">

								<?= $passed ?>

							</div>


						</div>


						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>


					</div>


				</div>


			</div>


		</div>





		<div class="col-xl-3 col-md-6 mb-4">


			<div class="card border-left-info shadow h-100 py-2">


				<div class="card-body">


					<div class="row no-gutters align-items-center">


						<div class="col mr-2">


							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">

								Sudah Terbit

							</div>


							<div class="h5 mb-0 font-weight-bold text-gray-800">

								<?= $issued ?>

							</div>


						</div>


						<div class="col-auto">

							<i class="fas fa-certificate fa-2x text-gray-300"></i>

						</div>


					</div>


				</div>


			</div>


		</div>





		<div class="col-xl-3 col-md-6 mb-4">


			<div class="card border-left-warning shadow h-100 py-2">


				<div class="card-body">


					<div class="row no-gutters align-items-center">


						<div class="col mr-2">


							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

								Menunggu Terbit

							</div>


							<div class="h5 mb-0 font-weight-bold text-gray-800">

								<?= $waiting ?>

							</div>


						</div>


						<div class="col-auto">

							<i class="fas fa-clock fa-2x text-gray-300"></i>

						</div>


					</div>


				</div>


			</div>


		</div>


	</div>





	<!-- Table -->

	<div class="card shadow mb-4">


		<div class="card-header py-3 bg-white">


			<h6 class="m-0 font-weight-bold text-primary">


				<i class="fas fa-certificate mr-2"></i>


				Daftar Sertifikat Peserta


			</h6>


		</div>





		<div class="card-body">


			<div class="table-responsive">


				<table
					class="table table-bordered table-hover"
					id="certificateTable"
					width="100%">


					<thead class="thead-light">


					<tr>


						<th width="50">

							No

						</th>


						<th>

							Peserta

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Nilai Akhir

						</th>


						<th>

							Predikat

						</th>


						<th>

							Status Sertifikat

						</th>


						<th width="120">

							Aksi

						</th>


					</tr>


					</thead>





					<tbody>


					<?php foreach($registrations as $i => $registration): ?>


						<tr>


							<td class="text-center">


								<?= $i + 1 ?>


							</td>





							<td>


								<strong>


									<?= e(

										$registration
											->participant
											?->user
											?->name
										?? '-'

									) ?>


								</strong>


								<br>


								<small class="text-muted">


									<?= e(

										$registration
											->participant
											?->user
											?->email
										?? '-'

									) ?>


								</small>


							</td>





							<td>


								<?= e(

									$registration
										->training
										?->name
									?? '-'

								) ?>


							</td>





							<td class="text-center">


								<?= $registration
									->score
									?->getFinalScore()
									?? '-'
								?>


							</td>





							<td class="text-center">


								<?= e(

									$registration
										->score
										?->predicate
									?? '-'

								) ?>


							</td>





							<td class="text-center">


								<?php if($registration->certificate): ?>


									<span class="badge badge-success">

										Terbit

									</span>


									<br>


									<small>

										<?= $registration
											->certificate
											->certificate_number
										?>

									</small>



								<?php elseif(
									$registration->score?->is_passed
								): ?>


									<span class="badge badge-warning">

										Siap Terbit

									</span>



								<?php else: ?>


									<span class="badge badge-danger">

										Belum Lulus

									</span>



								<?php endif; ?>


							</td>





							<td class="text-center">


								<?php if(
									!$registration->certificate
									&&
									$registration->score?->is_passed
								): ?>


									<form
										method="POST"
										action="<?= url('/pegawai/certificates/generate') ?>">


										<input
											type="hidden"
											name="registration_id"
											value="<?= $registration->id ?>">



										<button
											type="submit"
											class="btn btn-sm btn-primary">


											<i class="fas fa-certificate"></i>


											Terbitkan


										</button>


									</form>



								<?php elseif($registration->certificate): ?>

									<a
										href="<?= url('/pegawai/certificates/show?id=' . $registration->certificate->id) ?>"
										class="btn btn-sm btn-success">


										<i class="fas fa-eye"></i>


										Lihat


									</a>


								<?php else: ?>


									<button
										class="btn btn-sm btn-secondary"
										disabled>


										<i class="fas fa-lock"></i>


										-

									</button>



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

	$(document).ready(function(){


		$('#certificateTable').DataTable({

			responsive:true,

			autoWidth:false,

			pageLength:10,

			order:[

				[0,'asc']

			]

		});


	});


</script>
