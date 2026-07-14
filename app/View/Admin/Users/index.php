<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Kelola User

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh akun pengguna sistem mulai dari Admin, Pegawai hingga Peserta.

					</p>

				</div>

				<a
					href="<?= url('/admin/users/create') ?>"
					class="btn btn-primary shadow-sm">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah User

				</a>

			</div>

		</div>

	</div>

	<!-- Statistik -->

	<div class="row">

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total User

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-users fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-danger shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-danger font-weight-bold text-uppercase">

								Admin

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $admins ?>

							</h2>

						</div>

						<i class="fas fa-user-shield fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-info font-weight-bold text-uppercase">

								Pegawai

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $employees ?>

							</h2>

						</div>

						<i class="fas fa-id-card fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-success shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-success font-weight-bold text-uppercase">

								Peserta

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $participants ?>

							</h2>

						</div>

						<i class="fas fa-user-graduate fa-2x text-gray-300"></i>

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

						Data Pengguna

					</h5>

					<small class="text-muted">

						Seluruh akun pengguna aplikasi.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

                    <?= count($users) ?> User

                </span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($users)): ?>

				<div class="text-center py-5">

					<i class="fas fa-users fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada User

					</h5>

					<p class="text-muted">

						Belum terdapat data pengguna.

					</p>

				</div>

			<?php else: ?>

			<div class="table-responsive">

				<table
					id="usersTable"
					class="table table-hover align-middle">

					<thead class="thead-light">

					<tr>

						<th width="60">

							#

						</th>

						<th>

							Pengguna

						</th>

						<th>

							Username

						</th>

						<th>

							Email

						</th>

						<th width="140">

							Role

						</th>

						<th width="180">

							Login Terakhir

						</th>

						<th width="140">

							Status

						</th>

						<th width="160">

							Aksi

						</th>

					</tr>

					</thead>

					<tbody>

					<?php foreach($users as $index => $user): ?>

					<tr>

						<td>

							<?= $index + 1 ?>

						</td>

						<td>

							<div class="d-flex align-items-center">

								<?php if(!empty($user['avatar'])): ?>

									<img
										src="<?= avatar($user) ?>"
										class="rounded-circle shadow mr-3"
										width="50"
										height="50"
										style="object-fit:cover;">

								<?php else: ?>

									<div class="avatar-circle mr-3">

										<?= initials($user['name']) ?>

									</div>

								<?php endif; ?>

								<div>

									<div class="font-weight-bold">

										<?= $user['name'] ?>

									</div>

									<small class="text-muted">

										ID #<?= $user['id'] ?>

									</small>

								</div>

							</div>

						</td>

						<td>

							<?= $user['username'] ?>

						</td>

						<td>

							<?= $user['email'] ?>

						</td>
						<td>

							<?php switch($user['role']):

								case 'admin': ?>

									<span class="badge badge-danger px-3 py-2">

                                                <i class="fas fa-user-shield mr-1"></i>

                                                Admin

                                            </span>

									<?php break; ?>

								<?php case 'pegawai': ?>

									<span class="badge badge-info px-3 py-2">

                                                <i class="fas fa-id-card mr-1"></i>

                                                Pegawai

                                            </span>

									<?php break; ?>

								<?php case 'peserta': ?>

									<span class="badge badge-success px-3 py-2">

                                                <i class="fas fa-user-graduate mr-1"></i>

                                                Peserta

                                            </span>

									<?php break; ?>

								<?php default: ?>

									<span class="badge badge-secondary px-3 py-2">

                                                <?= ucfirst($user['role']) ?>

                                            </span>

								<?php endswitch; ?>

						</td>

						<td>

							<?php if(!empty($user['last_login_at'])): ?>

								<i class="far fa-clock text-secondary mr-2"></i>

								<?= date(
									'd M Y H:i',
									strtotime($user['last_login_at'])
								) ?>

							<?php else: ?>

								<span class="text-muted">

                                            Belum Pernah Login

                                        </span>

							<?php endif; ?>

						</td>

						<td>

							<?php if(($user['status'] ?? 'active') === 'active'): ?>

								<span class="badge badge-success px-3 py-2">

                                            <i class="fas fa-check-circle mr-1"></i>

                                            Aktif

                                        </span>

							<?php else: ?>

								<span class="badge badge-secondary px-3 py-2">

                                            <i class="fas fa-ban mr-1"></i>

                                            Nonaktif

                                        </span>

							<?php endif; ?>

						</td>

						<td>

							<div class="btn-group shadow-sm">

								<a
									href="<?= url('/admin/users/show?id='.$user['id']) ?>"
									class="btn btn-outline-primary btn-sm"
									title="Detail">

									<i class="fas fa-eye"></i>

								</a>

								<a
									href="<?= url('/admin/users/edit?id='.$user['id']) ?>"
									class="btn btn-outline-warning btn-sm"
									title="Edit">

									<i class="fas fa-edit"></i>

								</a>

								<form
									method="POST"
									action="<?= url('/admin/users/reset-password') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $user['id'] ?>">

									<button
										type="submit"
										class="btn btn-outline-info btn-sm"
										title="Reset Password"
										onclick="return confirm('Reset password user ini?')">

										<i class="fas fa-key"></i>

									</button>

								</form>

								<form
									method="POST"
									action="<?= url('/admin/users/delete') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $user['id'] ?>">

									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										title="Hapus"
										onclick="return confirm('Yakin ingin menghapus user ini?')">

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