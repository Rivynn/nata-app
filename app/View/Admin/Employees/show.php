<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Detail Pegawai

					</h4>

					<p class="text-muted mb-0">

						Informasi lengkap akun pegawai.

					</p>

				</div>

				<a
					href="<?= url('/admin/employees') ?>"
					class="btn btn-secondary">

					<i class="fas fa-arrow-left mr-2"></i>

					Kembali

				</a>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow">

				<div class="card-body text-center">

					<?php if(!empty($employee['avatar'])): ?>

						<img
							src="<?= avatar($employee) ?>"
							class="rounded-circle shadow mb-3"
							width="140"
							height="140"
							style="object-fit:cover;">

					<?php else: ?>

						<div class="avatar-circle-lg mx-auto mb-3">

							<?= initials($employee['name']) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold">

						<?= $employee['name'] ?>

					</h4>

					<p class="text-muted">

						@<?= $employee['username'] ?>

					</p>

					<span class="badge badge-info px-3 py-2">

                        <i class="fas fa-user-tie mr-1"></i>

                        Pegawai

                    </span>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow">

				<div class="card-header bg-white">

					<h6 class="font-weight-bold text-primary mb-0">

						Informasi Pegawai

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-bordered">

						<tr>

							<th width="220">

								Nama Lengkap

							</th>

							<td>

								<?= $employee['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Username

							</th>

							<td>

								<?= $employee['username'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= $employee['email'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Role

							</th>

							<td>

                                <span class="badge badge-info">

                                    Pegawai

                                </span>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

								<?php if(($employee['status'] ?? 'active') === 'active'): ?>

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

								<?= $employee['last_login_at'] ?? '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Dibuat Pada

							</th>

							<td>

								<?= date(
									'd M Y H:i',
									strtotime($employee['created_at'])
								) ?>

							</td>

						</tr>

					</table>

				</div>

				<div class="card-footer bg-white d-flex justify-content-between">

					<a
						href="<?= url('/admin/employees/edit?id='.$employee['id']) ?>"
						class="btn btn-warning">

						<i class="fas fa-edit mr-2"></i>

						Edit Pegawai

					</a>

					<form
						method="POST"
						action="<?= url('/admin/employees/delete') ?>"
						class="d-inline">

						<input
							type="hidden"
							name="id"
							value="<?= $employee['id'] ?>">

						<button
							type="submit"
							class="btn btn-danger"
							onclick="return confirm('Yakin ingin menghapus pegawai ini?')">

							<i class="fas fa-trash mr-2"></i>

							Hapus

						</button>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>