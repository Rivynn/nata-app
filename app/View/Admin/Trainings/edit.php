<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Edit Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Perbarui informasi program pelatihan.

					</p>


				</div>



				<a
					href="<?= url('/admin/trainings') ?>"
					class="btn btn-outline-secondary">


					<i class="fas fa-arrow-left mr-2"></i>

					Kembali


				</a>


			</div>


		</div>



		<form
			method="POST"
			action="<?= url('/admin/trainings/update') ?>">



			<input
				type="hidden"
				name="id"
				value="<?= $training->id ?>">



			<div class="card-body">


				<div class="row">


					<div class="col-lg-8">



						<div class="form-group">


							<label>

								Nama Pelatihan

							</label>


							<input
								type="text"
								name="name"
								class="form-control"
								value="<?= $training->name ?>"
								required>


						</div>




						<div class="form-row">


							<div class="form-group col-md-6">


								<label>

									Bidang Pelatihan

								</label>


								<select
									name="training_field_id"
									class="form-control"
									required>


									<option value="">

										-- Pilih Bidang --

									</option>


									<?php foreach($fields as $field): ?>


										<option
											value="<?= $field->id ?>"
											<?= $training->training_field_id == $field->id ? 'selected' : '' ?>>


											<?= $field->name ?>


										</option>


									<?php endforeach; ?>


								</select>


							</div>




							<div class="form-group col-md-6">


								<label>

									Pelatih

								</label>


								<select
									name="trainer_id"
									class="form-control"
									required>


									<option value="">

										-- Pilih Pelatih --

									</option>



									<?php foreach($trainers as $trainer): ?>


										<option
											value="<?= $trainer->id ?>"
											<?= $training->trainer_id == $trainer->id ? 'selected' : '' ?>>


											<?= $trainer->user?->name ?? '-' ?>


										</option>


									<?php endforeach; ?>


								</select>


							</div>


						</div>




						<div class="form-group">


							<label>

								Deskripsi

							</label>


							<textarea
								name="description"
								rows="4"
								class="form-control"><?= $training->description ?></textarea>


						</div>




						<div class="form-group">


							<label>

								Tujuan Pelatihan

							</label>


							<textarea
								name="objective"
								rows="3"
								class="form-control"><?= $training->objective ?></textarea>


						</div>
						<div class="form-group">


							<label>

								Persyaratan Peserta

							</label>


							<textarea
								name="requirement"
								rows="3"
								class="form-control"
								placeholder="Syarat peserta mengikuti pelatihan"><?= $training->requirement ?></textarea>


						</div>




						<div class="form-group">


							<label>

								Benefit Pelatihan

							</label>


							<textarea
								name="benefit"
								rows="3"
								class="form-control"
								placeholder="Keuntungan yang didapat peserta"><?= $training->benefit ?></textarea>


						</div>





						<div class="form-row">


							<div class="form-group col-md-4">


								<label>

									Kuota Peserta

								</label>


								<input
									type="number"
									name="quota"
									class="form-control"
									min="1"
									value="<?= $training->quota ?>"
									required>


							</div>




							<div class="form-group col-md-4">


								<label>

									Durasi

								</label>


								<div class="input-group">


									<input
										type="number"
										name="duration"
										class="form-control"
										min="1"
										value="<?= $training->duration ?>"
										required>


									<div class="input-group-append">

										<span class="input-group-text">

											Hari

										</span>

									</div>


								</div>


							</div>




							<div class="form-group col-md-4">


								<label>

									Lokasi

								</label>


								<input
									type="text"
									name="location"
									class="form-control"
									value="<?= $training->location ?>"
									placeholder="Contoh: Ruang Training">


							</div>


						</div>




						<hr>



						<h5 class="font-weight-bold text-primary mb-3">


							<i class="fas fa-calendar-alt mr-2"></i>


							Jadwal Pelaksanaan


						</h5>




						<div class="form-row">


							<div class="form-group col-md-6">


								<label>

									Pendaftaran Dibuka

								</label>


								<input
									type="date"
									name="registration_open"
									class="form-control"
									value="<?= $training->registration_open?->format('Y-m-d') ?>"
									required>


							</div>




							<div class="form-group col-md-6">


								<label>

									Pendaftaran Ditutup

								</label>


								<input
									type="date"
									name="registration_close"
									class="form-control"
									value="<?= $training->registration_close?->format('Y-m-d') ?>"
									required>


							</div>


						</div>




						<div class="form-row">


							<div class="form-group col-md-6">


								<label>

									Mulai Pelatihan

								</label>


								<input
									type="date"
									name="training_start"
									class="form-control"
									value="<?= $training->training_start?->format('Y-m-d') ?>"
									required>


							</div>




							<div class="form-group col-md-6">


								<label>

									Selesai Pelatihan

								</label>


								<input
									type="date"
									name="training_end"
									class="form-control"
									value="<?= $training->training_end?->format('Y-m-d') ?>">


							</div>


						</div>
						<hr>



						<h5 class="font-weight-bold text-primary mb-3">


							<i class="fas fa-calendar-check mr-2"></i>


							Jadwal Pertemuan


						</h5>




						<div class="alert alert-info">


							<i class="fas fa-info-circle mr-2"></i>


							Jadwal pertemuan sudah dibuat saat pelatihan dibuat.
							Untuk mengubah jadwal, kelola melalui menu jadwal.


						</div>





						<div class="card border-left-primary shadow-sm mb-4">


							<div class="card-body">


								<div class="row text-center">


									<div class="col-md-4">


										<h5 class="font-weight-bold text-primary mb-1">


											<?= $training->schedules()->count() ?>


										</h5>


										<small class="text-muted">


											Total Pertemuan


										</small>


									</div>





									<div class="col-md-4">


										<h5 class="font-weight-bold text-success mb-1">


											<?= $training->schedules()->first()?->start_time ?? '-' ?>


										</h5>


										<small class="text-muted">


											Jam Mulai


										</small>


									</div>





									<div class="col-md-4">


										<h5 class="font-weight-bold text-warning mb-1">


											<?= $training->schedules()->first()?->room ?? '-' ?>


										</h5>


										<small class="text-muted">


											Ruangan


										</small>


									</div>


								</div>


							</div>


						</div>
						<div class="col-lg-4">


							<div class="card border-left-warning shadow-sm mb-4">


								<div class="card-header bg-white">


									<h6 class="font-weight-bold text-warning mb-0">


										Informasi Update


									</h6>


								</div>



								<div class="card-body">


									<p class="small text-muted">


										Perubahan data tidak akan membuat ulang jadwal pertemuan.


									</p>



									<ul class="list-group">


										<li class="list-group-item">


											<i class="fas fa-calendar-check text-primary mr-2"></i>


											<?= $training->schedules()->count() ?>

											Pertemuan Aktif


										</li>




										<li class="list-group-item">


											<i class="fas fa-users text-success mr-2"></i>


											<?= $training->registrations()->count() ?>

											Peserta Terdaftar


										</li>




										<li class="list-group-item">


											<i class="fas fa-clock text-warning mr-2"></i>


											<?= $training->duration ?>

											Hari


										</li>


									</ul>


								</div>


							</div>





							<div class="card border-left-primary shadow-sm">


								<div class="card-body">


									<h6 class="font-weight-bold text-primary">


										<i class="fas fa-history mr-2"></i>


										Riwayat


									</h6>



									<p class="small text-muted mb-1">


										Dibuat:


										<?= $training->created_at?->format('d M Y H:i') ?>


									</p>



									<p class="small text-muted mb-0">


										Update:


										<?= $training->updated_at?->format('d M Y H:i') ?>


									</p>


								</div>


							</div>



						</div>
					</div>


				</div>





				<div class="card-footer bg-white">


					<div class="d-flex justify-content-between">


						<a
							href="<?= url('/admin/trainings') ?>"
							class="btn btn-outline-secondary">


							<i class="fas fa-arrow-left mr-2"></i>

							Kembali


						</a>




						<button
							type="submit"
							class="btn btn-primary">


							<i class="fas fa-save mr-2"></i>

							Update Pelatihan


						</button>


					</div>


				</div>



		</form>


	</div>


</div>
