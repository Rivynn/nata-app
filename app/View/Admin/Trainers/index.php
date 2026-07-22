<div class="container-fluid">

	<?php if ($message = flash('success')): ?>

		<div class="alert alert-success alert-dismissible fade show shadow-sm">

			<i class="fas fa-check-circle mr-2"></i>

			<?= $message ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

	<?php if ($message = flash('error')): ?>

		<div class="alert alert-danger alert-dismissible fade show shadow-sm">

			<i class="fas fa-times-circle mr-2"></i>

			<?= $message ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<span class="badge badge-primary px-3 py-2 mb-3">

						Master Data

					</span>

					<h3 class="font-weight-bold text-gray-800 mb-2">

						Data Pelatih

					</h3>

					<p class="text-muted mb-0">

						Kelola seluruh data pelatih yang terdaftar pada sistem pelatihan.

					</p>

				</div>

				<div>

					<a
						href="<?= url('/admin/trainers/create') ?>"
						class="btn btn-primary">

						<i class="fas fa-plus-circle mr-2"></i>

						Tambah Pelatih

					</a>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-primary text-uppercase font-weight-bold">

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

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-success text-uppercase font-weight-bold">

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

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-danger text-uppercase font-weight-bold">

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

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-info text-uppercase font-weight-bold">

								Bidang Pelatihan

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $fields->count() ?>

							</h2>

						</div>

						<i class="fas fa-layer-group fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="card shadow border-0">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Pelatih

					</h5>

					<small class="text-muted">

						Seluruh pelatih yang telah terdaftar pada sistem.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

				<?= $trainers->count() ?> Pelatih

			</span>

			</div>

		</div>

		<div class="card-body">

			<?php if ($trainers->isEmpty()): ?>

				<div class="text-center py-5">

					<div class="mb-4">

						<i class="fas fa-chalkboard-teacher fa-5x text-gray-300"></i>

					</div>

					<h4 class="font-weight-bold text-gray-700">

						Belum Ada Data Pelatih

					</h4>

					<p class="text-muted mb-4">

						Saat ini belum terdapat data pelatih yang terdaftar pada sistem.

					</p>

					<a
						href="<?= url('/admin/trainers/create') ?>"
						class="btn btn-primary">

						<i class="fas fa-plus-circle mr-2"></i>

						Tambah Pelatih

					</a>

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

							Bidang Pelatihan

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

						<th width="170">

							Aksi

						</th>

					</tr>

					</thead>

					<tbody>
					<?php foreach ($trainers as $i => $trainer): ?>

						<tr>

							<td>

								<?= $i + 1 ?>

							</td>

							<td>

								<div class="d-flex align-items-center">

									<div
										class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
										style="width:45px;height:45px;font-weight:700;">

										<?= e($trainer->user->getInitials()) ?>

									</div>

									<div>

										<div class="font-weight-bold">

											<?= e($trainer->getDisplayName()) ?>

										</div>

										<small class="text-muted">

											@<?= e($trainer->user->username) ?>

										</small>

										<br>

										<small class="text-muted">

											TRL-<?= str_pad($trainer->id, 4, '0', STR_PAD_LEFT) ?>

										</small>

									</div>

								</div>

							</td>

							<td>

								<div>

									<i class="fas fa-envelope text-primary mr-2"></i>

									<?= e($trainer->user->email) ?>

								</div>

								<small class="text-muted">

									<i class="fas fa-phone mr-2"></i>

									<?= e($trainer->phone ?: '-') ?>

								</small>

							</td>

							<td>

								<?php if ($trainer->trainingField): ?>

									<span class="badge badge-info px-3 py-2">

				<?= e($trainer->trainingField->name) ?>

			</span>

								<?php else: ?>

									<span class="badge badge-secondary px-3 py-2">

				-

			</span>

								<?php endif; ?>

							</td>

							<td>

								<?= e($trainer->getInstitution()) ?>

							</td>

							<td>

								<div class="font-weight-bold">

									<?= e($trainer->getExpertise()) ?>

								</div>

								<small class="text-muted">

									<?= e($trainer->getSpecialization()) ?>

								</small>

							</td>

							<td>

								<?php if ($trainer->user->isActive()): ?>

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
										href="<?= url('/admin/trainers/show?id=' . $trainer->id) ?>"
										class="btn btn-outline-primary btn-sm"
										title="Detail">

										<i class="fas fa-eye"></i>

									</a>

									<a
										href="<?= url('/admin/trainers/edit?id=' . $trainer->id) ?>"
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
											value="<?= $trainer->id ?>">

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
	<script>

		$(function () {

			$('#trainersTable').DataTable({

				responsive: true,

				autoWidth: false,

				pageLength: 10,

				lengthMenu: [
					[10, 25, 50, 100],
					[10, 25, 50, 100]
				],

				order: [
					[1, 'asc']
				],

				columnDefs: [

					{
						orderable: false,
						targets: [7]
					},

				],

				language: {

					search: "Cari Pelatih :",

					searchPlaceholder: "Nama, email, instansi...",

					lengthMenu: "Tampilkan _MENU_ data",

					info: "Menampilkan _START_ - _END_ dari _TOTAL_ pelatih",

					infoEmpty: "Tidak ada data",

					zeroRecords: "Pelatih tidak ditemukan",

					emptyTable: "Belum ada data pelatih",

					infoFiltered: "(difilter dari _MAX_ data)",

					paginate: {

						first: "Awal",

						last: "Akhir",

						next: '<i class="fas fa-angle-right"></i>',

						previous: '<i class="fas fa-angle-left"></i>',

					}

				}

			});

			/*
			|--------------------------------------------------------------------------
			| Auto Hide Flash
			|--------------------------------------------------------------------------
			*/

			setTimeout(function () {

				$('.alert').alert('close');

			}, 5000);

		});

	</script>
</div>
