<div class="container-fluid">

	<!-- Hero -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-lg-8">

					<span class="badge badge-primary px-3 py-2 mb-3">

						Master Data

					</span>

					<h3 class="font-weight-bold text-gray-800 mb-2">

						Data Pegawai

					</h3>

					<p class="text-muted mb-4">

						Kelola seluruh data pegawai yang menggunakan sistem pelatihan.
						Data pegawai digunakan sebagai akun internal aplikasi.

					</p>

					<a
						href="<?= url('/admin/employees/create') ?>"
						class="btn btn-primary">

						<i class="fas fa-user-plus mr-2"></i>

						Tambah Pegawai

					</a>

				</div>

				<div class="col-lg-4">

					<div class="card border-left-primary shadow-sm">

						<div class="card-body">

							<small class="text-muted">

								Total Pegawai

							</small>

							<h2 class="font-weight-bold mb-2">

								<?= $total ?>

							</h2>

							<div class="small text-muted">

								Terdaftar pada sistem

							</div>

						</div>

					</div>

				</div>

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

								Total Pegawai

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $total ?>

							</h2>

						</div>

						<i class="fas fa-users fa-3x text-gray-300"></i>

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

								Pegawai Aktif

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $employees->where('user.status','active')->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-check fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6 mb-4">

			<div class="card border-left-warning shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-warning font-weight-bold text-uppercase">

								Nonaktif

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $employees->where('user.status','inactive')->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-clock fa-3x text-gray-300"></i>

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

								Diblokir

							</div>

							<h2 class="font-weight-bold mt-2">

								<?= $employees->where('user.status','banned')->count() ?>

							</h2>

						</div>

						<i class="fas fa-user-slash fa-3x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- Table -->

	<div class="card shadow border-0">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h5 class="font-weight-bold text-primary mb-1">

						Daftar Pegawai

					</h5>

					<small class="text-muted">

						Seluruh akun pegawai yang terdaftar.

					</small>

				</div>

				<span class="badge badge-primary px-3 py-2">

					<?= $employees->count() ?> Pegawai

				</span>

			</div>

		</div>

		<div class="card-body">
			<?php if($employees->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-users fa-5x text-gray-300 mb-3"></i>

					<h4 class="font-weight-bold">

						Belum Ada Pegawai

					</h4>

					<p class="text-muted mb-4">

						Data pegawai masih kosong. Tambahkan pegawai pertama untuk mulai menggunakan sistem.

					</p>

					<a
						href="<?= url('/admin/employees/create') ?>"
						class="btn btn-primary">

						<i class="fas fa-plus-circle mr-2"></i>

						Tambah Pegawai

					</a>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table
						id="employeesTable"
						class="table table-hover align-middle">

						<thead class="thead-light">

						<tr>

							<th width="70">

								#

							</th>

							<th>

								Pegawai

							</th>

							<th>

								Nomor Pegawai

							</th>


							<th>

								Jabatan

							</th>

							<th>

								Kontak

							</th>

							<th width="120">

								Status

							</th>

							<th width="170">

								Aksi

							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($employees as $index => $employee): ?>

							<tr>

								<td>

									<?= $index + 1 ?>

								</td>

								<td>

									<div class="d-flex align-items-center">

										<div
											class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
											style="width:48px;height:48px;font-weight:700;">

											<?= e($employee->user->getInitials()) ?>

										</div>

										<div>

											<div class="font-weight-bold">

												<?= e($employee->user->name) ?>

											</div>

											<div class="text-muted small">

												@<?= e($employee->user->username) ?>

											</div>

											<div class="text-muted small">

												<?= e($employee->user->email) ?>

											</div>

										</div>

									</div>

								</td>

								<td>

									<?= e($employee->employee_number ?: '-') ?>

								</td>



								<td>

									<?= e($employee->getPositionLabel()) ?>

								</td>

								<td>

									<?= e($employee->phone ?: '-') ?>

								</td>

								<td>

									<?php if($employee->user->isActive()): ?>

										<span class="badge badge-success px-3 py-2">

								Aktif

							</span>

									<?php elseif($employee->user->isInactive()): ?>

										<span class="badge badge-warning px-3 py-2">

								Nonaktif

							</span>

									<?php else: ?>

										<span class="badge badge-danger px-3 py-2">

								Diblokir

							</span>

									<?php endif; ?>

								</td>

								<td>

									<div class="btn-group">

										<a
											href="<?= url('/admin/employees/show?id=' . $employee->id) ?>"
											class="btn btn-outline-info btn-sm"
											title="Detail">

											<i class="fas fa-eye"></i>

										</a>

										<a
											href="<?= url('/admin/employees/edit?id=' . $employee->id) ?>"
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
												value="<?= $employee->id ?>">

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
	<style>

		.card{
			border:none;
			border-radius:14px;
		}

		.card-header{
			background:#fff;
			border-bottom:1px solid #edf2f7;
		}

		.border-left-primary{
			border-left:4px solid #4e73df!important;
		}

		.border-left-success{
			border-left:4px solid #1cc88a!important;
		}

		.border-left-warning{
			border-left:4px solid #f6c23e!important;
		}

		.border-left-danger{
			border-left:4px solid #e74a3b!important;
		}

		.table thead th{

			border-top:none;

			font-size:12px;

			text-transform:uppercase;

			letter-spacing:.6px;

			font-weight:700;

			color:#6c757d;

		}

		.table td{

			vertical-align:middle;

		}

		.table tbody tr{

			transition:.2s ease;

		}

		.table tbody tr:hover{

			background:#f8f9fc;

			transform:scale(1.002);

		}

		.btn-group .btn{

			border-radius:8px!important;

			margin-right:3px;

		}

		.badge{

			font-size:11px;

			font-weight:600;

		}

		.rounded-circle{

			font-size:16px;

		}

		.card{

			transition:.25s;

		}

		.card:hover{

			box-shadow:0 .5rem 1rem rgba(0,0,0,.08)!important;

		}

		.dataTables_wrapper .dataTables_filter input{

			border-radius:8px;

			border:1px solid #dee2e6;

			padding:.45rem .75rem;

			margin-left:.5rem;

		}

		.dataTables_wrapper .dataTables_length select{

			border-radius:8px;

		}

		.page-item.active .page-link{

			background:#4e73df;

			border-color:#4e73df;

		}

		.page-link{

			border-radius:8px!important;

			margin:0 2px;

		}

	</style>

	<script>

		$(function(){

			$('#employeesTable').DataTable({

				pageLength:10,

				order:[[1,'asc']],

				responsive:true,

				autoWidth:false,

				language:{

					search:"Pencarian :",

					lengthMenu:"Tampilkan _MENU_ data",

					info:"Menampilkan _START_ - _END_ dari _TOTAL_ pegawai",

					infoEmpty:"Tidak ada data",

					zeroRecords:"Data tidak ditemukan",

					paginate:{

						first:"Awal",

						last:"Akhir",

						next:"›",

						previous:"‹"

					}

				}

			});

		});

	</script>
</div>
