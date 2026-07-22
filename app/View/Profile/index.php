<div class="container-fluid">

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<?php if (!empty($user->avatar)): ?>

						<img
							src="<?= storage($user->avatar) ?>"
							alt="<?= e($user->name) ?>"
							class="rounded-circle shadow mb-3"
							style="width:140px;height:140px;object-fit:cover;">

					<?php else: ?>

						<div class="avatar-circle-lg mx-auto mb-3">

							<?= initials($user->name) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold mb-1">

						<?= e($user->name) ?>

					</h4>

					<p class="text-muted mb-3">

						<?= ucfirst($user->role) ?>

					</p>

					<?php if ($user->status === 'active'): ?>

						<span class="badge badge-success px-3 py-2">

                            Aktif

                        </span>

					<?php elseif ($user->status === 'inactive'): ?>

						<span class="badge badge-secondary px-3 py-2">

                            Tidak Aktif

                        </span>

					<?php elseif ($user->status === 'banned'): ?>

						<span class="badge badge-danger px-3 py-2">

                            Diblokir

                        </span>

					<?php endif; ?>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Akun

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless mb-0">

						<tr>
							<th width="220">Nama Lengkap</th>
							<td><?= e($user->name) ?></td>
						</tr>

						<tr>
							<th>Username</th>
							<td><?= e($user->username) ?></td>
						</tr>

						<tr>
							<th>Email</th>
							<td>

								<a href="mailto:<?= e($user->email) ?>">

									<?= e($user->email) ?>

								</a>

							</td>
						</tr>

						<tr>
							<th>Role</th>
							<td>

                                <span class="badge badge-primary">

                                    <?= ucfirst($user->role) ?>

                                </span>

							</td>
						</tr>

						<tr>
							<th>Status</th>
							<td>

								<?php if ($user->status === 'active'): ?>

									<span class="badge badge-success">

                                        Aktif

                                    </span>

								<?php elseif ($user->status === 'inactive'): ?>

									<span class="badge badge-secondary">

                                        Tidak Aktif

                                    </span>

								<?php elseif ($user->status === 'banned'): ?>

									<span class="badge badge-danger">

                                        Diblokir

                                    </span>

								<?php endif; ?>

							</td>
						</tr>

						<tr>
							<th>Login Terakhir</th>
							<td>

								<?= $user->last_login_at
									? date('d F Y H:i', strtotime($user->last_login_at))
									: '-' ?>

							</td>
						</tr>




					</table>

				</div>

			</div>

			<div class="card shadow">

				<div class="card-body d-flex justify-content-between">

					<a
						href="<?= url('/profile/edit') ?>"
						class="btn btn-warning">

						<i class="fas fa-user-edit mr-2"></i>

						Ubah Profil

					</a>

					<a
						href="<?= url('/profile/password') ?>"
						class="btn btn-primary">

						<i class="fas fa-key mr-2"></i>

						Ubah Password

					</a>

				</div>

			</div>

		</div>

	</div>

</div>
