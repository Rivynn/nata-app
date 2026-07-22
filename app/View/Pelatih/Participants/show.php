<div class="container-fluid">

	<!-- Breadcrumb -->

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/participants') ?>">

					Peserta Pelatihan

				</a>

			</li>

			<li class="breadcrumb-item active">

				Detail Peserta

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<div class="d-flex align-items-center">

						<div class="mr-4">

							<img
								src="<?= e($participant->user->avatar_url ?: '/assets/img/undraw_profile.svg') ?>"
								class="rounded-circle border shadow-sm"
								width="90"
								height="90"
								alt="Avatar">

						</div>

						<div>

							<h3 class="font-weight-bold text-primary mb-1">

								<?= e($participant->user->getDisplayName()) ?>

							</h3>

							<p class="text-muted mb-2">

								<?= e($participant->user->email) ?>

							</p>

							<span class="badge badge-success">

								Peserta Aktif

							</span>

						</div>

					</div>

				</div>

				<div class="col-lg-4 text-lg-right mt-3 mt-lg-0">

					<a
						href="<?= url('/pelatih/participants') ?>"
						class="btn btn-outline-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

	<!-- Summary -->

	<div class="row mb-4">

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Total Pertemuan

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $totalMeeting ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-calendar fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Hadir

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $presentCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

								Izin

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $permissionCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-user-clock fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

								Tidak Hadir

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $absentCount ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-times-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Peserta

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="40%">

								Nama

							</th>

							<td>

								<?= e($participant->user->getDisplayName()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= e($participant->user->email) ?>

							</td>

						</tr>

						<tr>

							<th>

								No. HP

							</th>

							<td>

								<?= e($participant->phone ?: '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Jenis Kelamin

							</th>

							<td>

								<?= e($participant->getGenderLabel()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Alamat

							</th>

							<td>

								<?= e($participant->address ?: '-') ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Pelatihan

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="40%">

								Pelatihan

							</th>

							<td>

								<?= e($registration->training->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= e($registration->training->trainingField->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

								<span class="badge badge-success">

									Aktif

								</span>

							</td>

						</tr>

						<tr>

							<th>

								Terdaftar

							</th>

							<td>

								<?= $registration->created_at?->format('d M Y') ?: '-' ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header py-3 d-flex justify-content-between align-items-center">

					<h6 class="m-0 font-weight-bold text-primary">

						Riwayat Kehadiran

					</h6>

					<input
						type="text"
						id="attendanceSearch"
						class="form-control form-control-sm"
						placeholder="Cari meeting..."
						style="max-width:250px;">

				</div>

				<div class="card-body p-0">

					<div class="table-responsive">

						<table class="table table-hover mb-0" id="attendanceTable">

							<thead class="thead-light">

							<tr>

								<th width="90">

									Meeting

								</th>

								<th>

									Topik

								</th>

								<th width="140">

									Tanggal

								</th>

								<th width="120">

									Status

								</th>

								<th width="180">

									Check In

								</th>

							</tr>

							</thead>

							<tbody>
							<?php foreach ($attendances as $attendance): ?>

								<tr>

									<td>

										<strong>

											<?= $attendance->attendanceSession->trainingSchedule->getMeetingLabel() ?>

										</strong>

									</td>

									<td>

										<div class="font-weight-bold">

											<?= e($attendance->attendanceSession->trainingSchedule->topic ?: '-') ?>

										</div>

										<small class="text-muted">

											<?= e($attendance->attendanceSession->trainingSchedule->getTimeRange()) ?>

										</small>

									</td>

									<td>

										<?= $attendance->attendanceSession->trainingSchedule->schedule_date
											? $attendance->attendanceSession->trainingSchedule->schedule_date->format('d M Y')
											: '-' ?>

									</td>

									<td>

										<?php if ($attendance->isPresent()): ?>

											<span class="badge badge-success">

												Hadir

											</span>

										<?php elseif ($attendance->isLate()): ?>

											<span class="badge badge-warning">

												Terlambat

											</span>

										<?php elseif ($attendance->isPermission()): ?>

											<span class="badge badge-info">

												Izin

											</span>

										<?php else: ?>

											<span class="badge badge-danger">

												Tidak Hadir

											</span>

										<?php endif; ?>

									</td>

									<td>

										<?= $attendance->check_in_at?->format('d M Y H:i') ?? '-' ?>

									</td>

								</tr>

							<?php endforeach; ?>

							</tbody>

						</table>

					</div>

				</div>

			</div>
			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Sertifikat

					</h6>

				</div>

				<div class="card-body">

					<?php if (!empty($certificate)): ?>

						<div class="row">

							<div class="col-md-6">

								<table class="table table-borderless table-sm mb-0">

									<tr>

										<th width="40%">

											Nomor

										</th>

										<td>

											<?= e($certificate->certificate_number) ?>

										</td>

									</tr>

									<tr>

										<th>

											Diterbitkan

										</th>

										<td>

											<?= $certificate->issued_at
												? $certificate->issued_at->format('d M Y')
												: '-' ?>

										</td>

									</tr>

									<tr>

										<th>

											Status

										</th>

										<td>

											<span class="badge badge-success">

												Tersedia

											</span>

										</td>

									</tr>

								</table>

							</div>

							<div class="col-md-6 text-md-right mt-3 mt-md-0">

								<a
									href="<?= url('/pelatih/certificates/show?id=' . $certificate->id) ?>"
									class="btn btn-success">

									<i class="fas fa-award mr-2"></i>

									Lihat Sertifikat

								</a>

							</div>

						</div>

					<?php else: ?>

						<div class="text-center py-4">

							<i class="fas fa-award fa-4x text-gray-300 mb-3"></i>

							<h5 class="font-weight-bold">

								Sertifikat Belum Tersedia

							</h5>

							<p class="text-muted mb-0">

								Peserta belum memiliki sertifikat atau belum dinyatakan lulus.

							</p>

						</div>

					<?php endif; ?>

				</div>

			</div>

		</div>

	</div>

	<div class="alert alert-info shadow-sm">

		<div class="d-flex">

			<div class="mr-3">

				<i class="fas fa-info-circle fa-2x"></i>

			</div>

			<div>

				<strong>Informasi</strong>

				<br>

				• Halaman ini menampilkan informasi lengkap peserta pelatihan.

				<br>

				• Data kehadiran diperbarui secara otomatis setiap peserta melakukan absensi.

				<br>

				• Sertifikat hanya tersedia apabila peserta telah memenuhi persyaratan kelulusan.

			</div>

		</div>

	</div>

	<script>

		document
			.getElementById('attendanceSearch')
			.addEventListener('keyup', function () {

				const keyword = this.value.toLowerCase();

				document
					.querySelectorAll('#attendanceTable tbody tr')
					.forEach(function (row) {

						row.style.display = row.innerText
							.toLowerCase()
							.includes(keyword)
							? ''
							: 'none';

					});

			});

	</script>

</div>
