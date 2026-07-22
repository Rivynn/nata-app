<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Jenis Pelatihan

					</h4>

					<p class="text-muted mb-0">

						Kelola kategori atau bidang pelatihan yang tersedia pada sistem.

					</p>

				</div>

				<a
					href="<?= url('/admin/training-fields/create') ?>"
					class="btn btn-primary shadow-sm">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Jenis

				</a>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total Bidang

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-layer-group fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Aktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $fields->where('is_active', true)->count() ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-danger font-weight-bold text-uppercase">

								Nonaktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $fields->where('is_active', false)->count() ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-times-circle fa-2x text-gray-300"></i>

						</div>

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

						Daftar Jenis Pelatihan

					</h5>

					<small class="text-muted">

						Seluruh bidang pelatihan yang tersedia.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= $fields->count() ?> Bidang

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if ($fields->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-layer-group fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Jenis Pelatihan

					</h5>

					<p class="text-muted">

						Silakan tambahkan jenis pelatihan terlebih dahulu.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="trainingFieldsTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">#</th>

						<th width="90">Icon</th>

						<th>Nama Bidang</th>

						<th>Deskripsi</th>



						<th width="120">Status</th>

						<th width="170">Aksi</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach ($fields as $i => $field): ?>

						<tr>

							<td>

								<?= $i + 1 ?>

							</td>

							<td>

								<div
									class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm"
									style="width:55px;height:55px;">

									<i
										class="<?= e($field->icon) ?> text-<?= e($field->color) ?>"
										style="font-size:22px;"></i>

								</div>

							</td>

							<td>

								<div class="font-weight-bold">

									<?= e($field->name) ?>

								</div>

								<small class="text-muted">

									ID #<?= $field->id ?>

								</small>

							</td>

							<td>

								<?= e($field->description ?: '-') ?>

							</td>


							<td>

								<?php if ($field->is_active): ?>

									<span class="badge badge-success px-3 py-2">

											<i class="fas fa-check-circle mr-1"></i>

											Aktif

										</span>

								<?php else: ?>

									<span class="badge badge-danger px-3 py-2">

											<i class="fas fa-ban mr-1"></i>

											Nonaktif

										</span>

								<?php endif; ?>

							</td>

							<td>

								<div class="btn-group shadow-sm">

									<a
										href="<?= url('/admin/training-fields/edit?id=' . $field->id) ?>"
										class="btn btn-outline-warning btn-sm"
										title="Edit">

										<i class="fas fa-edit"></i>

									</a>

									<form
										method="POST"
										action="<?= url('/admin/training-fields/delete') ?>"
										class="d-inline">

										<input
											type="hidden"
											name="id"
											value="<?= $field->id ?>">

										<button
											type="submit"
											class="btn btn-outline-danger btn-sm"
											onclick="return confirm('Yakin ingin menghapus jenis pelatihan ini?')">

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

