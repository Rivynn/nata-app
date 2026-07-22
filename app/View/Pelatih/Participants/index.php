<div class="container-fluid">

	<!-- Breadcrumb -->

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item active">

				Peserta Pelatihan

			</li>

		</ol>

	</nav>

	<!-- Hero -->

	<div class="card shadow border-left-success mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<h3 class="font-weight-bold text-success mb-2">

						<?= e($title) ?>

					</h3>

					<p class="text-muted mb-3">

						Daftar seluruh peserta dari pelatihan yang Anda ampu. Anda dapat melihat informasi peserta, pelatihan yang diikuti, serta membuka detail peserta.

					</p>

					<span class="badge badge-success">

						<?= $totalParticipants ?> Peserta

					</span>

					<span class="badge badge-primary">

						<?= $totalTrainings ?> Pelatihan

					</span>

				</div>

				<div class="col-lg-4 text-lg-right mt-3 mt-lg-0">

					<div class="text-muted small">

						<i class="fas fa-user-graduate mr-1"></i>

						Management Peserta

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Summary -->

	<div class="row mb-4">

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">

								Total Peserta

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $totalParticipants ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-users fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

								Pelatihan

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $totalTrainings ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-graduation-cap fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-3">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="row align-items-center">

						<div class="col">

							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">

								Laki-Laki

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $maleParticipants ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-male fa-2x text-gray-300"></i>

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

								Perempuan

							</div>

							<div class="h3 font-weight-bold mb-0">

								<?= $femaleParticipants ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-female fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<div class="card shadow mb-4">

		<div class="card-header py-3 d-flex justify-content-between align-items-center">

			<h6 class="m-0 font-weight-bold text-success">

				Daftar Peserta

			</h6>

			<input
				type="text"
				id="participantSearch"
				class="form-control form-control-sm"
				placeholder="Cari peserta..."
				style="max-width:250px;">

		</div>

		<div class="card-body p-0">

			<div class="table-responsive">

				<table class="table table-hover mb-0" id="participantTable">

					<thead class="thead-light">

					<tr>

						<th width="70">#</th>

						<th>Peserta</th>

						<th width="220">Pelatihan</th>

						<th width="150">No. HP</th>

						<th width="120">Jenis Kelamin</th>

						<th width="110">Status</th>

						<th width="170">Aksi</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach ($registrations as $index => $registration): ?>

						<tr>

							<td>

								<?= $index + 1 ?>

							</td>

							<td>

								<div class="d-flex align-items-center">

									<div class="mr-3">

										<img
											src="<?= e($registration->participant->user->avatar_url ?: '/assets/img/undraw_profile.svg') ?>"
											class="rounded-circle border"
											width="42"
											height="42"
											alt="Avatar">

									</div>

									<div>

										<div class="font-weight-bold">

											<?= e($registration->participant->user->name) ?>

										</div>

										<small class="text-muted">

											<?= e($registration->participant->user->email) ?>

										</small>

									</div>

								</div>

							</td>

							<td>

								<div class="font-weight-bold">

									<?= e($registration->training->name) ?>

								</div>

								<small class="text-muted">

									<?= e($registration->training->trainingField->name ?? '-') ?>

								</small>

							</td>

							<td>

								<?= e($registration->participant->phone ?: '-') ?>

							</td>

							<td>

								<?php if ($registration->participant->gender === 'L'): ?>

									<span class="badge badge-info">

			<?= e($registration->participant->getGenderLabel()) ?>

		</span>

								<?php elseif ($registration->participant->gender === 'P'): ?>

									<span class="badge badge-warning">

			<?= e($registration->participant->getGenderLabel()) ?>

		</span>

								<?php else: ?>

									<span class="badge badge-secondary">

			-

		</span>

								<?php endif; ?>

							</td>

							<td>

								<?php if ($registration->status === 'approved'): ?>

									<span class="badge badge-success">

					Disetujui

				</span>

								<?php elseif ($registration->status === 'pending'): ?>

									<span class="badge badge-warning">

					Menunggu

				</span>

								<?php elseif ($registration->status === 'rejected'): ?>

									<span class="badge badge-danger">

					Ditolak

				</span>

								<?php else: ?>

									<span class="badge badge-secondary">

					<?= e(ucfirst($registration->status)) ?>

				</span>

								<?php endif; ?>

							</td>

							<td>

								<a
									href="<?= url('/pelatih/participants/show?id=' . $registration->id) ?>"
									class="btn btn-sm btn-primary">

									<i class="fas fa-eye mr-1"></i>

									Detail

								</a>

							</td>

						</tr>

					<?php endforeach; ?>
					</tbody>

				</table>

			</div>

		</div>

	</div>
	<?php if ($registrations->isEmpty()): ?>

		<div class="card shadow">

			<div class="card-body text-center py-5">

				<i class="fas fa-users fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold text-gray-700">

					Belum Ada Peserta

				</h4>

				<p class="text-muted mb-0">

					Belum terdapat peserta yang terdaftar pada pelatihan yang Anda ampu.

				</p>

			</div>

		</div>

	<?php endif; ?>

	<div class="card shadow mt-4">

		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-success">

				Informasi

			</h6>

		</div>

		<div class="card-body">

			<div class="row text-center">

				<div class="col-md-4 mb-2">

					<span class="badge badge-success px-3 py-2">

						Peserta Aktif

					</span>

				</div>

				<div class="col-md-4 mb-2">

					<span class="badge badge-warning px-3 py-2">

						Menunggu Verifikasi

					</span>

				</div>

				<div class="col-md-4 mb-2">

					<span class="badge badge-info px-3 py-2">

						Detail Peserta

					</span>

				</div>

			</div>

		</div>

	</div>

	<div class="alert alert-info shadow-sm mt-4">

		<div class="d-flex">

			<div class="mr-3">

				<i class="fas fa-info-circle fa-2x"></i>

			</div>

			<div>

				<strong>Informasi</strong>

				<br>

				• Halaman ini menampilkan seluruh peserta dari pelatihan yang Anda ampu.

				<br>

				• Gunakan fitur pencarian untuk menemukan peserta dengan cepat.

				<br>

				• Klik tombol <strong>Detail</strong> untuk melihat informasi lengkap peserta.

			</div>

		</div>

	</div>

	<script>

		document
			.getElementById('participantSearch')
			.addEventListener('keyup', function () {

				const keyword = this.value.toLowerCase();

				document
					.querySelectorAll('#participantTable tbody tr')
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
