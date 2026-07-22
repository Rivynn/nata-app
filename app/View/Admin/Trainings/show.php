<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Detail Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Informasi lengkap program pelatihan.

					</p>

				</div>



				<div>


					<a
						href="<?= url('/admin/trainings/edit?id=' . $training->id) ?>"
						class="btn btn-warning mr-2">


						<i class="fas fa-edit mr-2"></i>

						Edit


					</a>




					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-outline-secondary">


						<i class="fas fa-arrow-left mr-2"></i>

						Kembali


					</a>


				</div>


			</div>


		</div>


	</div>





	<div class="row">


		<div class="col-lg-4">


			<div class="card shadow mb-4">


				<div class="card-body text-center">


					<div
						class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow"
						style="width:110px;height:110px;font-size:42px;">


						<i class="fas fa-chalkboard"></i>


					</div>




					<h4 class="font-weight-bold mt-3 mb-1">


						<?= $training->name ?>


					</h4>



					<p class="text-muted">


						<?= $training->code ?>


					</p>



					<?php if($training->isDraft()): ?>

						<span class="badge badge-secondary px-3 py-2">

							Draft

						</span>


					<?php elseif($training->isOpen()): ?>

						<span class="badge badge-success px-3 py-2">

							Pendaftaran Dibuka

						</span>


					<?php elseif($training->isClosed()): ?>

						<span class="badge badge-warning px-3 py-2">

							Pendaftaran Ditutup

						</span>


					<?php elseif($training->isRunning()): ?>

						<span class="badge badge-primary px-3 py-2">

							Sedang Berjalan

						</span>


					<?php elseif($training->isCompleted()): ?>

						<span class="badge badge-info px-3 py-2">

							Selesai

						</span>


					<?php elseif($training->isCancelled()): ?>

						<span class="badge badge-danger px-3 py-2">

							Dibatalkan

						</span>


					<?php endif; ?>



					<hr>



					<div class="text-left">


						<p>

							<i class="fas fa-layer-group text-primary mr-2"></i>


							<strong>

								Bidang

							</strong>


							<br>


							<span class="ml-4 text-muted">


								<?= $training->trainingField?->name ?? '-' ?>


							</span>


						</p>




						<p>

							<i class="fas fa-user-tie text-success mr-2"></i>


							<strong>

								Pelatih

							</strong>


							<br>


							<span class="ml-4 text-muted">


								<?= $training->trainer?->user?->name ?? '-' ?>


							</span>


						</p>




						<p>

							<i class="fas fa-map-marker-alt text-danger mr-2"></i>


							<strong>

								Lokasi

							</strong>


							<br>


							<span class="ml-4 text-muted">


								<?= $training->location ?: '-' ?>


							</span>


						</p>


					</div>


				</div>


			</div>


		</div>
		<div class="col-lg-8">


			<div class="row">


				<div class="col-md-4 mb-4">


					<div class="card border-left-primary shadow h-100">


						<div class="card-body">


							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Kuota Peserta

							</div>


							<h3 class="font-weight-bold mb-0">


								<?= $training->quota ?>


							</h3>


							<small class="text-muted">

								Peserta maksimal

							</small>


						</div>


					</div>


				</div>




				<div class="col-md-4 mb-4">


					<div class="card border-left-success shadow h-100">


						<div class="card-body">


							<div class="text-xs text-success font-weight-bold text-uppercase">

								Terdaftar

							</div>


							<h3 class="font-weight-bold mb-0">


								<?= $training->registrations->count() ?>


							</h3>


							<small class="text-muted">

								Peserta terdaftar

							</small>


						</div>


					</div>


				</div>




				<div class="col-md-4 mb-4">


					<div class="card border-left-warning shadow h-100">


						<div class="card-body">


							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Pertemuan

							</div>


							<h3 class="font-weight-bold mb-0">


								<?= $training->schedules->count() ?>


							</h3>


							<small class="text-muted">

								Jadwal dibuat

							</small>


						</div>


					</div>


				</div>


			</div>
			<div class="row">


				<div class="col-md-4 mb-4">


					<div class="card shadow h-100">


						<div class="card-header bg-white">


							<h6 class="font-weight-bold text-primary mb-0">


								<i class="fas fa-bullseye mr-2"></i>


								Tujuan


							</h6>


						</div>



						<div class="card-body">


							<?= nl2br(
								$training->objective ?: '-'
							) ?>


						</div>


					</div>


				</div>





				<div class="col-md-4 mb-4">


					<div class="card shadow h-100">


						<div class="card-header bg-white">


							<h6 class="font-weight-bold text-primary mb-0">


								<i class="fas fa-list-check mr-2"></i>


								Persyaratan


							</h6>


						</div>



						<div class="card-body">


							<?= nl2br(
								$training->requirement ?: '-'
							) ?>


						</div>


					</div>


				</div>





				<div class="col-md-4 mb-4">


					<div class="card shadow h-100">


						<div class="card-header bg-white">


							<h6 class="font-weight-bold text-primary mb-0">


								<i class="fas fa-gift mr-2"></i>


								Benefit


							</h6>


						</div>



						<div class="card-body">


							<?= nl2br(
								$training->benefit ?: '-'
							) ?>


						</div>


					</div>


				</div>


			</div>
			<div class="card shadow mb-4">


				<div class="card-header bg-white">


					<div class="d-flex justify-content-between align-items-center">


						<div>


							<h5 class="font-weight-bold text-primary mb-0">


								<i class="fas fa-calendar-check mr-2"></i>


								Jadwal Pertemuan


							</h5>


							<small class="text-muted">


								Dibuat otomatis berdasarkan durasi pelatihan.


							</small>


						</div>



						<span class="badge badge-primary px-3 py-2">


							<?= $training->schedules->count() ?>

							Pertemuan


						</span>


					</div>


				</div>





				<div class="card-body">


					<?php if($training->schedules->isEmpty()): ?>


						<div class="text-center py-4">


							<i class="fas fa-calendar-times fa-3x text-gray-300 mb-3"></i>


							<h6 class="font-weight-bold">


								Belum Ada Jadwal


							</h6>


							<p class="text-muted mb-0">


								Belum ada pertemuan yang dibuat.


							</p>


						</div>



					<?php else: ?>



						<div class="table-responsive">


							<table class="table table-hover">


								<thead class="thead-light">


								<tr>


									<th width="80">

										#

									</th>


									<th>

										Topik

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


								</tr>


								</thead>



								<tbody>



								<?php foreach($training->schedules as $schedule): ?>



									<tr>


										<td>


											<span class="badge badge-primary">


												<?= $schedule->meeting_number ?>


											</span>


										</td>




										<td>


											<div class="font-weight-bold">


												<?= $schedule->topic ?: 'Pertemuan ' . $schedule->meeting_number ?>


											</div>



											<?php if($schedule->description): ?>


												<small class="text-muted">


													<?= $schedule->description ?>


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


												<span class="badge badge-success">


													Hari Ini


												</span>



											<?php elseif($schedule->isPast()): ?>


												<span class="badge badge-secondary">


													Selesai


												</span>



											<?php elseif($schedule->isUpcoming()): ?>


												<span class="badge badge-info">


													Akan Datang


												</span>



											<?php else: ?>


												<span class="badge badge-light">


													-


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
			<div class="card shadow mb-4">


				<div class="card-header bg-white">


					<div class="d-flex justify-content-between align-items-center">


						<div>


							<h5 class="font-weight-bold text-primary mb-0">


								<i class="fas fa-users mr-2"></i>


								Peserta Terdaftar


							</h5>


							<small class="text-muted">


								Daftar peserta yang mengikuti pelatihan.


							</small>


						</div>



						<span class="badge badge-success px-3 py-2">


							<?= $training->registrations->count() ?>

							Peserta


						</span>


					</div>


				</div>



				<div class="card-body">


					<?php if($training->registrations->isEmpty()): ?>


						<div class="text-center py-4">


							<i class="fas fa-user-slash fa-3x text-gray-300 mb-3"></i>


							<h6 class="font-weight-bold">


								Belum Ada Peserta


							</h6>


							<p class="text-muted mb-0">


								Belum ada peserta yang mendaftar.


							</p>


						</div>



					<?php else: ?>



						<div class="table-responsive">


							<table class="table table-hover">


								<thead class="thead-light">


								<tr>


									<th width="60">

										#

									</th>


									<th>

										Peserta

									</th>


									<th>

										Email

									</th>


									<th>

										Tanggal Daftar

									</th>


									<th>

										Status

									</th>


								</tr>


								</thead>



								<tbody>



								<?php foreach($training->registrations as $i => $registration): ?>



									<tr>


										<td>

											<?= $i + 1 ?>

										</td>



										<td>


											<div class="d-flex align-items-center">


												<div
													class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
													style="width:40px;height:40px;">


													<?= strtoupper(
														substr(
															$registration->participant?->user?->name ?? 'U',
															0,
															1
														)
													) ?>


												</div>



												<div>


													<div class="font-weight-bold">


														<?= $registration->participant?->user?->name ?? '-' ?>


													</div>


													<small class="text-muted">


														ID #<?= $registration->participant_id ?>


													</small>


												</div>


											</div>


										</td>



										<td>


											<?= $registration->participant?->user?->email ?? '-' ?>


										</td>



										<td>


											<?= $registration->created_at?->format('d M Y') ?>


										</td>



										<td>


											<span class="badge badge-success">


												Terdaftar


											</span>


										</td>



									</tr>



								<?php endforeach; ?>



								</tbody>


							</table>


						</div>



					<?php endif; ?>


				</div>


			</div>
			<div class="card shadow mb-4">


				<div class="card-header bg-white">


					<h5 class="font-weight-bold text-primary mb-0">


						<i class="fas fa-info-circle mr-2"></i>


						Informasi Sistem


					</h5>


				</div>



				<div class="card-body">


					<div class="row">


						<div class="col-md-6 mb-3">


							<label class="text-muted small">

								Dibuat Oleh

							</label>


							<div class="font-weight-bold">


								<?= $training->creator?->name ?? '-' ?>


							</div>


						</div>




						<div class="col-md-6 mb-3">


							<label class="text-muted small">

								Diperbarui Oleh

							</label>


							<div class="font-weight-bold">


								<?= $training->updater?->name ?? '-' ?>


							</div>


						</div>




						<div class="col-md-6">


							<label class="text-muted small">

								Dibuat Pada

							</label>


							<div>


								<?= $training->created_at?->format('d M Y H:i') ?>


							</div>


						</div>




						<div class="col-md-6">


							<label class="text-muted small">

								Update Terakhir

							</label>


							<div>


								<?= $training->updated_at?->format('d M Y H:i') ?>


							</div>


						</div>


					</div>


				</div>


			</div>
		</div>


	</div>


</div>
