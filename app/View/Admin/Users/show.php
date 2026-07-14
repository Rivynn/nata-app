<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Detail User

					</h4>

					<p class="text-muted mb-0">

						Informasi lengkap akun pengguna.

					</p>

				</div>

				<a
					href="<?= url('/admin/users') ?>"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left mr-2"></i>

					Kembali

				</a>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- Profile -->

		<div class="col-lg-4">

			<div class="card shadow">

				<div class="card-body text-center">

					<?php if(!empty($user['avatar'])): ?>

						<img
							src="<?= avatar($user) ?>"
							class="rounded-circle shadow mb-3"
							width="140"
							height="140"
							style="object-fit:cover;">

					<?php else: ?>

						<div
							class="avatar-circle-lg mx-auto mb-3">

							<?= initials($user['name']) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold">

						<?= $user['name'] ?>

					</h4>

					<p class="text-muted mb-3">

						@<?= $user['username'] ?>

					</p>

					<?php if($user['role']=='admin'): ?>

						<span class="badge badge-danger px-3 py-2">

                            Admin

                        </span>

					<?php elseif($user['role']=='pegawai'): ?>

						<span class="badge badge-info px-3 py-2">

                            Pegawai

                        </span>

					<?php else: ?>

						<span class="badge badge-success px-3 py-2">

                            Peserta

                        </span>

					<?php endif; ?>

				</div>

			</div>

		</div>

		<!-- Detail -->

		<div class="col-lg-8">

			<div class="card shadow">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Informasi User

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-bordered">

						<tr>

							<th width="220">

								Nama Lengkap

							</th>

							<td>

								<?= $user['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Username

							</th>

							<td>

								<?= $user['username'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= $user['email'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Role

							</th>

							<td>

								<?= ucfirst($user['role']) ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

								<?php if(($user['status'] ?? 'active')=='active'): ?>

									<span class="badge badge-success">

                                        Aktif

                                    </span>

								<?php else: ?>

									<span class="badge badge-secondary">

                                        Nonaktif

                                    </span>

								<?php endif; ?>

							</td>

						</tr>

						<tr>

							<th>

								Terakhir Login

							</th>

							<td>

								<?= $user['last_login_at'] ?? '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Dibuat

							</th>

							<td>

								<?= date('d M Y H:i',strtotime($user['created_at'])) ?>

							</td>

						</tr>

					</table>

				</div>

				<div class="card-footer bg-white">

					<a
						href="<?= url('/admin/users/edit?id='.$user['id']) ?>"
						class="btn btn-warning">

						<i class="fas fa-edit mr-2"></i>

						Edit User

					</a>

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
							class="btn btn-danger"
							onclick="return confirm('Yakin ingin menghapus user ini?')">

							<i class="fas fa-trash mr-2"></i>

							Hapus

						</button>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>