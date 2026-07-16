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

				<?php if($profileCompleted): ?>

					<div class="col-md-4 text-md-right mt-3 mt-md-0">

						<span class="badge badge-success px-3 py-2">

							<?= count($trainings) ?>

							Pelatihan Tersedia

						</span>

					</div>

				<?php endif; ?>

			</div>

		</div>

	</div>

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

								value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

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

							<?php foreach($fields as $field): ?>

								<option
									value="<?= $field['id'] ?>"
									<?= (($_GET['field'] ?? '') == $field['id']) ? 'selected' : '' ?>>

									<?= $field['name'] ?>

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

							<option value="latest">

								Terbaru

							</option>

							<option value="quota">

								Kuota

							</option>

							<option value="name">

								Nama A-Z

							</option>

						</select>

					</div>

					<div class="col-lg-2 mb-3">

						<button
							class="btn btn-primary btn-block">

							<i class="fas fa-search mr-1"></i>

							Cari

						</button>

					</div>

				</div>

			</form>

		</div>

	</div>
	<?php if(!$profileCompleted): ?>

		<div class="card shadow border-left-warning">

			<div class="card-body py-5">

				<div class="row align-items-center">

					<div class="col-lg-8">

						<div class="d-flex">

							<div class="mr-4">

								<div
									class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
									style="width:90px;height:90px;">

									<i class="fas fa-user-edit fa-3x"></i>

								</div>

							</div>

							<div>

								<h4 class="font-weight-bold text-warning mb-3">

									Lengkapi Profil Terlebih Dahulu

								</h4>

								<p class="text-muted mb-3">

									Untuk menjaga validitas data peserta, Anda diwajibkan melengkapi
									biodata serta mengunggah dokumen pendukung sebelum dapat
									melakukan pendaftaran pelatihan.

								</p>

								<div class="alert alert-warning mb-0">

									<i class="fas fa-exclamation-circle mr-2"></i>

									Silakan lengkapi data seperti
									<strong>NIK</strong>,
									<strong>alamat</strong>,
									<strong>pendidikan</strong>,
									<strong>status pekerjaan</strong>,
									<strong>foto KTP</strong>,
									<strong>pas foto</strong>,
									dan
									<strong>ijazah terakhir</strong>.

								</div>

							</div>

						</div>

					</div>

					<div class="col-lg-4 text-center text-lg-right mt-4 mt-lg-0">

						<a
							href="<?= url('/peserta/profile') ?>"
							class="btn btn-warning btn-lg shadow">

							<i class="fas fa-user-edit mr-2"></i>

							Lengkapi Profil

						</a>

					</div>

				</div>

			</div>

		</div>

	<?php else: ?>

		<?php if (!empty($trainings)): ?>

			<div class="row">

				<?php foreach ($trainings as $training): ?>

					<div class="col-xl-4 col-lg-6 mb-4">

						<div class="card shadow border-0 h-100">

							<div class="card-body d-flex flex-column">

								<div class="d-flex justify-content-between align-items-center mb-3">

									<span class="badge badge-<?= $training['color'] ?? 'primary' ?>">

										<i class="<?= $training['icon'] ?? 'fas fa-book-open' ?> mr-1"></i>

										<?= $training['field_name'] ?>

									</span>

									<span class="badge badge-success">

										Dibuka

									</span>

								</div>

								<h5 class="font-weight-bold">

									<?= htmlspecialchars($training['name']) ?>

								</h5>

								<p class="text-muted small mb-3">

									<?= htmlspecialchars($training['description']) ?>

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

										<?= $training['quota'] ?>

										Peserta

									</small>

								</div>

								<table class="table table-sm table-borderless mb-4">

									<tr>

										<td width="35">

											<i class="fas fa-clock text-warning"></i>

										</td>

										<td>

											<?= $training['duration'] ?>

											Hari

										</td>

									</tr>

									<tr>

										<td>

											<i class="fas fa-map-marker-alt text-danger"></i>

										</td>

										<td>

											<?= htmlspecialchars($training['location']) ?>

										</td>

									</tr>
									<tr>

										<td>

											<i class="fas fa-chalkboard-teacher text-success"></i>

										</td>

										<td>

											<?= htmlspecialchars($training['trainer_name'] ?? '-') ?>

											<br>

											<small class="text-muted">

												<?= htmlspecialchars($training['institution'] ?? '') ?>

											</small>

										</td>

									</tr>

									<tr>

										<td>

											<i class="fas fa-calendar text-info"></i>

										</td>

										<td>

											<?= date('d M Y', strtotime($training['registration_open'])) ?>

											-

											<?= date('d M Y', strtotime($training['registration_close'])) ?>

										</td>

									</tr>

								</table>
								<div class="mt-auto">

									<div class="row">

										<div class="col-5">

											<a
												href="<?= url('/peserta/trainings/show?id=' . $training['id']) ?>"
												class="btn btn-outline-secondary btn-block">

												<i class="fas fa-eye mr-1"></i>

												Detail

											</a>

										</div>

										<div class="col-7">

											<a
												href="<?= url('/peserta/registrations/create?id=' . $training['id']) ?>"
												class="btn btn-primary btn-block">

												<i class="fas fa-paper-plane mr-2"></i>

												Daftar

											</a>

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

					<p class="text-muted">

						Saat ini belum ada pelatihan yang tersedia.
						Silakan kembali beberapa waktu lagi.

					</p>

				</div>

			</div>

		<?php endif; ?>

	<?php endif; ?>

</div>
