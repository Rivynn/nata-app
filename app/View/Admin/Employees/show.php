<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<span class="badge badge-primary px-3 py-2 mb-3">

						Master Data

					</span>

					<h3 class="font-weight-bold text-gray-800 mb-2">

						Detail Pegawai

					</h3>

					<p class="text-muted mb-0">

						Informasi lengkap akun pegawai yang terdaftar pada sistem.

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

			<div class="card shadow border-0">

				<div class="card-body text-center">

					<div
						class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4"
						style="width:130px;height:130px;font-size:42px;font-weight:bold;">

						<?= e($employee->user->getInitials()) ?>

					</div>

					<h4 class="font-weight-bold">

						<?= e($employee->user->name) ?>

					</h4>

					<p class="text-muted mb-3">

						@<?= e($employee->user->username) ?>

					</p>

					<span class="badge badge-info px-3 py-2">

						Pegawai

					</span>

					<hr>

					<div class="text-left">

						<div class="d-flex justify-content-between mb-3">

							<span class="text-muted">

								Nomor Pegawai

							</span>

							<strong>

								<?= e($employee->employee_number ?: '-') ?>

							</strong>

						</div>

						<div class="d-flex justify-content-between mb-3">

							<span class="text-muted">

								Departemen

							</span>

							<strong>

								<?= e($employee->getDepartmentLabel()) ?>

							</strong>

						</div>

						<div class="d-flex justify-content-between">

							<span class="text-muted">

								Jabatan

							</span>

							<strong>

								<?= e($employee->getPositionLabel()) ?>

							</strong>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow border-0">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Pegawai

					</h5>

				</div>

				<div class="card-body">
					<div class="row">

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Nama Lengkap

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= e($employee->user->name) ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Username

								</small>

								<h6 class="font-weight-bold mb-0">

									@<?= e($employee->user->username) ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Email

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= e($employee->user->email) ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Nomor Telepon

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= e($employee->phone ?: '-') ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Nomor Pegawai

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= e($employee->employee_number ?: '-') ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Role

								</small>

								<span class="badge badge-info px-3 py-2">

				Pegawai

			</span>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Status Akun

								</small>

								<?php if($employee->user->isActive()): ?>

									<span class="badge badge-success px-3 py-2">

					<i class="fas fa-check-circle mr-1"></i>

					Aktif

				</span>

								<?php elseif($employee->user->isInactive()): ?>

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

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3 mb-3">

								<small class="text-muted d-block mb-1">

									Terakhir Login

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= $employee->user->last_login_at
										? date('d M Y H:i', strtotime($employee->user->last_login_at))
										: '-' ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3">

								<small class="text-muted d-block mb-1">

									Dibuat Pada

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= date('d M Y H:i', strtotime($employee->user->created_at)) ?>

								</h6>

							</div>

						</div>

						<div class="col-md-6">

							<div class="border rounded p-3">

								<small class="text-muted d-block mb-1">

									Terakhir Diperbarui

								</small>

								<h6 class="font-weight-bold mb-0">

									<?= date('d M Y H:i', strtotime($employee->updated_at)) ?>

								</h6>

							</div>

						</div>

					</div>
					<div class="card-footer bg-white">

						<div class="d-flex justify-content-between align-items-center flex-wrap">

							<div>

								<a
									href="<?= url('/admin/employees') ?>"
									class="btn btn-light border">

									<i class="fas fa-arrow-left mr-2"></i>

									Kembali

								</a>

							</div>

							<div class="btn-group">

								<a
									href="<?= url('/admin/employees/edit?id=' . $employee->id) ?>"
									class="btn btn-warning">

									<i class="fas fa-edit mr-2"></i>

									Edit

								</a>

								<button
									class="btn btn-primary dropdown-toggle dropdown-toggle-split"
									data-toggle="dropdown">

								</button>

								<div class="dropdown-menu dropdown-menu-right shadow">

									<h6 class="dropdown-header">

										Aksi Pegawai

									</h6>

									<a
										class="dropdown-item"
										href="<?= url('/admin/employees/edit?id=' . $employee->id) ?>">

										<i class="fas fa-edit text-warning mr-2"></i>

										Edit Data

									</a>

									<a
										class="dropdown-item"
										href="<?= url('/admin/users/show?id=' . $employee->user->id) ?>">

										<i class="fas fa-user text-primary mr-2"></i>

										Lihat Akun

									</a>

									<div class="dropdown-divider"></div>

									<a
										class="dropdown-item"
										href="<?= url('/admin/users/reset-password?id=' . $employee->user->id) ?>">

										<i class="fas fa-key text-info mr-2"></i>

										Reset Password

									</a>

									<?php if($employee->user->isActive()): ?>

										<a
											class="dropdown-item"
											href="<?= url('/admin/users/deactivate?id=' . $employee->user->id) ?>">

											<i class="fas fa-user-slash text-warning mr-2"></i>

											Nonaktifkan Akun

										</a>

									<?php else: ?>

										<a
											class="dropdown-item"
											href="<?= url('/admin/users/activate?id=' . $employee->user->id) ?>">

											<i class="fas fa-user-check text-success mr-2"></i>

											Aktifkan Akun

										</a>

									<?php endif; ?>

									<div class="dropdown-divider"></div>

									<form
										method="POST"
										action="<?= url('/admin/employees/delete') ?>"
										onsubmit="return confirm('Yakin ingin menghapus pegawai ini?');">

										<input
											type="hidden"
											name="id"
											value="<?= $employee->id ?>">

										<button
											type="submit"
											class="dropdown-item text-danger">

											<i class="fas fa-trash mr-2"></i>

											Hapus Pegawai

										</button>

									</form>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>
	<style>

		.card{

			border:none;

			border-radius:14px;

		}

		.card-header{

			border-bottom:1px solid #edf2f7;

		}

		.border{

			border:1px solid #edf2f7!important;

		}

		.rounded-circle{

			background:linear-gradient(135deg,#4e73df,#224abe);

			box-shadow:0 .75rem 1.5rem rgba(78,115,223,.25);

		}

		.badge{

			font-size:11px;

			font-weight:600;

			letter-spacing:.3px;

		}

		.btn{

			border-radius:8px;

		}

		.dropdown-menu{

			border:none;

			border-radius:12px;

			box-shadow:0 .75rem 2rem rgba(0,0,0,.12);

		}

		.dropdown-item{

			padding:.65rem 1rem;

		}

		.dropdown-item:hover{

			background:#f8f9fc;

		}

		.card:hover{

			box-shadow:0 .75rem 2rem rgba(0,0,0,.08)!important;

			transition:.2s;

		}

		.border.rounded{

			border-radius:10px!important;

			background:#fff;

			transition:.2s;

		}

		.border.rounded:hover{

			background:#f8f9fc;

			border-color:#dbe5f1!important;

			transform:translateY(-2px);

		}

		small{

			font-size:12px;

		}

		h6{

			margin-bottom:0;

			font-weight:700;

		}

	</style>
