<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Detail Peserta

					</h4>

					<p class="text-muted mb-0">

						Informasi lengkap peserta pelatihan.

					</p>

				</div>

				<div>

					<a
						href="<?= url('/admin/participants') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- Profile -->

		<div class="col-lg-4">

			<div class="card shadow">

				<div class="card-body text-center">

					<?php if(has_avatar($participant)): ?>

						<img
							src="<?= avatar($participant) ?>"
							class="rounded-circle shadow mb-4"
							width="150"
							height="150"
							style="object-fit:cover;">

					<?php else: ?>

						<div
							class="avatar-circle mx-auto mb-4"
							style="
								width:150px;
								height:150px;
								font-size:50px;
							">

							<?= initials($participant['name']) ?>

						</div>

					<?php endif; ?>

					<h3 class="font-weight-bold">

						<?= $participant['name'] ?>

					</h3>

					<p class="text-muted">

						<?= $participant['email'] ?>

					</p>

					<hr>

					<div class="row">

						<div class="col-6">

							<small class="text-muted">

								Status

							</small>

							<h5>

								<?php if($participant['status'] == 'active'): ?>

									<span class="badge badge-success">

										Aktif

									</span>

								<?php elseif($participant['status'] == 'inactive'): ?>

									<span class="badge badge-warning">

										Belum Aktif

									</span>

								<?php else: ?>

									<span class="badge badge-danger">

										Nonaktif

									</span>

								<?php endif; ?>

							</h5>

						</div>

						<div class="col-6">

							<small class="text-muted">

								Role

							</small>

							<h5>

								Peserta

							</h5>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Detail -->

		<div class="col-lg-8">

			<div class="card shadow">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Peserta

					</h5>

				</div>

				<div class="card-body">

					<table class="table table-borderless">

						<tr>

							<th width="220">

								Nama

							</th>

							<td>

								<?= $participant['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Username

							</th>

							<td>

								<?= $participant['username'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= $participant['email'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Nomor HP

							</th>

							<td>

								<?= $participant['phone'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Bergabung

							</th>

							<td>

								<?= date(
									'd F Y H:i',
									strtotime($participant['created_at'])
								) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status Akun

							</th>

							<td>

								<?= ucfirst($participant['status']) ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

	</div>

</div>