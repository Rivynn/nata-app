<div class="container-fluid">

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<div
						class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow mb-3"
						style="width:110px;height:110px;font-size:42px;">

						<i class="fas fa-chalkboard-teacher"></i>

					</div>

					<h4 class="font-weight-bold mb-1">

						<?= $trainer['name'] ?>

					</h4>

					<p class="text-muted mb-3">

						<?= $trainer['expertise'] ?: '-' ?>

					</p>

					<span class="badge badge-<?= $trainer['color'] ?> px-3 py-2">

						<i class="<?= $trainer['icon'] ?> mr-1"></i>

						<?= $trainer['field_name'] ?>

					</span>

					<hr>

					<?php if($trainer['status'] === 'active'): ?>

						<span class="badge badge-success px-3 py-2">

							<i class="fas fa-check-circle mr-1"></i>

							Aktif

						</span>

					<?php else: ?>

						<span class="badge badge-danger px-3 py-2">

							<i class="fas fa-times-circle mr-1"></i>

							Nonaktif

						</span>

					<?php endif; ?>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Pelatih

					</h5>

				</div>

				<div class="card-body">

					<div class="row">
						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Nama Pelatih

							</label>

							<div class="font-weight-bold">

								<?= $trainer['name'] ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Bidang Pelatihan

							</label>

							<div>

								<span class="badge badge-<?= $trainer['color'] ?> px-3 py-2">

									<i class="<?= $trainer['icon'] ?> mr-1"></i>

									<?= $trainer['field_name'] ?>

								</span>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Email

							</label>

							<div>

								<i class="fas fa-envelope text-primary mr-2"></i>

								<?= $trainer['email'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Nomor Telepon

							</label>

							<div>

								<i class="fas fa-phone text-success mr-2"></i>

								<?= $trainer['phone'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Instansi

							</label>

							<div>

								<i class="fas fa-building text-info mr-2"></i>

								<?= $trainer['institution'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Keahlian

							</label>

							<div>

								<i class="fas fa-award text-warning mr-2"></i>

								<?= $trainer['expertise'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-12 mb-4">

							<label class="text-muted small mb-1">

								Sertifikat / Kualifikasi

							</label>

							<div>

								<?= $trainer['certificate'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-12">

							<label class="text-muted small mb-1">

								Biografi

							</label>

							<div
								class="border rounded p-3 bg-light">

								<?= nl2br($trainer['biography'] ?: '-') ?>

							</div>

						</div>

					</div>

				</div>

			</div>
			<div class="card shadow">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Sistem

					</h5>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								ID Pelatih

							</label>

							<div class="font-weight-bold">

								TRL-<?= str_pad($trainer['id'], 4, '0', STR_PAD_LEFT) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Status

							</label>

							<div>

								<?php if($trainer['status'] === 'active'): ?>

									<span class="badge badge-success px-3 py-2">

										<i class="fas fa-check-circle mr-1"></i>

										Aktif

									</span>

								<?php else: ?>

									<span class="badge badge-danger px-3 py-2">

										<i class="fas fa-times-circle mr-1"></i>

										Nonaktif

									</span>

								<?php endif; ?>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Dibuat Pada

							</label>

							<div>

								<?= date(
									'd F Y H:i',
									strtotime($trainer['created_at'])
								) ?>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Terakhir Diperbarui

							</label>

							<div>

								<?= date(
									'd F Y H:i',
									strtotime($trainer['updated_at'])
								) ?>

							</div>

						</div>

					</div>

				</div>

				<div class="card-footer bg-white">

					<div class="d-flex justify-content-between">

						<a
							href="<?= url('/admin/trainers') ?>"
							class="btn btn-outline-secondary">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali

						</a>

						<div>

							<a
								href="<?= url('/admin/trainers/edit?id=' . $trainer['id']) ?>"
								class="btn btn-warning">

								<i class="fas fa-edit mr-2"></i>

								Edit

							</a>

							<form
								method="POST"
								action="<?= url('/admin/trainers/delete') ?>"
								class="d-inline">

								<input
									type="hidden"
									name="id"
									value="<?= $trainer['id'] ?>">

								<button
									type="submit"
									class="btn btn-danger"
									onclick="return confirm('Yakin ingin menghapus pelatih ini?')">

									<i class="fas fa-trash mr-2"></i>

									Hapus

								</button>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>