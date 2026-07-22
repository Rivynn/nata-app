<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Edit Jadwal Pertemuan

					</h4>


					<p class="text-muted mb-0">

						Perbarui informasi jadwal pelatihan.

					</p>


				</div>



				<a
					href="<?= url('/admin/schedules') ?>"
					class="btn btn-outline-secondary">


					<i class="fas fa-arrow-left mr-2"></i>

					Kembali


				</a>


			</div>


		</div>





		<form
			method="POST"
			action="<?= url('/admin/schedules/update') ?>">



			<input
				type="hidden"
				name="id"
				value="<?= $schedule->id ?>">



			<div class="card-body">



				<div class="row">



					<div class="col-lg-8">



						<div class="card border-left-primary shadow-sm mb-4">


							<div class="card-header bg-white">


								<h6 class="font-weight-bold text-primary mb-0">


									<i class="fas fa-graduation-cap mr-2"></i>


									Informasi Pelatihan


								</h6>


							</div>



							<div class="card-body">


								<div class="row">


									<div class="col-md-6">


										<label class="text-muted small">

											Nama Pelatihan

										</label>


										<div class="font-weight-bold">


											<?= $schedule->training?->name ?? '-' ?>


										</div>


									</div>




									<div class="col-md-6">


										<label class="text-muted small">

											Pelatih

										</label>


										<div class="font-weight-bold">


											<?= $schedule->training?->trainer?->user?->name ?? '-' ?>


										</div>


									</div>



								</div>


							</div>


						</div>
						<div class="card shadow-sm">


							<div class="card-header bg-white">


								<h6 class="font-weight-bold text-primary mb-0">


									<i class="fas fa-calendar-alt mr-2"></i>


									Detail Pertemuan


								</h6>


							</div>




							<div class="card-body">



								<div class="form-row">



									<div class="form-group col-md-4">


										<label>

											Nomor Pertemuan

										</label>


										<input
											type="number"
											class="form-control"
											value="<?= $schedule->meeting_number ?>"
											readonly>


										<small class="text-muted">

											Nomor dibuat otomatis sistem.

										</small>


									</div>





									<div class="form-group col-md-8">


										<label>

											Topik Pertemuan

										</label>


										<input
											type="text"
											name="topic"
											class="form-control"
											value="<?= $schedule->topic ?>"
											placeholder="Contoh: Pengenalan Dasar Web">


									</div>


								</div>





								<div class="form-group">


									<label>

										Deskripsi

									</label>


									<textarea
										name="description"
										rows="4"
										class="form-control"
										placeholder="Deskripsi materi/pertemuan"><?= $schedule->description ?></textarea>


								</div>





								<div class="form-row">



									<div class="form-group col-md-4">


										<label>

											Tanggal

										</label>


										<input
											type="date"
											name="schedule_date"
											class="form-control"
											value="<?= $schedule->schedule_date?->format('Y-m-d') ?>"
											required>


									</div>





									<div class="form-group col-md-4">


										<label>

											Jam Mulai

										</label>


										<input
											type="time"
											name="start_time"
											class="form-control"
											value="<?= $schedule->start_time ?>"
											required>


									</div>





									<div class="form-group col-md-4">


										<label>

											Jam Selesai

										</label>


										<input
											type="time"
											name="end_time"
											class="form-control"
											value="<?= $schedule->end_time ?>"
											required>


									</div>


								</div>





								<div class="form-group">


									<label>

										Ruangan

									</label>


									<input
										type="text"
										name="room"
										class="form-control"
										value="<?= $schedule->room ?>"
										placeholder="Contoh: Lab Komputer">


								</div>



							</div>


						</div>



					</div>
					<div class="col-lg-4">



						<div class="card border-left-info shadow-sm mb-4">


							<div class="card-body">


								<h6 class="font-weight-bold text-info">


									<i class="fas fa-info-circle mr-2"></i>


									Informasi Jadwal


								</h6>



								<hr>



								<p class="small text-muted mb-2">


									Pertemuan:


									<strong>


										<?= $schedule->meeting_number ?>


									</strong>


								</p>



								<p class="small text-muted mb-2">


									Dibuat:


									<strong>


										<?= $schedule->created_at?->format('d M Y H:i') ?>


									</strong>


								</p>



								<p class="small text-muted mb-0">


									Update:


									<strong>


										<?= $schedule->updated_at?->format('d M Y H:i') ?>


									</strong>


								</p>


							</div>


						</div>





						<div class="card border-left-warning shadow-sm">


							<div class="card-body">


								<h6 class="font-weight-bold text-warning">


									<i class="fas fa-exclamation-triangle mr-2"></i>


									Catatan


								</h6>



								<p class="small text-muted mb-0">


									Mengubah jadwal tidak akan membuat ulang absensi.
									Data kehadiran peserta tetap tersimpan.


								</p>


							</div>


						</div>



					</div>


				</div>


			</div>
			<div class="card-footer bg-white">


				<div class="d-flex justify-content-between">


					<a
						href="<?= url('/admin/schedules') ?>"
						class="btn btn-outline-secondary">


						<i class="fas fa-arrow-left mr-2"></i>

						Kembali


					</a>





					<button
						type="submit"
						class="btn btn-primary">


						<i class="fas fa-save mr-2"></i>

						Update Jadwal


					</button>


				</div>


			</div>



		</form>


	</div>


</div>
