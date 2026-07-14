<div class="container-fluid">

	<div class="row justify-content-center">

		<div class="col-lg-10">

			<div class="card shadow mb-4">

				<div class="card-header bg-white py-3">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<h4 class="font-weight-bold text-primary mb-1">

								Edit Jadwal Pelatihan

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
						value="<?= $schedule['id'] ?>">

					<div class="card-body">

						<div class="row">

							<div class="col-md-8">

								<div class="form-group">

									<label>

										Judul Jadwal

									</label>

									<input
										type="text"
										name="title"
										class="form-control"
										value="<?= $schedule['title'] ?>"
										required>

								</div>

								<div class="form-group">

									<label>

										Pelatihan

									</label>

									<select
										name="training_id"
										class="form-control"
										required>

										<?php foreach($trainings as $training): ?>

											<option
												value="<?= $training['id'] ?>"
												<?= $training['id'] == $schedule['training_id'] ? 'selected' : '' ?>>

												<?= $training['name'] ?>

											</option>

										<?php endforeach; ?>

									</select>

								</div>

								<div class="form-group">

									<label>

										Pelatih

									</label>

									<select
										name="trainer_id"
										class="form-control"
										required>

										<?php foreach($trainers as $trainer): ?>

											<option
												value="<?= $trainer['id'] ?>"
												<?= $trainer['id'] == $schedule['trainer_id'] ? 'selected' : '' ?>>

												<?= $trainer['name'] ?>

											</option>

										<?php endforeach; ?>

									</select>

								</div>

								<div class="form-row">

									<div class="form-group col-md-8">

										<label>

											Lokasi

										</label>

										<input
											type="text"
											name="location"
											class="form-control"
											value="<?= $schedule['location'] ?>"
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
											value="<?= $schedule['room'] ?>">

									</div>

								</div>
								<div class="form-row">

									<div class="form-group col-md-6">

										<label>

											Tanggal Mulai

										</label>

										<input
											type="date"
											name="start_date"
											class="form-control"
											value="<?= $schedule['start_date'] ?>"
											required>

									</div>

									<div class="form-group col-md-6">

										<label>

											Tanggal Selesai

										</label>

										<input
											type="date"
											name="end_date"
											class="form-control"
											value="<?= $schedule['end_date'] ?>"
											required>

									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-md-6">

										<label>

											Jam Mulai

										</label>

										<input
											type="time"
											name="start_time"
											class="form-control"
											value="<?= $schedule['start_time'] ?>"
											required>

									</div>

									<div class="form-group col-md-6">

										<label>

											Jam Selesai

										</label>

										<input
											type="time"
											name="end_time"
											class="form-control"
											value="<?= $schedule['end_time'] ?>"
											required>

									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-md-6">

										<label>

											Kuota Peserta

										</label>

										<input
											type="number"
											name="max_participants"
											class="form-control"
											min="1"
											value="<?= $schedule['max_participants'] ?>">

									</div>

									<div class="form-group col-md-6">

										<label>

											Status

										</label>

										<select
											name="status"
											class="form-control">

											<option
												value="draft"
												<?= $schedule['status'] == 'draft' ? 'selected' : '' ?>>

												Draft

											</option>

											<option
												value="scheduled"
												<?= $schedule['status'] == 'scheduled' ? 'selected' : '' ?>>

												Terjadwal

											</option>

											<option
												value="ongoing"
												<?= $schedule['status'] == 'ongoing' ? 'selected' : '' ?>>

												Berlangsung

											</option>

											<option
												value="completed"
												<?= $schedule['status'] == 'completed' ? 'selected' : '' ?>>

												Selesai

											</option>

											<option
												value="cancelled"
												<?= $schedule['status'] == 'cancelled' ? 'selected' : '' ?>>

												Dibatalkan

											</option>

										</select>

									</div>

								</div>

								<div class="form-group">

									<label>

										Catatan

									</label>

									<textarea
										name="notes"
										rows="5"
										class="form-control"><?= $schedule['notes'] ?></textarea>

								</div>

							</div>

							<div class="col-md-4">

								<div class="card border-left-primary shadow-sm">

									<div class="card-header bg-white">

										<h6 class="font-weight-bold text-primary mb-0">

											Ringkasan Jadwal

										</h6>

									</div>

									<div class="card-body">

										<p>

											<i class="fas fa-book text-primary mr-2"></i>

											<?= $schedule['training_name'] ?>

										</p>

										<p>

											<i class="fas fa-chalkboard-teacher text-success mr-2"></i>

											<?= $schedule['trainer_name'] ?>

										</p>

										<p>

											<i class="fas fa-map-marker-alt text-danger mr-2"></i>

											<?= $schedule['location'] ?>

										</p>

										<p>

											<i class="fas fa-users text-info mr-2"></i>

											<?= $schedule['max_participants'] ?>

											Peserta

										</p>

										<hr>

										<?php

											$badge = match($schedule['status']){

												'draft' => 'secondary',

												'scheduled' => 'primary',

												'ongoing' => 'warning',

												'completed' => 'success',

												default => 'danger',

											};

										?>

										<span class="badge badge-<?= $badge ?> px-3 py-2">

											<?= ucfirst($schedule['status']) ?>

										</span>

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

							<div>

								<button
									type="reset"
									class="btn btn-outline-warning mr-2">

									<i class="fas fa-undo mr-2"></i>

									Reset

								</button>

								<button
									type="submit"
									class="btn btn-primary">

									<i class="fas fa-save mr-2"></i>

									Update Jadwal

								</button>

							</div>

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>