<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h1 class="h3 mb-0 text-gray-800">

				Dashboard

			</h1>

			<p class="mb-0 text-muted">

				Selamat datang, <?= e(auth()->user()->name) ?>.

			</p>

		</div>

	</div>

	<div class="row">

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Jadwal Hari Ini

							</div>

							<div class="h4 mb-0 font-weight-bold text-gray-800">

								<?= $todaySchedules ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Pelatihan

							</div>

							<div class="h4 mb-0 font-weight-bold text-gray-800">

								<?= $totalTrainings ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-book-open fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">

								Sesi Absensi Aktif

							</div>

							<div class="h4 mb-0 font-weight-bold text-gray-800">

								<?= $activeAttendance ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-qrcode fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="card shadow">

		<div class="card-header py-3 d-flex justify-content-between align-items-center">

			<h6 class="m-0 font-weight-bold text-primary">

				Jadwal Mengajar Mendatang

			</h6>

		</div>

		<div class="card-body p-0">

			<?php if ($nextSchedules->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-calendar-times fa-4x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Jadwal

					</h5>

					<p class="text-muted mb-0">

						Tidak ada jadwal mengajar yang akan datang.

					</p>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table class="table table-hover mb-0">

						<thead class="thead-light">

						<tr>

							<th width="70">

								#
							</th>

							<th>

								Pelatihan
							</th>

							<th>

								Pertemuan
							</th>

							<th>

								Tanggal
							</th>

							<th>

								Waktu
							</th>

							<th>

								Ruangan
							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach ($nextSchedules as $index => $schedule): ?>

							<tr>

								<td>

									<?= $index + 1 ?>

								</td>

								<td>

									<strong>

										<?= e($schedule->training?->name ?? '-') ?>

									</strong>

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

							</tr>

						<?php endforeach; ?>

						</tbody>

					</table>

				</div>

			<?php endif; ?>

		</div>

	</div>

</div>
