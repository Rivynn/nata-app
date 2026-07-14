<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Peserta

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh peserta yang telah terdaftar pada sistem pelatihan.

					</p>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= $total ?> Peserta

				</span>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total Peserta

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-user-graduate fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Aktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter($participants, fn($p) => $p['status'] == 'active')) ?>

							</h2>

						</div>

						<i class="fas fa-user-check fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Belum Aktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter($participants, fn($p) => $p['status'] == 'inactive')) ?>

							</h2>

						</div>

						<i class="fas fa-user-clock fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-danger font-weight-bold text-uppercase">

								Nonaktif

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= count(array_filter($participants, fn($p) => $p['status'] == 'disabled')) ?>

							</h2>

						</div>

						<i class="fas fa-user-slash fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Table -->

	<div class="card shadow">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Peserta

					</h5>

					<small class="text-muted">

						Seluruh peserta yang telah memiliki akun.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= count($participants) ?> Data

				</span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($participants)): ?>

				<div class="text-center py-5">

					<i class="fas fa-user-graduate fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Peserta

					</h5>

					<p class="text-muted">

						Belum terdapat peserta yang terdaftar.

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

							<th>Kontak</th>

							<th>No. HP</th>

							<th>Bergabung</th>

							<th>Status</th>

							<th width="150">Aksi</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($participants as $i => $participant): ?>

							<tr>

								<td>

									<?= $i + 1 ?>

								</td>

								<td>

									<div class="d-flex align-items-center">

										<?php if(has_avatar($participant)): ?>

											<img
												src="<?= avatar($participant) ?>"
												class="rounded-circle shadow mr-3"
												width="50"
												height="50"
												style="object-fit:cover;">

										<?php else: ?>

											<div class="avatar-circle mr-3">

												<?= initials($participant['name']) ?>

											</div>

										<?php endif; ?>

										<div>

											<div class="font-weight-bold">

												<?= $participant['name'] ?>

											</div>

											<small class="text-muted">

												ID #<?= $participant['id'] ?>

											</small>

										</div>

									</div>

								</td>

								<td>

									<?= $participant['email'] ?>

								</td>

								<td>

									<?= $participant['phone'] ?>

								</td>

								<td>

									<?= date(
										'd M Y',
										strtotime($participant['created_at'])
									) ?>

								</td>

								<td>

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

								</td>

								<td>

									<div class="btn-group shadow-sm">

										<a
											href="<?= url('/admin/participants/show?id=' . $participant['id']) ?>"
											class="btn btn-outline-primary btn-sm">

											<i class="fas fa-eye"></i>

										</a>

										<form
											method="POST"
											action="<?= url('/admin/participants/delete') ?>"
											class="d-inline">

											<input
												type="hidden"
												name="id"
												value="<?= $participant['id'] ?>">

											<button
												type="submit"
												class="btn btn-outline-danger btn-sm"
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