<div class="container-fluid">

	<!-- ==========================================================
	| Header
	=========================================================== -->

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h1 class="h3 mb-1 font-weight-bold text-gray-800">

				Verifikasi Peserta

			</h1>

			<p class="mb-0 text-muted">

				Kelola seluruh pendaftaran peserta yang menunggu proses
				verifikasi pelatihan.

			</p>

		</div>

		<a
			href="<?= url('/pegawai/dashboard') ?>"
			class="btn btn-outline-secondary shadow-sm">

			<i class="fas fa-arrow-left mr-2"></i>

			Dashboard

		</a>

	</div>

	<!-- ==========================================================
	| Summary
	=========================================================== -->

	<div class="row">

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

								Menunggu Verifikasi

							</div>

							<div class="h2 mb-0 font-weight-bold text-gray-800">

								<?= $pending ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-hourglass-half fa-2x text-gray-300"></i>

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

								Disetujui

							</div>

							<div class="h2 mb-0 font-weight-bold text-gray-800">

								<?= $approved ?>

							</div>

						</div>

						<div class="col-auto">

							<i class="fas fa-check-circle fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-4 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100 py-2">

				<div class="card-body">

					<div class="row no-gutters align-items-center">

						<div class="col mr-2">

							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

								Ditolak

							</div>

							<div class="h2 mb-0 font-weight-bold text-gray-800">

								<?= $rejected ?>

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

	<!-- ==========================================================
	| Progress
	=========================================================== -->

	<?php

		$total = $pending + $approved + $rejected;

		$pendingPercent = $total
			? round(($pending / $total) * 100)
			: 0;

		$approvedPercent = $total
			? round(($approved / $total) * 100)
			: 0;

		$rejectedPercent = $total
			? round(($rejected / $total) * 100)
			: 0;

	?>

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white">

			<h6 class="font-weight-bold text-primary mb-0">

				Ringkasan Verifikasi

			</h6>

		</div>

		<div class="card-body">

			<div class="mb-3">

				<div class="d-flex justify-content-between">

                    <span>

                        Disetujui

                    </span>

					<strong>

						<?= $approvedPercent ?>%

					</strong>

				</div>

				<div class="progress">

					<div
						class="progress-bar bg-success"
						style="width: <?= $approvedPercent ?>%">

					</div>

				</div>

			</div>

			<div class="mb-3">

				<div class="d-flex justify-content-between">

                    <span>

                        Pending

                    </span>

					<strong>

						<?= $pendingPercent ?>%

					</strong>

				</div>

				<div class="progress">

					<div
						class="progress-bar bg-warning"
						style="width: <?= $pendingPercent ?>%">

					</div>

				</div>

			</div>

			<div>

				<div class="d-flex justify-content-between">

                    <span>

                        Ditolak

                    </span>

					<strong>

						<?= $rejectedPercent ?>%

					</strong>

				</div>

				<div class="progress">

					<div
						class="progress-bar bg-danger"
						style="width: <?= $rejectedPercent ?>%">

					</div>

				</div>

			</div>

		</div>

	</div>
	<!-- ==========================================================
