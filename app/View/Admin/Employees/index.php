<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Pegawai

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh data pegawai yang bertugas sebagai instruktur pelatihan.

					</p>

				</div>

				<a
					href="<?= url('/admin/employees/create') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Pegawai

				</a>

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

								Total Pegawai

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

		<?php foreach($fields as $field): ?>

			<div class="col-lg-3 col-md-6 mb-4">

				<div class="card border-left-success shadow h-100">

					<div class="card-body">

						<div class="d-flex justify-content-between align-items-center">

							<div>

								<div class="text-xs text-success font-weight-bold text-uppercase">

									<?= $field['name'] ?>

								</div>

								<h2 class="font-weight-bold mb-0">

									<?= $field['total'] ?>

								</h2>

							</div>

							<i class="fas fa-user-tie fa-2x text-gray-300"></i>

						</div>

					</div>

				</div>

			</div>

		<?php endforeach; ?>
	</div>

	<!-- Table -->

	<div class="card shadow">

		<div class="card-header bg-white">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Pegawai

					</h5>

					<small class="text-muted">

						Seluruh pegawai yang terdaftar pada sistem.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

                    <?= count($employees) ?> Pegawai

                </span>

			</div>

		</div>

		<div class="card-body">

			<?php if(empty($employees)): ?>

				<div class="text-center py-5">

					<i class="fas fa-user-tie fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Pegawai

					</h5>

					<p class="text-muted">

						Silahkan tambahkan pegawai terlebih dahulu.

					</p>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table
						id="employeesTable"
						class="table table-hover align-middle">

						<thead class="thead-light">

						<tr>

							<th width="60">

								#

							</th>

							<th>

								Pegawai

							</th>

							<th>

								Kontak

							</th>

							<th>

								Bidang

							</th>

							<th width="170">

								Bergabung

							</th>

							<th width="120">

								Status

							</th>

							<th width="160">

								Aksi

							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($employees as $i => $employee): ?>

							<tr>

								<td>

									<?= $i + 1 ?>

								</td>

								<td>

									<div class="d-flex align-items-center">

										<?php if(!empty($employee['avatar'])): ?>

											<img
												src="<?= avatar($employee) ?>"
												class="rounded-circle shadow mr-3"
												width="50"
												height="50"
												style="object-fit:cover;">

										<?php else: ?>

											<div class="avatar-circle mr-3">

												<?= initials($employee['name']) ?>

											</div>

										<?php endif; ?>

										<div>

											<div class="font-weight-bold">

												<?= $employee['name'] ?>

											</div>

											<small class="text-muted">

												@<?= $employee['username'] ?>

											</small>

											<br>

											<small class="text-muted">

												EMP-<?= str_pad($employee['id'],4,'0',STR_PAD_LEFT) ?>

											</small>

										</div>

									</div>

								</td>

								<td>

									<div>

										<i class="fas fa-envelope text-primary mr-2"></i>

										<?= $employee['email'] ?>

									</div>

									<small class="text-muted">

										<i class="fas fa-phone mr-2"></i>

										<?= $employee['phone'] ?: '-' ?>

									</small>

								</td>

								<td>

									<strong>

										<?= $employee['field_name'] ?>

									</strong>

									<br>

									<small class="text-muted">

										<?= $employee['position'] ?: '-' ?>

									</small>

								</td>

								<td>

									<?= date(
										'd M Y',
										strtotime($employee['created_at'])
									) ?>

								</td>

								<td>

									<?php if($employee['status'] == 'active'): ?>

										<span class="badge badge-success px-3 py-2">

                <i class="fas fa-check-circle mr-1"></i>

                Aktif

            </span>

									<?php elseif($employee['status'] == 'inactive'): ?>

										<span class="badge badge-warning px-3 py-2">

                <i class="fas fa-pause-circle mr-1"></i>

                Nonaktif

            </span>

									<?php else: ?>

										<span class="badge badge-danger px-3 py-2">

                <i class="fas fa-ban mr-1"></i>

                Diblokir

            </span>

									<?php endif; ?>

								</td>

								<td>

									<div class="btn-group shadow-sm">

										<a
											href="<?= url('/admin/employees/show?id='.$employee['id']) ?>"
											class="btn btn-outline-primary btn-sm"
											title="Detail">

											<i class="fas fa-eye"></i>

										</a>

										<a
											href="<?= url('/admin/employees/edit?id='.$employee['id']) ?>"
											class="btn btn-outline-warning btn-sm"
											title="Edit">

											<i class="fas fa-edit"></i>

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
												class="btn btn-outline-danger btn-sm"
												onclick="return confirm('Yakin ingin menghapus pegawai ini?')">

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