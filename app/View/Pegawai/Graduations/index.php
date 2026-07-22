<?php

	/**
	 * Variables:
	 *
	 * $registrations
	 * $fields
	 * $trainings
	 * $filters
	 */

?>


<div class="container-fluid">



	<!-- Header -->

	<div class="d-sm-flex align-items-center justify-content-between mb-4">


		<h1 class="h3 mb-0 text-gray-800">


			<i class="fas fa-user-graduate mr-2"></i>


			Data Kelulusan Peserta


		</h1>



		<a

			href="<?= url('/pegawai/certificates') ?>"

			class="btn btn-primary btn-sm"

		>


			<i class="fas fa-certificate mr-2"></i>


			Penerbitan Sertifikat


		</a>


	</div>





	<!-- Filter -->


	<div class="card shadow mb-4">


		<div class="card-header bg-white">


			<h6 class="font-weight-bold text-primary mb-0">


				<i class="fas fa-filter mr-2"></i>


				Filter Kelulusan


			</h6>


		</div>





		<div class="card-body">


			<form

				method="GET"

				action="<?= url('/pegawai/graduations') ?>"

			>


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


								value="<?= $filters['keyword'] ?? '' ?>"


							>


						</div>


					</div>





					<div class="col-md-4">


						<div class="form-group">


							<label>


								Bidang Pelatihan


							</label>




							<select

								name="field"

								class="form-control"

							>


								<option value="">


									Semua Bidang


								</option>




								<?php foreach($fields as $field): ?>


									<option

										value="<?= $field->id ?>"

										<?= ($filters['field'] ?? '') == $field->id ? 'selected' : '' ?>

									>


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

								class="form-control"

							>


								<option value="">


									Semua Pelatihan


								</option>




								<?php foreach($trainings as $training): ?>


									<option

										value="<?= $training->id ?>"

										<?= ($filters['training'] ?? '') == $training->id ? 'selected' : '' ?>

									>


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

								class="form-control"

							>



								<option value="">


									Semua


								</option>



								<option

									value="passed"

									<?= ($filters['status'] ?? '') == 'passed' ? 'selected' : '' ?>

								>


									Lulus


								</option>



								<option

									value="failed"

									<?= ($filters['status'] ?? '') == 'failed' ? 'selected' : '' ?>

								>


									Tidak Lulus


								</option>


							</select>


						</div>


					</div>





					<div class="col-md-8 d-flex align-items-end">


						<div class="btn-group mb-3">


							<button

								type="submit"

								class="btn btn-primary"

							>


								<i class="fas fa-search mr-2"></i>


								Cari


							</button>




							<a

								href="<?= url('/pegawai/graduations') ?>"

								class="btn btn-outline-secondary"

							>


								<i class="fas fa-redo"></i>


							</a>


						</div>


					</div>



				</div>


			</form>


		</div>


	</div>






	<!-- Table -->


	<div class="card shadow">


		<div class="card-header bg-white">


			<h6 class="font-weight-bold text-primary mb-0">


				Daftar Kelulusan


			</h6>


		</div>





		<div class="card-body p-0">


			<?php if($registrations->isEmpty()): ?>


				<div class="text-center py-5">


					<i class="fas fa-user-graduate fa-4x text-gray-300 mb-3"></i>


					<h5>


						Belum Ada Data Kelulusan


					</h5>


					<p class="text-muted">


						Data muncul setelah peserta menyelesaikan pelatihan.


					</p>


				</div>



			<?php else: ?>



				<div class="table-responsive">


					<table class="table table-hover mb-0">


						<thead class="bg-light">


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


								Status


							</th>


							<th>


								Sertifikat


							</th>


						</tr>


						</thead>





						<tbody>



						<?php foreach($registrations as $i => $registration): ?>



							<?php

							$score = $registration->score;


							$isPassed = $score?->is_passed;


							?>



							<tr>


								<td>


									<?= $i + 1 ?>


								</td>




								<td>


									<strong>


										<?= $registration->participant?->user?->name ?? '-' ?>


									</strong>



									<br>


									<small class="text-muted">


										<?= $registration->participant?->user?->email ?? '-' ?>


									</small>


								</td>





								<td>


									<?= $registration->training?->name ?? '-' ?>



									<br>


									<small class="text-muted">


										<?= $registration->training?->trainingField?->name ?? '-' ?>


									</small>


								</td>





								<td>


									<?= $score?->final_score ?? '-' ?>


								</td>





								<td>


									<?= $score?->predicate ?? '-' ?>


								</td>





								<td>



									<?php if($score && $isPassed): ?>


										<span class="badge badge-success">


										Lulus


									</span>



									<?php elseif($score): ?>


										<span class="badge badge-danger">


										Tidak Lulus


									</span>



									<?php else: ?>


										<span class="badge badge-secondary">


										Belum Dinilai


									</span>


									<?php endif; ?>


								</td>





								<td>


									<?php if($registration->certificate): ?>


										<span class="badge badge-success">


										Sudah Terbit


									</span>



									<?php elseif($score?->is_passed): ?>


										<span class="badge badge-warning">


										Siap Terbit


									</span>



									<?php else: ?>


										<span class="badge badge-secondary">


										Belum


									</span>



									<?php endif; ?>


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
