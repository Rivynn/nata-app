<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Pelatih

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh data pelatih yang tersedia untuk mendukung pelaksanaan program pelatihan.

					</p>

				</div>

				<a
					href="<?= url('/admin/trainers/create') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Pelatih

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

								Total Pelatih

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>

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

								Pelatih Aktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $active ?>

							</h2>

						</div>

						<i class="fas fa-user-check fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-danger font-weight-bold text-uppercase">

								Pelatih Nonaktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $inactive ?>

							</h2>

						</div>

						<i class="fas fa-user-slash fa-2x text-gray-300"></i>

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

								Bidang Keahlian

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count($fields) ?>

							</h2>

						</div>

						<i class="fas fa-layer-group fa-2x text-gray-300"></i>

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

						Daftar Pelatih

					</h5>

					<small class="text-muted">

						Seluruh pelatih yang terdaftar pada sistem.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= count($trainers) ?> Pelatih

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($trainers)): ?>

				<div class="text-center py-5">

					<i class="fas fa-chalkboard-teacher fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Pelatih

					</h5>

					<p class="text-muted">

						Silahkan tambahkan data pelatih terlebih dahulu.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="trainersTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">

							#

						</th>

						<th>

							Pelatih

						</th>

						<th>

							Kontak

						</th>

						<th>

							Bidang

						</th>

						<th>

							Instansi

						</th>

						<th>

							Keahlian

						</th>

						<th width="120">

							Status

						</th>

						<th width="160">

							Aksi

						</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach($trainers as $i => $trainer): ?>

					<tr>

						<td>

							<?= $i + 1 ?>

						</td>

						<td>

							<div class="font-weight-bold">

								<?= $trainer['name'] ?>

							</div>

							<small class="text-muted">

								TRL-<?= str_pad($trainer['id'], 4, '0', STR_PAD_LEFT) ?>

							</small>

						</td>

						<td>

							<div>

								<i class="fas fa-envelope text-primary mr-2"></i>

								<?= $trainer['email'] ?: '-' ?>

							</div>

							<small class="text-muted">

								<i class="fas fa-phone mr-2"></i>

								<?= $trainer['phone'] ?: '-' ?>

							</small>

						</td>

						<td>

									<span class="badge badge-<?= $trainer['color'] ?>">

										<i class="<?= $trainer['icon'] ?> mr-1"></i>

										<?= $trainer['field_name'] ?>

									</span>

						</td>

						<td>

							<?= $trainer['institution'] ?: '-' ?>

						</td>

						<td>

							<?= $trainer['expertise'] ?: '-' ?>

						</td>
						<td>

							<?php if($trainer['status'] === 'active'): ?>

								<span class="badge badge-success px-3 py-2">

											<i class="fas fa-check-circle mr-1"></i>

											Aktif

										</span>

							<?php else: ?>

								<span class="badge badge-danger px-3 py-2">

											<i class="fas fa-times-circle mr-1"></i>

											Nonaktif

										</span>

							<?php endif; ?>

						</td>

						<td>

							<div class="btn-group shadow-sm">

								<a
									href="<?= url('/admin/trainers/show?id=' . $trainer['id']) ?>"
									class="btn btn-outline-primary btn-sm"
									title="Detail">

									<i class="fas fa-eye"></i>

								</a>

								<a
									href="<?= url('/admin/trainers/edit?id=' . $trainer['id']) ?>"
									class="btn btn-outline-warning btn-sm"
									title="Edit">

									<i class="fas fa-edit"></i>

								</a>

								<form
									method="POST"
									action="<?= url('/admin/trainers/delete') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $trainer['id'] ?>">

									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										onclick="return confirm('Yakin ingin menghapus pelatih ini?')">

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