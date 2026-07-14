<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-2">

						Detail Verifikasi Peserta

					</h3>

					<p class="text-muted mb-0">

						Tinjau data peserta sebelum melakukan verifikasi.

					</p>

				</div>

				<a
					href="<?= url('/pegawai/verifications') ?>"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left mr-2"></i>

					Kembali

				</a>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- Profil -->

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<?php if(has_avatar($registration)): ?>

						<img
							src="<?= avatar($registration) ?>"
							class="rounded-circle shadow mb-3"
							width="140"
							height="140"
							style="object-fit:cover;">

					<?php else: ?>

						<div class="avatar-circle-lg mx-auto mb-3">

							<?= initials($registration['name']) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold">

						<?= $registration['name'] ?>

					</h4>

					<span class="badge badge-warning">

                        Menunggu Verifikasi

                    </span>

				</div>

			</div>

		</div>

		<!-- Detail -->

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Peserta

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless">

						<tr>

							<th width="220">

								Nama Lengkap

							</th>

							<td>

								<?= $registration['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= $registration['email'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Nomor Telepon

							</th>

							<td>

								<?= $registration['phone'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Pelatihan

							</th>

							<td>

								<?= $registration['training_name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= $registration['field_name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

                                <span class="badge badge-warning">

                                    Pending

                                </span>

							</td>

						</tr>

						<tr>

							<th>

								Tanggal Daftar

							</th>

							<td>

								<?= date(
									'd F Y H:i',
									strtotime($registration['created_at'])
								) ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

			<!-- Motivasi -->

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="m-0 font-weight-bold text-primary">

						Motivasi Mengikuti Pelatihan

					</h6>

				</div>

				<div class="card-body">

					<p class="mb-0">

						<?= nl2br($registration['motivation']) ?>

					</p>

				</div>

			</div>

			<!-- Verifikasi -->

			<div class="card shadow">

				<div class="card-header bg-white">

					<h6 class="m-0 font-weight-bold text-primary">

						Tindakan Verifikasi

					</h6>

				</div>

				<div class="card-body">

					<form
						action="<?= url('/pegawai/verifications/reject') ?>"
						method="POST">

						<input
							type="hidden"
							name="id"
							value="<?= $registration['id'] ?>">

						<div class="form-group">

							<label>

								Catatan / Alasan Penolakan

							</label>

							<textarea
								name="reason"
								class="form-control"
								rows="4"
								placeholder="Isi jika pendaftaran ditolak..."></textarea>

						</div>

						<div class="d-flex justify-content-between">

							<button
								formaction="<?= url('/pegawai/verifications/reject') ?>"
								class="btn btn-danger">

								<i class="fas fa-times mr-2"></i>

								Tolak

							</button>

							<button
								formaction="<?= url('/pegawai/verifications/approve') ?>"
								class="btn btn-success">

								<i class="fas fa-check mr-2"></i>

								Setujui

							</button>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>