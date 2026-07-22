<div class="container-fluid">


	<div class="card shadow border-0 mb-4">


		<div class="card-header bg-white py-3">


			<div class="d-flex justify-content-between align-items-center">


				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Tambah Pelatihan

					</h4>


					<p class="text-muted mb-0">

						Buat program pelatihan baru dan generate jadwal otomatis.

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
			action="<?= url('/admin/trainings/store') ?>">


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


										<option value="<?= $field->id ?>">

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


										<option value="<?= $trainer->id ?>">


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
								class="form-control"></textarea>


						</div>



						<div class="form-group">


							<label>

								Tujuan Pelatihan

							</label>


							<textarea
								name="objective"
								rows="3"
								class="form-control"></textarea>


						</div>
						<div class="form-group">


							<label>

								Persyaratan Peserta

							</label>


							<textarea
								name="requirement"
								rows="3"
								class="form-control"
								placeholder="Syarat peserta mengikuti pelatihan"></textarea>


						</div>




						<div class="form-group">


							<label>

								Benefit Pelatihan

							</label>


							<textarea
								name="benefit"
								rows="3"
								class="form-control"
								placeholder="Keuntungan yang didapat peserta"></textarea>


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
										id="duration"
										class="form-control"
										min="1"
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
									required>


							</div>




							<div class="form-group col-md-6">


								<label>

									Selesai Pelatihan

								</label>


								<input
									type="date"
									name="training_end"
									class="form-control">


							</div>


						</div>
						<hr>


						<h5 class="font-weight-bold text-primary mb-3">

							<i class="fas fa-calendar-check mr-2"></i>

							Generate Pertemuan Otomatis

						</h5>



						<div class="alert alert-info">


							<i class="fas fa-info-circle mr-2"></i>


							Sistem akan membuat jadwal pertemuan otomatis berdasarkan durasi pelatihan.


						</div>




						<div class="form-row">


							<div class="form-group col-md-4">


								<label>

									Jam Mulai

								</label>


								<input
									type="time"
									name="start_time"
									class="form-control"
									value="08:00"
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
									value="16:00"
									required>


							</div>




							<div class="form-group col-md-4">


								<label>

									Ruangan

								</label>


								<input
									type="text"
									name="room"
									class="form-control"
									placeholder="Contoh: Ruang Komputer">


							</div>


						</div>




						<div class="form-group">


							<label>

								Status Awal

							</label>


							<select
								name="status"
								class="form-control">


								<option value="draft">

									Draft

								</option>


								<option value="open">

									Buka Pendaftaran

								</option>


							</select>


						</div>



					</div>
					<div class="col-lg-4">


						<div class="card border-left-primary shadow-sm mb-4">


							<div class="card-header bg-white">


								<h6 class="font-weight-bold text-primary mb-0">


									Informasi Generate


								</h6>


							</div>



							<div class="card-body">


								<p class="text-muted small">


									Setelah pelatihan disimpan, sistem otomatis membuat jadwal:


								</p>



								<ul class="list-group">


									<li class="list-group-item">


										<i class="fas fa-calendar text-primary mr-2"></i>


										Pertemuan 1


									</li>


									<li class="list-group-item">


										<i class="fas fa-calendar text-primary mr-2"></i>


										Pertemuan 2


									</li>


									<li class="list-group-item">


										<i class="fas fa-calendar text-primary mr-2"></i>


										Pertemuan sesuai durasi


									</li>


								</ul>



							</div>


						</div>




						<div class="card border-left-success shadow-sm">


							<div class="card-body">


								<h6 class="font-weight-bold text-success">


									Alur Sistem


								</h6>



								<p class="small text-muted mb-1">


									1. Buat pelatihan


								</p>


								<p class="small text-muted mb-1">


									2. Generate jadwal otomatis


								</p>


								<p class="small text-muted mb-0">


									3. Peserta melakukan registrasi


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

						Simpan Pelatihan


					</button>


				</div>


			</div>


		</form>


	</div>


</div>
