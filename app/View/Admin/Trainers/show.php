<div class="container-fluid">

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow border-0 mb-4">

				<div class="card-body text-center">

					<div
						class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow mb-3"
						style="width:110px;height:110px;font-size:38px;font-weight:700;">

						<?= e($trainer->user->getInitials()) ?>

					</div>

					<h4 class="font-weight-bold mb-1">

						<?= e($trainer->getDisplayName()) ?>

					</h4>

					<p class="text-muted mb-3">

						<?= e($trainer->getExpertise()) ?>

					</p>

					<?php if ($trainer->trainingField): ?>

						<span class="badge badge-info px-3 py-2">

							<?= e($trainer->trainingField->name) ?>

						</span>

					<?php else: ?>

						<span class="badge badge-secondary px-3 py-2">

							Belum Memiliki Bidang

						</span>

					<?php endif; ?>

					<hr>

					<?php if ($trainer->user->isActive()): ?>

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

			<div class="card shadow border-0 mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Pelatih

					</h5>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Nama Lengkap

							</label>

							<div class="font-weight-bold">

								<?= e($trainer->getDisplayName()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Username

							</label>

							<div>

								@<?= e($trainer->user->username) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Email

							</label>

							<div>

								<i class="fas fa-envelope text-primary mr-2"></i>

								<?= e($trainer->user->email) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Nomor Induk Pelatih

							</label>

							<div>

								<?= e($trainer->employee_number ?: '-') ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Bidang Pelatihan

							</label>

							<div>

								<?php if ($trainer->trainingField): ?>

									<span class="badge badge-info px-3 py-2">

										<?= e($trainer->trainingField->name) ?>

									</span>

								<?php else: ?>

									<span class="text-muted">

										-

									</span>

								<?php endif; ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Pengalaman

							</label>

							<div>

								<?= e($trainer->getExperienceLabel()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Nomor Telepon

							</label>

							<div>

								<i class="fas fa-phone text-success mr-2"></i>

								<?= e($trainer->phone ?: '-') ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Instansi

							</label>

							<div>

								<i class="fas fa-building text-info mr-2"></i>

								<?= e($trainer->getInstitution()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Keahlian

							</label>

							<div>

								<i class="fas fa-award text-warning mr-2"></i>

								<?= e($trainer->getExpertise()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Spesialisasi

							</label>

							<div>

								<?= e($trainer->getSpecialization()) ?>

							</div>

						</div>

						<div class="col-12">

							<label class="text-muted small mb-1">

								Biografi

							</label>

							<div class="border rounded bg-light p-3">

								<?= nl2br(e($trainer->biography ?: '-')) ?>

							</div>

						</div>

					</div>

				</div>

			</div>
			<div class="card shadow border-0">

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

								TRL-<?= str_pad($trainer->id, 4, '0', STR_PAD_LEFT) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Status Akun

							</label>

							<div>

								<?php if ($trainer->user->isActive()): ?>

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

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Dibuat Pada

							</label>

							<div>

								<?= date('d F Y H:i', strtotime($trainer->created_at)) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Terakhir Diperbarui

							</label>

							<div>

								<?= date('d F Y H:i', strtotime($trainer->updated_at)) ?>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Role

							</label>

							<div>

								<span class="badge badge-primary px-3 py-2">

									<?= strtoupper($trainer->user->role) ?>

								</span>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Terakhir Login

							</label>

							<div>

								<?php if ($trainer->user->last_login_at): ?>

									<?= date(
										'd F Y H:i',
										strtotime($trainer->user->last_login_at)
									) ?>

								<?php else: ?>

									<span class="text-muted">

										Belum Pernah Login

									</span>

								<?php endif; ?>

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
								href="<?= url('/admin/trainers/edit?id=' . $trainer->id) ?>"
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
									value="<?= $trainer->id ?>">

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
