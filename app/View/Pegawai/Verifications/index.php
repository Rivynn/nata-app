<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Verifikasi Peserta

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh pendaftaran peserta yang menunggu proses verifikasi.

					</p>

				</div>

				<i class="fas fa-user-check fa-3x text-gray-300"></i>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-4 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Pending

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $pending ?>

							</h2>

						</div>

						<i class="fas fa-hourglass-half fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Disetujui

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $approved ?>

							</h2>

						</div>

						<i class="fas fa-check-circle fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-danger font-weight-bold text-uppercase">

								Ditolak

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $rejected ?>

							</h2>

						</div>

						<i class="fas fa-times-circle fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="card shadow">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<h5 class="font-weight-bold text-primary mb-0">

					Daftar Menunggu Verifikasi

				</h5>

				<span class="badge badge-warning p-2">

                    <?= count($registrations) ?> Pendaftaran

                </span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($registrations)): ?>

				<div class="text-center py-5">

					<i class="fas fa-inbox fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Tidak ada data.

					</h5>

					<p class="text-muted">

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

							<th width="60">#</th>

							<th>Peserta</th>

							<th>Pelatihan</th>

							<th>Kontak</th>

							<th width="170">

								Tanggal Daftar

							</th>

							<th width="120">

								Status

							</th>

							<th width="150">

								Aksi

							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($registrations as $i => $registration): ?>

							<tr>

								<td>

									<?= $i + 1 ?>

								</td>

								<td>

									<div class="d-flex align-items-center">

										<?php if(!empty($registration['avatar'])): ?>

											<img
												src="<?= avatar($registration) ?>"
												class="rounded-circle shadow mr-3"
												width="50"
												height="50"
												style="object-fit:cover;">

										<?php else: ?>

											<div class="avatar-circle mr-3">

												<?= initials($registration['name']) ?>

											</div>

										<?php endif; ?>

										<div>

											<div class="font-weight-bold">

												<?= $registration['name'] ?>

											</div>

											<small class="text-muted">

												<?= $registration['email'] ?>

											</small>

										</div>

									</div>

								</td>

								<td>

									<strong>

										<?= $registration['training_name'] ?>

									</strong>

									<br>

									<span class="badge badge-light">

                                        <?= $registration['field_name'] ?>

                                    </span>

								</td>

								<td>

									<i class="fas fa-phone text-primary mr-2"></i>

									<?= $registration['phone'] ?>

								</td>

								<td>

									<i class="far fa-calendar-alt mr-2 text-secondary"></i>

									<?= date('d M Y H:i', strtotime($registration['created_at'])) ?>

								</td>

								<td>

                                    <span class="badge badge-warning px-3 py-2">

                                        <i class="fas fa-clock mr-1"></i>

                                        Pending

                                    </span>

								</td>

								<td>

									<div class="btn-group shadow-sm">

										<a
											href="<?= url('/pegawai/verifications/show?id='.$registration['id']) ?>"
											class="btn btn-outline-primary btn-sm"
											title="Detail">

											<i class="fas fa-eye"></i>

										</a>

										<form
											method="POST"
											action="<?= url('/pegawai/verifications/approve') ?>"
											class="d-inline">

											<input
												type="hidden"
												name="id"
												value="<?= $registration['id'] ?>">

											<button
												type="submit"
												class="btn btn-outline-success btn-sm"
												onclick="return confirm('Setujui peserta ini?')">

												<i class="fas fa-check"></i>

											</button>

										</form>

										<form
											method="POST"
											action="<?= url('/pegawai/verifications/reject') ?>"
											class="d-inline">

											<input
												type="hidden"
												name="id"
												value="<?= $registration['id'] ?>">

											<input
												type="hidden"
												name="reason"
												value="Ditolak oleh pegawai">

											<button
												type="submit"
												class="btn btn-outline-danger btn-sm"
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

	</div>

</div>
