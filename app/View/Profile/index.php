<div class="container-fluid">

	<div class="row">

        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-body text-center">

                    <?php if (has_avatar()): ?>

                        <img
                                src="<?= avatar() ?>"
                                alt="<?= user()['name'] ?>"
                                class="rounded-circle shadow mb-3"
                                style="
                        width: 140px;
                        height: 140px;
                        object-fit: cover;
                    ">

                    <?php else: ?>

                        <div class="avatar-circle-lg mx-auto mb-3">

                            <?= initials(user()['name']) ?>

                        </div>

                    <?php endif; ?>

                    <h4 class="font-weight-bold">

                        <?= user()['name'] ?>

                    </h4>

                    <p class="text-muted mb-2">

                        <?= ucfirst(user()['role']) ?>

                    </p>

                    <?php if (user()['is_active']): ?>

                        <span class="badge badge-success">

                    Akun Aktif

                </span>

                    <?php else: ?>

                        <span class="badge badge-danger">

                    Akun Nonaktif

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

							<th width="220">
								Nama Lengkap
							</th>

							<td>
								<?= auth()->user()['name'] ?>
							</td>

						</tr>

						<tr>

							<th>
								Username
							</th>

							<td>
								<?= auth()->user()['username'] ?>
							</td>

						</tr>
                        <tr>

                            <th>
                                Email
                            </th>

                            <td>

                                <a href="mailto:<?= auth()->user()['email'] ?>">

                                    <?= auth()->user()['email'] ?>

                                </a>

                            </td>

                        </tr>


                        <tr>

							<th>
								Role
							</th>

							<td>

                                <span class="badge badge-primary">

                                    <?= ucfirst(auth()->user()['role']) ?>

                                </span>

							</td>

						</tr>

						<tr>

							<th>
								Status
							</th>

							<td>

								<?php if(auth()->user()['is_active']): ?>

									<span class="badge badge-success">

                                        Aktif

                                    </span>

								<?php else: ?>

									<span class="badge badge-danger">

                                        Nonaktif

                                    </span>

								<?php endif; ?>

							</td>

						</tr>

						<tr>

							<th>
								Login Terakhir
							</th>

							<td>

								<?= auth()->user()['last_login_at'] ?? '-' ?>

							</td>

						</tr>

						<tr>

							<th>
								Bergabung
							</th>

							<td>

								<?= date('d F Y', strtotime(auth()->user()['created_at'])) ?>

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