| Toolbar
=========================================================== -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="row align-items-center">

				<div class="col-lg-6">

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Menunggu Verifikasi

					</h5>

					<small class="text-muted">

						Seluruh peserta yang membutuhkan persetujuan pegawai.

					</small>

				</div>

				<div class="col-lg-6">

					<div class="d-flex justify-content-lg-end mt-3 mt-lg-0">

                        <span class="badge badge-warning px-3 py-2 mr-2">

                            <i class="fas fa-hourglass-half mr-1"></i>

                            <?= $registrations->count() ?>

                            Pending

                        </span>

						<button
							type="button"
							class="btn btn-outline-secondary btn-sm"
							onclick="location.reload()">

							<i class="fas fa-sync-alt mr-1"></i>

							Refresh

						</button>

					</div>

				</div>

			</div>

		</div>

		<div class="card-body">

			<!-- Search -->

			<div class="row mb-4">

				<div class="col-md-6">

					<div class="input-group">

						<div class="input-group-prepend">

                            <span class="input-group-text bg-white">

                                <i class="fas fa-search text-muted"></i>

                            </span>

						</div>

						<input
							id="tableSearch"
							type="text"
							class="form-control"
							placeholder="Cari peserta, pelatihan, email...">

					</div>

				</div>

				<div class="col-md-6 text-md-right mt-3 mt-md-0">

					<small class="text-muted">

						Menampilkan

						<strong>

							<?= $registrations->count() ?>

						</strong>

						data yang menunggu verifikasi.

					</small>

				</div>

			</div>
			<!-- ==========================================================
			| Advanced Filter
			=========================================================== -->

			<div class="row mb-4">

				<div class="col-12">

					<div class="card shadow border-0">

						<div class="card-header bg-white">

							<h6 class="mb-0">

								<i class="fas fa-filter text-primary mr-2"></i>

								Filter Lanjutan

							</h6>

						</div>

						<div class="card-body">

							<form
								action="<?= url('/pegawai/verifications') ?>"
								method="GET">

								<div class="form-row">

									<!-- Pelatihan -->

									<div class="col-lg-4 mb-3">

										<label>

											Pelatihan

										</label>

										<select
											name="training"
											class="form-control">

											<option value="">

												Semua Pelatihan

											</option>

											<?php foreach ($trainings as $training): ?>

												<option
													value="<?= $training->id ?>"
													<?= $selectedTraining == $training->id ? 'selected' : '' ?>>

													<?= e($training->name) ?>

												</option>

											<?php endforeach; ?>

										</select>

									</div>

									<!-- Bidang -->

									<div class="col-lg-3 mb-3">

										<label>

											Bidang

										</label>

										<select
											name="field"
											class="form-control">

											<option value="">

												Semua Bidang

											</option>

											<?php foreach ($trainingFields as $field): ?>

												<option
													value="<?= $field->id ?>"
													<?= $selectedField == $field->id ? 'selected' : '' ?>>

													<?= e($field->name) ?>

												</option>

											<?php endforeach; ?>

										</select>

									</div>

									<!-- Urutkan -->

									<div class="col-lg-3 mb-3">

										<label>

											Urutkan

										</label>

										<select
											name="sort"
											class="form-control">

											<option value="latest">

												Terbaru

											</option>

											<option value="oldest">

												Terlama Menunggu

											</option>

											<option value="name">

												Nama Peserta (A-Z)

											</option>

										</select>

									</div>

									<!-- Button -->

									<div class="col-lg-2 d-flex align-items-end mb-3">

										<button
											class="btn btn-primary btn-block">

											<i class="fas fa-search mr-1"></i>

											Terapkan

										</button>

									</div>

								</div>

								<div class="text-right">

									<a
										href="<?= url('/pegawai/verifications') ?>"
										class="btn btn-outline-secondary">

										<i class="fas fa-sync-alt mr-1"></i>

										Reset Filter

									</a>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>
			<?php if($registrations->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-inbox fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Tidak Ada Pendaftaran

					</h5>

					<p class="text-muted mb-0">

						Semua pendaftaran telah diproses.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="verificationTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">

							#

						</th>

						<th>

							Peserta

						</th>

						<th>

							Pelatihan

						</th>

						<th>

							Kontak

						</th>

						<th width="170">

							Tanggal Daftar

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

					<?php foreach ($registrations as $i => $registration): ?>

						<?php

						$profile = $registration->participant?->profile;
						$user = $registration->participant?->user;
						$training = $registration->training;
						$field = $training?->trainingField;

						$waitingDays = $registration->created_at
							? (int) $registration->created_at->diffInDays(\Carbon\Carbon::now())
							: 0;

						?>

						<tr>

							<td class="align-middle">

								<?= $i + 1 ?>

							</td>

							<td>

								<div class="d-flex align-items-center">

									<?php if (!empty($user?->avatar_url)): ?>

										<img
											src="<?= e($user->avatar_url) ?>"
											class="rounded-circle shadow-sm mr-3"
											width="52"
											height="52"
											style="object-fit:cover;">

									<?php else: ?>

										<div
											class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
											style="
                            width:52px;
                            height:52px;
                            font-weight:bold;
                            font-size:18px;
                        ">

											<?= initials($user?->name ?? 'P') ?>

										</div>

									<?php endif; ?>

									<div>

										<div class="font-weight-bold text-gray-800">

											<?= e($user?->name ?? '-') ?>

										</div>

										<small class="text-muted">

											<?= e($user?->email ?? '-') ?>

										</small>

									</div>

								</div>

							</td>

							<td>

								<div class="font-weight-bold">

									<?= e($training?->name ?? '-') ?>

								</div>

								<small class="text-muted">

									<?= e($field?->name ?? '-') ?>

								</small>

							</td>

							<td>

								<div>

									<i class="fas fa-phone text-primary mr-2"></i>

									<?= e($profile?->phone ?? '-') ?>

								</div>

								<?php if ($user?->email): ?>

									<small class="text-muted">

										<?= e($user->email) ?>

									</small>

								<?php endif; ?>

							</td>

							<td>

								<div>

									<?= $registration->created_at?->format('d M Y') ?? '-' ?>

								</div>

								<small class="text-muted">

									<?= $registration->created_at?->format('H:i') ?? '' ?>

								</small>

								<br>

								<small class="text-warning">

									Menunggu

									<?= $waitingDays ?>

									hari

								</small>

							</td>

							<td>

            <span class="badge badge-warning px-3 py-2">

                <i class="fas fa-hourglass-half mr-1"></i>

                Pending

            </span>

							</td>

							<td>

								<div class="btn-group btn-group-sm shadow-sm">

									<a
										href="<?= url('/pegawai/verifications/show?id=' . $registration->id) ?>"
										class="btn btn-outline-primary"
										title="Detail">

										<i class="fas fa-eye"></i>

									</a>

									<form
										action="<?= url('/pegawai/verifications/approve') ?>"
										method="POST"
										class="d-inline">

										<input
											type="hidden"
											name="id"
											value="<?= $registration->id ?>">

										<button
											type="submit"
											class="btn btn-outline-success"
											onclick="return confirm('Setujui peserta ini?')">

											<i class="fas fa-check"></i>

										</button>

									</form>

									<form
										action="<?= url('/pegawai/verifications/reject') ?>"
										method="POST"
										class="d-inline">

										<input
											type="hidden"
											name="id"
											value="<?= $registration->id ?>">

										<input
											type="hidden"
											name="reason"
											value="Ditolak oleh pegawai">

										<button
											type="submit"
											class="btn btn-outline-danger"
											onclick="return confirm('Tolak peserta ini?')">

											<i class="fas fa-times"></i>

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

		<!-- Footer -->

		<div class="card-footer bg-white border-0">

			<div class="row align-items-center">

				<div class="col-md-6">

					<small class="text-muted">

						<i class="fas fa-info-circle mr-1"></i>

						Klik tombol
						<strong>Detail</strong>
						untuk melihat informasi lengkap peserta sebelum
						melakukan verifikasi.

					</small>

				</div>

				<div class="col-md-6 text-md-right mt-2 mt-md-0">

					<small class="text-muted">

						Total data:

						<strong>

							<?= $registrations->count() ?>

						</strong>

					</small>

				</div>

			</div>

		</div>

	</div>

</div>

<script>

	document.addEventListener('DOMContentLoaded', function () {

		const search = document.getElementById('tableSearch');

		if (!search) {

			return;

		}

		search.addEventListener('keyup', function () {

			const keyword = this.value.toLowerCase();

			const rows = document.querySelectorAll('#verificationTable tbody tr');

			rows.forEach(function (row) {

				row.style.display = row.innerText
					.toLowerCase()
					.includes(keyword)
					? ''
					: 'none';

			});

		});

	});

</script>
