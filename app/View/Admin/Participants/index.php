<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Peserta

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh peserta pelatihan yang telah terdaftar pada sistem.

					</p>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= $participants->count() ?> Peserta

				</span>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase mb-1">

								Total Peserta

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $participants->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-graduate fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase mb-1">

								Profile Lengkap

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $participants->filter(fn ($participant) => $participant->isProfileCompleted())->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-check fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-4 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase mb-1">

								Profile Belum Lengkap

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $participants->filter(fn ($participant) => ! $participant->isProfileCompleted())->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-edit fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="card shadow">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Peserta

					</h5>

					<small class="text-muted">

						Seluruh peserta yang telah memiliki akun pada sistem.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= $participants->count() ?> Data

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if ($participants->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-user-graduate fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Peserta

					</h5>

					<p class="text-muted mb-0">

						Belum terdapat peserta yang terdaftar pada sistem.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="participantTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">#</th>

						<th>Peserta</th>

						<th>Institusi</th>

						<th>No. HP</th>

						<th>Profile</th>

						<th>Bergabung</th>

						<th width="140">Aksi</th>

					</tr>

					</thead>

					<tbody>
					<?php foreach ($participants as $index => $participant): ?>

					<tr>

						<td>

							<?= $index + 1 ?>

						</td>

						<td>

							<div class="d-flex align-items-center">

								<?php if ($participant->user->hasAvatar()): ?>

									<img
										src="<?= avatar($participant->user) ?>"
										class="rounded-circle shadow mr-3"
										width="50"
										height="50"
										style="object-fit: cover;">

								<?php else: ?>

									<div class="avatar-circle mr-3">

										<?= e($participant->user->getInitials()) ?>

									</div>

								<?php endif; ?>

								<div>

									<div class="font-weight-bold">

										<?= e($participant->user->getDisplayName()) ?>

									</div>

									<small class="text-muted">

										<?= e($participant->user->email) ?>

									</small>

								</div>

							</div>

						</td>

						<td>

							<?= e($participant->institution ?: '-') ?>

						</td>

						<td>

							<?= e($participant->phone ?: '-') ?>

						</td>

						<td>

							<?php if ($participant->isProfileCompleted()): ?>

								<span class="badge badge-success">

											<i class="fas fa-check-circle mr-1"></i>

											Lengkap

										</span>

							<?php else: ?>

								<span class="badge badge-warning">

											<i class="fas fa-exclamation-circle mr-1"></i>

											Belum Lengkap

										</span>

							<?php endif; ?>

						</td>

						<td>

							<?= $participant->created_at->format('d M Y') ?>

							<br>

							<small class="text-muted">

								<?= $participant->created_at->format('H:i') ?>

							</small>

						</td>

						<td>

							<div class="btn-group shadow-sm">

								<a
									href="<?= url('/admin/participants/show?id=' . $participant->id) ?>"
									class="btn btn-outline-primary btn-sm"
									title="Detail">

									<i class="fas fa-eye"></i>

								</a>

								<form
									method="POST"
									action="<?= url('/admin/participants/delete') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $participant->id ?>">

									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										title="Hapus"
										onclick="return confirm('Yakin ingin menghapus peserta ini?')">

										<i class="fas fa-trash"></i>

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

<style>

	.avatar-circle {

		width: 50px;

		height: 50px;

		border-radius: 50%;

		background: #4e73df;

		color: #fff;

		display: flex;

		align-items: center;

		justify-content: center;

		font-weight: 700;

		font-size: 16px;

		text-transform: uppercase;

		flex-shrink: 0;

	}

	.table td,
	.table th {

		vertical-align: middle;

	}

	.badge {

		font-size: .75rem;

		padding: .45rem .65rem;

	}

</style>


