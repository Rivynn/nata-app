<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Penjadwalan

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh jadwal pelaksanaan pelatihan yang tersedia pada sistem.

					</p>

				</div>

				<a
					href="<?= url('/admin/schedules/create') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Jadwal

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

								Total Jadwal

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-secondary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-secondary font-weight-bold text-uppercase">

								Draft

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $draft ?>

							</h2>

						</div>

						<i class="fas fa-edit fa-2x text-gray-300"></i>

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

								Berlangsung

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $ongoing ?>

							</h2>

						</div>

						<i class="fas fa-play-circle fa-2x text-gray-300"></i>

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

								Selesai

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $completed ?>

							</h2>

						</div>

						<i class="fas fa-check-circle fa-2x text-gray-300"></i>

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

						Daftar Jadwal Pelatihan

					</h5>

					<small class="text-muted">

						Seluruh jadwal pelatihan yang telah dibuat.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= count($schedules) ?> Jadwal

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($schedules)): ?>

				<div class="text-center py-5">

					<i class="fas fa-calendar-alt fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Jadwal

					</h5>

					<p class="text-muted">

						Silahkan tambahkan jadwal pelatihan terlebih dahulu.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="scheduleTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">#</th>

						<th>Pelatihan</th>

						<th>Pelatih</th>

						<th>Lokasi</th>

						<th>Jadwal</th>

						<th>Peserta</th>

						<th>Status</th>

						<th width="170">Aksi</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach($schedules as $i => $schedule): ?>

					<tr>

						<td>

							<?= $i + 1 ?>

						</td>

						<td>

							<div class="font-weight-bold">

								<?= $schedule['training_name'] ?>

							</div>

							<small class="text-muted">

								<?= $schedule['title'] ?: '-' ?>

							</small>

						</td>

						<td>

							<i class="fas fa-chalkboard-teacher text-primary mr-2"></i>

							<?= $schedule['trainer_name'] ?>

						</td>

						<td>

							<strong>

								<?= $schedule['location'] ?>

							</strong>

							<br>

							<small class="text-muted">

								<?= $schedule['room'] ?: '-' ?>

							</small>

						</td>

						<td>

							<?= date('d M Y', strtotime($schedule['start_date'])) ?>

							<br>

							<small class="text-muted">

								<?= substr($schedule['start_time'],0,5) ?>

								-

								<?= substr($schedule['end_time'],0,5) ?>

							</small>

						</td>

						<td>

							<?= $schedule['max_participants'] ?>

							Orang

						</td>
						<td>

							<?php

								switch ($schedule['status']) {

									case 'draft':
										$badge = 'secondary';
										$icon = 'fas fa-edit';
										$text = 'Draft';
										break;

									case 'scheduled':
										$badge = 'primary';
										$icon = 'fas fa-calendar-check';
										$text = 'Terjadwal';
										break;

									case 'ongoing':
										$badge = 'warning';
										$icon = 'fas fa-play-circle';
										$text = 'Berlangsung';
										break;

									case 'completed':
										$badge = 'success';
										$icon = 'fas fa-check-circle';
										$text = 'Selesai';
										break;

									default:
										$badge = 'danger';
										$icon = 'fas fa-times-circle';
										$text = 'Dibatalkan';
										break;

								}

							?>

							<span class="badge badge-<?= $badge ?> px-3 py-2">

										<i class="<?= $icon ?> mr-1"></i>

										<?= $text ?>

									</span>

						</td>

						<td>

							<div class="btn-group shadow-sm">

								<a
									href="<?= url('/admin/schedules/show?id=' . $schedule['id']) ?>"
									class="btn btn-outline-primary btn-sm"
									title="Detail">

									<i class="fas fa-eye"></i>

								</a>

								<a
									href="<?= url('/admin/schedules/edit?id=' . $schedule['id']) ?>"
									class="btn btn-outline-warning btn-sm"
									title="Edit">

									<i class="fas fa-edit"></i>

								</a>

								<form
									method="POST"
									action="<?= url('/admin/schedules/delete') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $schedule['id'] ?>">

									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										onclick="return confirm('Yakin ingin menghapus jadwal ini?')">

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