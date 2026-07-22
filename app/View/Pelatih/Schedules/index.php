<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h1 class="h3 mb-1 text-gray-800">

				Jadwal Mengajar

			</h1>

			<p class="mb-0 text-muted">

				Kelola seluruh jadwal pelatihan yang Anda ampu.

			</p>

		</div>

	</div>
	<div class="row">

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100 py-2">

				<div class="card-body">

					<div class="text-xs text-primary text-uppercase font-weight-bold">
						Hari Ini
					</div>

					<div class="h4 font-weight-bold">
						<?= $todayCount ?>
					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100 py-2">

				<div class="card-body">

					<div class="text-xs text-success text-uppercase font-weight-bold">
						Akan Datang
					</div>

					<div class="h4 font-weight-bold">
						<?= $upcomingCount ?>
					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100 py-2">

				<div class="card-body">

					<div class="text-xs text-warning text-uppercase font-weight-bold">
						Total Pertemuan
					</div>

					<div class="h4 font-weight-bold">
						<?= $totalCount ?>
					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="card shadow">

		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">

				Daftar Jadwal

			</h6>

		</div>

		<div class="table-responsive">

			<table class="table table-hover mb-0">

				<thead>

				<tr>

					<th width="60">#</th>

					<th>Pelatihan</th>

					<th>Bidang</th>

					<th>Pertemuan</th>

					<th>Tanggal</th>

					<th>Jam</th>

					<th>Ruangan</th>

					<th>Status</th>

					<th width="130">Aksi</th>

				</tr>

				</thead>

				<tbody>

				<?php if ($schedules->isEmpty()): ?>

					<tr>

						<td colspan="9" class="text-center py-5">

							<i class="fas fa-calendar-times fa-3x text-gray-300 mb-3"></i>

							<div class="font-weight-bold">

								Belum ada jadwal mengajar.

							</div>

						</td>

					</tr>

				<?php endif; ?>

				<?php foreach ($schedules as $index => $schedule): ?>

					<tr>

						<td>

							<?= $index + 1 ?>

						</td>

						<td>

							<strong>

								<?= e($schedule->training?->name) ?>

							</strong>

						</td>

						<td>

							<?= e($schedule->training?->trainingField?->name ?? '-') ?>

						</td>

						<td>

							<?= e($schedule->getMeetingLabel()) ?>

						</td>

						<td>

							<?= $schedule->schedule_date?->format('d M Y') ?>

						</td>

						<td>

							<?= e($schedule->getTimeRange()) ?>

						</td>

						<td>

							<?= e($schedule->getRoom()) ?>

						</td>

						<td>

							<?php if ($schedule->isToday()): ?>

								<span class="badge badge-success">

                                    Hari Ini

                                </span>

							<?php elseif ($schedule->isUpcoming()): ?>

								<span class="badge badge-info">

                                    Akan Datang

                                </span>

							<?php else: ?>

								<span class="badge badge-secondary">

                                    Selesai

                                </span>

							<?php endif; ?>

						</td>

						<td>

							<a
								href="<?= url('/pelatih/schedules/show?id=' . $schedule->id) ?>"
								class="btn btn-primary btn-sm">

								<i class="fas fa-eye"></i>

							</a>

						</td>

					</tr>

				<?php endforeach; ?>

				</tbody>

			</table>

		</div>

	</div>

</div>
