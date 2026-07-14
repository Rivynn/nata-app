<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Detail Pelatihan

					</h4>

					<p class="text-muted mb-0">

						Informasi lengkap mengenai program pelatihan.

					</p>

				</div>

				<div>

					<a
						href="<?= url('/admin/trainings/edit?id=' . $training['id']) ?>"
						class="btn btn-warning">

						<i class="fas fa-edit mr-2"></i>

						Edit

					</a>

					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- Summary -->

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<div
						class="rounded-circle bg-light shadow mx-auto mb-4 d-flex align-items-center justify-content-center"
						style="width:120px;height:120px;">

						<i
							class="<?= $training['icon'] ?> text-<?= $training['color'] ?>"
							style="font-size:50px;"></i>

					</div>

					<h3 class="font-weight-bold">

						<?= $training['name'] ?>

					</h3>

					<p class="text-muted">

						<?= $training['field_name'] ?>

					</p>

					<?= training_registration_badge($training) ?>

					<hr>

					<div class="row text-center">

						<div class="col-6">

							<small class="text-muted">

								Kuota

							</small>

							<h4 class="font-weight-bold">

								<?= $training['quota'] ?>

							</h4>

						</div>

						<div class="col-6">

							<small class="text-muted">

								Durasi

							</small>

							<h4 class="font-weight-bold">

								<?= $training['duration'] ?>

								Hari

							</h4>

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

						Informasi Pelatihan

					</h5>

				</div>

				<div class="card-body">

					<table class="table table-borderless">

						<tr>

							<th width="220">

								Nama Pelatihan

							</th>

							<td>

								<?= $training['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Jenis Pelatihan

							</th>

							<td>

								<span class="badge badge-<?= $training['color'] ?>">

									<i class="<?= $training['icon'] ?> mr-1"></i>

									<?= $training['field_name'] ?>

								</span>

							</td>

						</tr>

						<tr>

							<th>

								Lokasi

							</th>

							<td>

								<?= $training['location'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Kuota Peserta

							</th>

							<td>

								<?= $training['quota'] ?> Orang

							</td>

						</tr>

						<tr>

							<th>

								Durasi

							</th>

							<td>

								<?= $training['duration'] ?> Hari

							</td>

						</tr>

						<tr>

							<th>

								Pendaftaran Dibuka

							</th>

							<td>

								<?= date(
									'd F Y',
									strtotime($training['registration_open'])
								) ?>

							</td>

						</tr>

						<tr>

							<th>

								Pendaftaran Ditutup

							</th>

							<td>

								<?= date(
									'd F Y',
									strtotime($training['registration_close'])
								) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status Pendaftaran

							</th>

							<td>

								<?= training_registration_badge($training) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status Sistem

							</th>

							<td>

								<?php if($training['status'] == 'open'): ?>

									<span class="badge badge-success">

										Aktif

									</span>

								<?php elseif($training['status'] == 'draft'): ?>

									<span class="badge badge-secondary">

										Draft

									</span>

								<?php elseif($training['status'] == 'cancelled'): ?>

									<span class="badge badge-danger">

										Dibatalkan

									</span>

								<?php else: ?>

									<span class="badge badge-dark">

										Ditutup

									</span>

								<?php endif; ?>

							</td>

						</tr>

						<tr>

							<th>

								Deskripsi

							</th>

							<td>

								<?= nl2br($training['description']) ?>

							</td>

						</tr>

						<tr>

							<th>

								Dibuat

							</th>

							<td>

								<?= date(
									'd F Y H:i',
									strtotime($training['created_at'])
								) ?>

							</td>

						</tr>

						<tr>

							<th>

								Terakhir Diubah

							</th>

							<td>

								<?= date(
									'd F Y H:i',
									strtotime($training['updated_at'])
								) ?>

							</td>

						</tr>

					</table>

				</div>

				<div class="card-footer bg-white d-flex justify-content-end">

					<a
						href="<?= url('/admin/trainings/edit?id=' . $training['id']) ?>"
						class="btn btn-warning mr-2">

						<i class="fas fa-edit mr-2"></i>

						Edit Pelatihan

					</a>

					<a
						href="<?= url('/admin/trainings') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

</div>