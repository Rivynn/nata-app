<div class="container-fluid">

	<!-- Header -->

	<div class="card border-0 shadow mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-md-8">

					<h3 class="font-weight-bold text-primary mb-2">

						Daftar Pelatihan

					</h3>

					<p class="text-muted mb-0">

						Pilih pelatihan yang sesuai dengan minat dan kemampuan Anda.
						Sebelum melakukan pendaftaran, pastikan seluruh biodata peserta telah dilengkapi.

					</p>

				</div>

				<?php if ($profileCompleted): ?>

					<div class="col-md-4 text-md-right mt-3 mt-md-0">

                        <span class="badge badge-success px-3 py-2">

                            <?= $trainings->count() ?>

                            Pelatihan Tersedia

                        </span>

					</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

	<?php if ($activeRegistration): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<div class="mb-4">

					<i class="fas fa-user-graduate fa-5x text-primary"></i>

				</div>

				<h3 class="font-weight-bold mb-3">

					Anda Sedang Mengikuti Pelatihan

				</h3>

				<p class="text-muted mb-4">

					Anda hanya dapat mengikuti <strong>satu pelatihan aktif</strong> dalam satu waktu.
					Selesaikan pelatihan yang sedang berjalan terlebih dahulu sebelum mendaftar pelatihan lainnya.

				</p>

				<div class="alert alert-light border mx-auto mb-4" style="max-width:600px;">

					<h5 class="font-weight-bold text-primary mb-2">

						<?= e($activeRegistration->training->name) ?>

					</h5>

					<div class="mb-2">

						<?= e($activeRegistration->training->trainingField?->name ?? '-') ?>

					</div>

					<span class="badge badge-success px-3 py-2">

                Status :

                <?= ucfirst($activeRegistration->status) ?>

            </span>

				</div>

				<a
					href="<?= url('/peserta/trainings/show?id=' . $activeRegistration->training_id) ?>"
					class="btn btn-primary btn-lg">

					<i class="fas fa-arrow-right mr-2"></i>

					Lihat Pelatihan Saya

				</a>

			</div>

		</div>

		<?php return; ?>

	<?php endif; ?>
	<!-- Filter -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<form method="GET">

				<div class="form-row align-items-end">

					<div class="col-lg-5 mb-3">

						<label class="font-weight-bold">

							Cari Pelatihan

						</label>

						<div class="input-group">

							<div class="input-group-prepend">

                                <span class="input-group-text">

                                    <i class="fas fa-search"></i>

                                </span>

							</div>

							<input
								type="text"
								name="keyword"
								class="form-control"
								placeholder="Nama pelatihan..."
								value="<?= e($filters['keyword'] ?? '') ?>">

						</div>

					</div>

					<div class="col-lg-3 mb-3">

						<label class="font-weight-bold">

							Kategori

						</label>

						<select
							name="field"
							class="form-control">

							<option value="">

								Semua Kategori

							</option>

							<?php foreach ($fields as $field): ?>

								<option
									value="<?= $field->id ?>"
									<?= ($filters['field'] == $field->id) ? 'selected' : '' ?>>

									<?= e($field->name) ?>

								</option>

							<?php endforeach; ?>

						</select>

					</div>

					<div class="col-lg-2 mb-3">

						<label class="font-weight-bold">

							Urutkan

						</label>

						<select
							name="sort"
							class="form-control">

							<option
								value="latest"
								<?= ($filters['sort'] === 'latest') ? 'selected' : '' ?>>

								Terbaru

							</option>

							<option
								value="oldest"
								<?= ($filters['sort'] === 'oldest') ? 'selected' : '' ?>>

								Terlama

							</option>

						</select>

					</div>

					<div class="col-lg-2 mb-3">

						<button class="btn btn-primary btn-block">

							<i class="fas fa-search mr-1"></i>

							Cari

						</button>

					</div>

				</div>

			</form>

		</div>

	</div>
	<?php if (!empty($trainings) && $trainings->count()): ?>

	<div class="row">

		<?php foreach ($trainings as $training): ?>

			<div class="col-xl-4 col-lg-6 mb-4">

				<div class="card shadow border-0 h-100">

					<div class="card-body d-flex flex-column">

						<div class="d-flex justify-content-between align-items-center mb-3">

                            <span class="badge badge-<?= $training->trainingField?->color ?? 'primary' ?>">

                                <i class="<?= $training->trainingField?->icon ?? 'fas fa-book-open' ?> mr-1"></i>

                                <?= e($training->trainingField?->name ?? '-') ?>

                            </span>

							<span class="badge badge-success">

                                Dibuka

                            </span>

						</div>

						<h5 class="font-weight-bold">

							<?= e($training->name) ?>

						</h5>

						<p class="text-muted small mb-3">

							<?= e($training->description) ?>

						</p>

						<div class="mb-3">

							<small class="text-muted">

								Kuota Peserta

							</small>

							<div
								class="progress mt-2"
								style="height:8px;">

								<div
									class="progress-bar bg-primary"
									style="width:100%">

								</div>

							</div>

							<small class="font-weight-bold text-primary">

								<?= $training->quota ?>

								Peserta

							</small>

						</div>

						<table class="table table-sm table-borderless mb-4">

							<tr>

								<td width="35">

									<i class="fas fa-clock text-warning"></i>

								</td>

								<td>

									<?= $training->duration ?>

									Hari

								</td>

							</tr>

							<tr>

								<td>

									<i class="fas fa-map-marker-alt text-danger"></i>

								</td>

								<td>

									<?= e($training->location) ?>

								</td>

							</tr>

							<tr>

								<td>

									<i class="fas fa-chalkboard-teacher text-success"></i>

								</td>

								<td>

									<?= e($training->trainer?->user?->name ?? '-') ?>

									<br>

									<small class="text-muted">

										<?= e($training->trainer?->institution ?? '-') ?>

									</small>

								</td>

							</tr>

							<tr>

								<td>

									<i class="fas fa-calendar text-info"></i>

								</td>

								<td>

									<?= $training->registration_open?->format('d M Y') ?>

									-

									<?= $training->registration_close?->format('d M Y') ?>

								</td>

							</tr>

						</table>

						<div class="mt-auto">

							<div class="row">

								<div class="col-5">

									<a
										href="<?= url('/peserta/trainings/show?id=' . $training->id) ?>"
										class="btn btn-outline-secondary btn-block">

										<i class="fas fa-eye mr-1"></i>

										Detail

									</a>

								</div>

								<div class="col-7">
									<?php if ($activeRegistration): ?>

										<button
											class="btn btn-secondary btn-block"
											disabled>

											<i class="fas fa-lock mr-2"></i>

											Sudah Terdaftar

										</button>

									<?php else: ?>

										<a
											href="<?= url('/peserta/registrations/create?id=' . $training->id) ?>"
											class="btn btn-primary btn-block">

											<i class="fas fa-paper-plane mr-2"></i>

											Daftar

										</a>

									<?php endif; ?>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		<?php endforeach; ?>

	</div>
	<?php else: ?>

	<div class="card shadow border-0">

		<div class="card-body text-center py-5">

			<i class="fas fa-book-open fa-4x text-gray-300 mb-3"></i>

			<h4 class="font-weight-bold">

				Belum Ada Pelatihan

			</h4>

			<p class="text-muted mb-4">

				Saat ini belum ada pelatihan yang tersedia.
				Silakan kembali beberapa waktu lagi.

			</p>

			<a
				href="<?= url('/peserta') ?>"
				class="btn btn-outline-primary">

				<i class="fas fa-home mr-2"></i>

				Kembali ke Dashboard

			</a>

		</div>

	</div>

	<?php endif; ?>



</div>
