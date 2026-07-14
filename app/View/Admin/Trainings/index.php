<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Pelatihan

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh program pelatihan yang tersedia pada sistem.

					</p>

				</div>

				<a
					href="<?= url('/admin/trainings/create') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Pelatihan

				</a>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total Pelatihan

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-book-open fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Pendaftaran Dibuka

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter(
									$trainings,
									fn($t) => training_registration_open($t)
								)) ?>

							</h2>

						</div>

						<i class="fas fa-lock-open fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-info font-weight-bold text-uppercase">

								Segera Dibuka

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter(
									$trainings,
									fn($t) => training_registration_coming_soon($t)
								)) ?>

							</h2>

						</div>

						<i class="fas fa-clock fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Pendaftaran Berakhir

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter(
									$trainings,
									fn($t) => training_registration_expired($t)
								)) ?>

							</h2>

						</div>

						<i class="fas fa-calendar-times fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Table -->

	<div class="card shadow">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Pelatihan

					</h5>

					<small class="text-muted">

						Seluruh pelatihan yang tersedia.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= count($trainings) ?> Pelatihan

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($trainings)): ?>

				<div class="text-center py-5">

					<i class="fas fa-book-open fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Pelatihan

					</h5>

					<p class="text-muted">

						Silahkan tambahkan pelatihan terlebih dahulu.

					</p>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table
						id="trainingTable"
						class="table table-hover align-middle">

						<thead class="thead-light">

						<tr>

							<th width="60">#</th>

							<th>Pelatihan</th>

							<th>Bidang</th>

							<th>Kuota</th>

							<th>Lokasi</th>

							<th>Pendaftaran</th>

							<th>Status</th>

							<th width="170">Aksi</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($trainings as $i => $training): ?>

							<tr>

								<td>

									<?= $i + 1 ?>

								</td>

								<td>

									<div class="font-weight-bold">

										<?= $training['name'] ?>

									</div>

									<small class="text-muted">

										<?= $training['duration'] ?> Hari

									</small>

								</td>

								<td>

									<span class="badge badge-<?= $training['color'] ?>">

										<i class="<?= $training['icon'] ?> mr-1"></i>

										<?= $training['field_name'] ?>

									</span>

								</td>

								<td>

									<?= $training['quota'] ?>

									Peserta

								</td>

								<td>

									<?= $training['location'] ?>

								</td>

								<td>

									<?= date('d M Y', strtotime($training['registration_open'])) ?>

									<br>

									<small class="text-muted">

										s/d

										<?= date('d M Y', strtotime($training['registration_close'])) ?>

									</small>

								</td>

								<td>

									<?= training_registration_badge($training) ?>

								</td>

								<td>

									<div class="btn-group shadow-sm">

										<a
											href="<?= url('/admin/trainings/show?id='.$training['id']) ?>"
											class="btn btn-outline-primary btn-sm">

											<i class="fas fa-eye"></i>

										</a>

										<a
											href="<?= url('/admin/trainings/edit?id='.$training['id']) ?>"
											class="btn btn-outline-warning btn-sm">

											<i class="fas fa-edit"></i>

										</a>

										<form
											method="POST"
											action="<?= url('/admin/trainings/delete') ?>"
											class="d-inline">

											<input
												type="hidden"
												name="id"
												value="<?= $training['id'] ?>">

											<button
												type="submit"
												class="btn btn-outline-danger btn-sm"
												onclick="return confirm('Yakin ingin menghapus pelatihan ini?')">

												<i class="fas fa-trash"></i>

											</button>

										</form>

									</div>

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