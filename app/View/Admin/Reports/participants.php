<div class="container-fluid">

	<!-- Header -->
	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Laporan Data Peserta

					</h4>

					<p class="text-muted mb-0">

						Preview data peserta pelatihan yang dapat difilter sebelum dicetak atau diexport.

					</p>

				</div>

				<div>

					<button
						type="button"
						class="btn btn-outline-secondary"
						onclick="location.reload()">

						<i class="fas fa-sync-alt mr-2"></i>

						Refresh

					</button>

				</div>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total Peserta

							</div>

							<h2 class="font-weight-bold">

								<?= count($participants ?? []) ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Peserta Aktif

							</div>

							<h2 class="font-weight-bold">

								<?= $active ?? 0 ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-user-check fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Total Bidang

							</div>

							<h2 class="font-weight-bold">

								<?= count($fields ?? []) ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-layer-group fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<div class="text-xs text-info font-weight-bold text-uppercase">

								Pelatihan

							</div>

							<h2 class="font-weight-bold">

								<?= count($trainings ?? []) ?>

							</h2>

						</div>

						<div>

							<i class="fas fa-book-open fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Filter -->

	<div class="card shadow mb-4">

		<div class="card-header bg-white">

			<h5 class="font-weight-bold text-primary mb-0">

				Filter Laporan

			</h5>

		</div>

		<div class="card-body">

			<form
				method="GET"
				action="<?= url('/admin/reports/participants') ?>">

				<div class="row">

					<div class="col-md-4">

						<div class="form-group">

							<label>Kata Kunci</label>

							<input
								type="text"
								name="keyword"
								class="form-control"
								placeholder="Nama / Email"
								value="<?= htmlspecialchars($filters['keyword'] ?? '') ?>">

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Bidang</label>

							<select
								name="field"
								class="form-control">

								<option value="">Semua Bidang</option>

								<?php foreach ($fields as $field): ?>

									<option
										value="<?= $field['id'] ?>"
										<?= ($filters['field'] ?? '') == $field['id'] ? 'selected' : '' ?>>

										<?= $field['name'] ?>

									</option>

								<?php endforeach; ?>

							</select>

						</div>

					</div>

					<div class="col-md-4">

						<div class="form-group">

							<label>Pelatihan</label>

							<select
								name="training"
								class="form-control">

								<option value="">Semua Pelatihan</option>

								<?php foreach ($trainings as $training): ?>

									<option
										value="<?= $training['id'] ?>"
										<?= ($filters['training'] ?? '') == $training['id'] ? 'selected' : '' ?>>

										<?= $training['name'] ?>

									</option>

								<?php endforeach; ?>

							</select>

						</div>

					</div>

				</div>

				<div class="row">

					<div class="col-md-3">

						<div class="form-group">

							<label>Status Registrasi</label>

							<select
								name="status"
								class="form-control">

								<option value="">Semua Status</option>

								<option
									value="pending"
									<?= ($filters['status'] ?? '') == 'pending' ? 'selected' : '' ?>>

									Pending

								</option>

								<option
									value="approved"
									<?= ($filters['status'] ?? '') == 'approved' ? 'selected' : '' ?>>

									Disetujui

								</option>

								<option
									value="rejected"
									<?= ($filters['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>

									Ditolak

								</option>

								<option
									value="completed"
									<?= ($filters['status'] ?? '') == 'completed' ? 'selected' : '' ?>>

									Selesai

								</option>

							</select>

						</div>

					</div>

					<div class="col-md-3">

						<div class="form-group">

							<label>Tanggal Awal</label>

							<input
								type="date"
								name="start_date"
								class="form-control"
								value="<?= $filters['start_date'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-3">

						<div class="form-group">

							<label>Tanggal Akhir</label>

							<input
								type="date"
								name="end_date"
								class="form-control"
								value="<?= $filters['end_date'] ?? '' ?>">

						</div>

					</div>

					<div class="col-md-3 d-flex align-items-end">

						<div class="btn-group w-100">

							<button
								type="submit"
								class="btn btn-primary">

								<i class="fas fa-search mr-2"></i>

								Filter

							</button>

							<a
								href="<?= url('/admin/reports/participants') ?>"
								class="btn btn-outline-secondary">

								<i class="fas fa-redo"></i>

							</a>

						</div>

					</div>

				</div>

				<hr>

				<div class="d-flex justify-content-end">

					<div class="btn-group">
						<a
							href="<?= url('/admin/reports/participants/print?' . http_build_query($filters ?? [])) ?>"
							target="_blank"
							class="btn btn-outline-primary">

							<i class="fas fa-print mr-2"></i>

							Print

						</a>

					</div>

				</div>

			</form>

		</div>

	</div>

	<!-- Preview Data -->

	<div class="card shadow">

		<div class="card-header bg-white d-flex justify-content-between align-items-center">

			<div>

				<h5 class="font-weight-bold text-primary mb-1">

					Preview Data Peserta

				</h5>

				<small class="text-muted">

					Data berikut akan digunakan pada laporan.

				</small>

			</div>

			<span class="badge badge-primary px-3 py-2">

				<?= count($participants ?? []) ?> Data

			</span>

		</div>

		<div class="card-body">

			<div class="table-responsive">

				<table
					id="participantReportTable"
					class="table table-hover table-bordered align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">

							No

						</th>

						<th>

							Peserta

						</th>

						<th>

							Email

						</th>

						<th>

							No HP

						</th>

						<th>

							Bidang

						</th>

						<th>

							Pelatihan

						</th>

						<th>

							Status

						</th>

						<th>

							Tanggal Daftar

						</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach(($participants ?? []) as $i => $participant): ?>

						<tr>

							<td>

								<?= $i + 1 ?>

							</td>

							<td>

								<div class="d-flex align-items-center">

									<?php if(!empty($participant['avatar'])): ?>

										<img
											src="<?= avatar($participant) ?>"
											class="rounded-circle shadow mr-3"
											width="45"
											height="45"
											style="object-fit:cover;">

									<?php else: ?>

										<div class="avatar-circle mr-3">

											<?= initials($participant['name']) ?>

										</div>

									<?php endif; ?>

									<div>

										<div class="font-weight-bold">

											<?= $participant['name'] ?>

										</div>

										<small class="text-muted">

											ID #<?= $participant['id'] ?>

										</small>

									</div>

								</div>

							</td>

							<td>

								<?= $participant['email'] ?>

							</td>

							<td>

								<?= $participant['phone'] ?: '-' ?>

							</td>

							<td>

			<span class="badge badge-info px-3 py-2">

				<?= $participant['field_name'] ?? '-' ?>

			</span>

							</td>

							<td>

								<?= $participant['training_name'] ?? '-' ?>

							</td>

							<td>

								<?php switch($participant['status']):

									case 'approved': ?>

										<span class="badge badge-success px-3 py-2">

						Disetujui

					</span>

										<?php break; ?>

									<?php case 'pending': ?>

										<span class="badge badge-warning px-3 py-2">

						Menunggu

					</span>

										<?php break; ?>

									<?php case 'rejected': ?>

										<span class="badge badge-danger px-3 py-2">

						Ditolak

					</span>

										<?php break; ?>

									<?php case 'completed': ?>

										<span class="badge badge-primary px-3 py-2">

						Selesai

					</span>

										<?php break; ?>

									<?php default: ?>

										<span class="badge badge-secondary px-3 py-2">

						-

					</span>

									<?php endswitch; ?>

							</td>

							<td>

								<?= date(
									'd M Y',
									strtotime($participant['created_at'])
								) ?>

							</td>

						</tr>

					<?php endforeach; ?>

					</tbody>
				</table>

			</div>

		</div>

	</div>

</div>

<script>



</script>