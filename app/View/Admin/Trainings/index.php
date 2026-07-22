<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Pelatihan

					</h4>

					<p class="text-muted mb-0">

						Kelola seluruh program pelatihan yang tersedia pada sistem.

					</p>

				</div>


				<a
					href="<?= url('/admin/trainings/create') ?>"
					class="btn btn-primary shadow-sm">

					<i class="fas fa-plus-circle mr-2"></i>

					Tambah Pelatihan

				</a>

			</div>

		</div>

	</div>


	<div class="row">


		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-primary shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-primary font-weight-bold text-uppercase">

								Total Pelatihan

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $total ?>

							</h2>

						</div>


						<i class="fas fa-book-open fa-2x text-gray-300"></i>

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

								Dibuka

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $trainings->where('status','open')->count() ?>

							</h2>

						</div>


						<i class="fas fa-door-open fa-2x text-gray-300"></i>

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

								Berjalan

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $trainings->where('status','running')->count() ?>

							</h2>

						</div>


						<i class="fas fa-spinner fa-2x text-gray-300"></i>

					</div>

				</div>

			</div>

		</div>



		<div class="col-lg-3 col-md-6 mb-4">

			<div class="card border-left-info shadow h-100">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<div class="text-xs text-info font-weight-bold text-uppercase">

								Selesai

							</div>

							<h2 class="font-weight-bold mb-0">

								<?= $trainings->where('status','completed')->count() ?>

							</h2>

						</div>


						<i class="fas fa-check-circle fa-2x text-gray-300"></i>

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

						Daftar Pelatihan

					</h5>

					<small class="text-muted">

						Seluruh program pelatihan yang tersedia pada sistem.

					</small>

				</div>


				<span class="badge badge-primary px-3 py-2">

					<?= $trainings->count() ?> Pelatihan

				</span>

			</div>

		</div>


		<div class="card-body">


			<?php if($trainings->isEmpty()): ?>


				<div class="text-center py-5">


					<i class="fas fa-book-open fa-5x text-gray-300 mb-3"></i>


					<h5 class="font-weight-bold">

						Belum Ada Pelatihan

					</h5>


					<p class="text-muted">

						Silahkan tambahkan program pelatihan terlebih dahulu.

					</p>


				</div>


			<?php else: ?>
				<div class="card bg-light border-0 mb-4">

					<div class="card-body">

						<div class="row">


							<div class="col-md-4 mb-3">

								<label class="font-weight-bold">

									Bidang Pelatihan

								</label>


								<select
									id="filterField"
									class="form-control">


									<option value="">

										Semua Bidang

									</option>


									<?php foreach($trainings->pluck('trainingField')->filter()->unique('id') as $field): ?>


										<option value="<?= e($field->name) ?>">

											<?= e($field->name) ?>

										</option>


									<?php endforeach; ?>


								</select>


							</div>



							<div class="col-md-4 mb-3">

								<label class="font-weight-bold">

									Status

								</label>


								<select
									id="filterStatus"
									class="form-control">


									<option value="">

										Semua Status

									</option>


									<option value="Draft">

										Draft

									</option>


									<option value="Dibuka">

										Dibuka

									</option>


									<option value="Berjalan">

										Berjalan

									</option>


									<option value="Selesai">

										Selesai

									</option>


									<option value="Ditutup">

										Ditutup

									</option>


									<option value="Dibatalkan">

										Dibatalkan

									</option>


								</select>


							</div>



							<div class="col-md-4 mb-3 d-flex align-items-end">


								<button
									type="button"
									id="resetFilter"
									class="btn btn-secondary btn-block">


									<i class="fas fa-sync mr-2"></i>

									Reset Filter


								</button>


							</div>


						</div>


					</div>


				</div>

			<div class="table-responsive">


				<table
					id="trainingTable"
					class="table table-hover align-middle">


					<thead class="thead-light">


					<tr>


						<th width="60">

							#

						</th>


						<th>

							Pelatihan

						</th>


						<th>

							Bidang

						</th>


						<th>

							Pelatih

						</th>


						<th>

							Periode

						</th>


						<th>

							Kuota

						</th>


						<th>

							Status

						</th>


						<th width="150">

							Aksi

						</th>


					</tr>


					</thead>


					<tbody>


					<?php foreach($trainings as $index => $training): ?>


					<tr>


						<td>

							<?= $index + 1 ?>

						</td>



						<td>


							<div class="font-weight-bold">


								<?= e($training->name) ?>


							</div>


							<small class="text-muted">


								<?= e($training->code ?: '-') ?>


							</small>


						</td>



						<td>


							<?php if($training->trainingField): ?>


								<span class="badge badge-primary px-3 py-2">


										<i class="<?= e($training->trainingField->icon) ?> mr-1"></i>


										<?= e($training->trainingField->name) ?>


									</span>


							<?php else: ?>


								<span class="text-muted">

										-

									</span>


							<?php endif; ?>


						</td>



						<td>


							<?php if($training->trainer): ?>


								<div class="font-weight-bold">


									<?= e($training->trainer->user->name ?? '-') ?>


								</div>


								<small class="text-muted">


									<?= e($training->trainer->expertise ?? '-') ?>


								</small>


							<?php else: ?>


								<span class="text-muted">

										Belum ditentukan

									</span>


							<?php endif; ?>


						</td>
						<td>

							<?php if($training->training_start && $training->training_end): ?>

								<div>

									<i class="fas fa-calendar-alt text-primary mr-1"></i>

									<?= $training->training_start->format('d M Y') ?>

								</div>

								<small class="text-muted">

									s/d

									<?= $training->training_end->format('d M Y') ?>

								</small>

							<?php else: ?>

								<span class="text-muted">

										Belum ditentukan

									</span>

							<?php endif; ?>

						</td>


						<td>

								<span class="badge badge-info px-3 py-2">

									<i class="fas fa-users mr-1"></i>

									<?= $training->getQuotaLabel() ?>

								</span>

						</td>


						<td>


							<?php if($training->isDraft()): ?>


								<span class="badge badge-secondary px-3 py-2">

										<i class="fas fa-file mr-1"></i>

										Draft

									</span>


							<?php elseif($training->isOpen()): ?>


								<span class="badge badge-success px-3 py-2">

										<i class="fas fa-door-open mr-1"></i>

										Dibuka

									</span>


							<?php elseif($training->isRunning()): ?>


								<span class="badge badge-primary px-3 py-2">

										<i class="fas fa-play-circle mr-1"></i>

										Berjalan

									</span>


							<?php elseif($training->isCompleted()): ?>


								<span class="badge badge-info px-3 py-2">

										<i class="fas fa-check-circle mr-1"></i>

										Selesai

									</span>


							<?php elseif($training->isClosed()): ?>


								<span class="badge badge-warning px-3 py-2">

										<i class="fas fa-lock mr-1"></i>

										Ditutup

									</span>


							<?php elseif($training->isCancelled()): ?>


								<span class="badge badge-danger px-3 py-2">

										<i class="fas fa-times-circle mr-1"></i>

										Dibatalkan

									</span>


							<?php endif; ?>


						</td>



						<td>

							<div class="btn-group shadow-sm">


								<a
									href="<?= url('/admin/trainings/show?id=' . $training->id) ?>"
									class="btn btn-outline-primary btn-sm"
									title="Detail">

									<i class="fas fa-eye"></i>

								</a>



								<a
									href="<?= url('/admin/trainings/edit?id=' . $training->id) ?>"
									class="btn btn-outline-warning btn-sm"
									title="Edit">

									<i class="fas fa-edit"></i>

								</a>



								<?php if(
									!$training->isCompleted() &&
									!$training->isCancelled()
								): ?>

									<div class="btn-group">


										<button
											type="button"
											class="btn btn-outline-info btn-sm dropdown-toggle"
											data-toggle="dropdown"
											title="Ubah Status">

											<i class="fas fa-sync-alt"></i>

										</button>


										<div class="dropdown-menu dropdown-menu-right">


											<?php if($training->isDraft()): ?>


												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="open">


													<button
														class="dropdown-item">

														<i class="fas fa-door-open text-success mr-2"></i>

														Buka Pendaftaran

													</button>

												</form>


												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="cancelled">


													<button
														class="dropdown-item text-danger">

														<i class="fas fa-times mr-2"></i>

														Batalkan

													</button>

												</form>



											<?php elseif($training->isOpen()): ?>


												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="closed">


													<button
														class="dropdown-item">

														<i class="fas fa-lock text-warning mr-2"></i>

														Tutup Pendaftaran

													</button>

												</form>



												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="running">


													<button
														class="dropdown-item">

														<i class="fas fa-play text-primary mr-2"></i>

														Mulai Pelatihan

													</button>

												</form>



												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="cancelled">


													<button
														class="dropdown-item text-danger">

														<i class="fas fa-times mr-2"></i>

														Batalkan

													</button>

												</form>



											<?php elseif($training->isClosed()): ?>


												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="running">


													<button
														class="dropdown-item">

														<i class="fas fa-play text-primary mr-2"></i>

														Mulai Pelatihan

													</button>

												</form>



												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="cancelled">


													<button
														class="dropdown-item text-danger">

														<i class="fas fa-times mr-2"></i>

														Batalkan

													</button>

												</form>



											<?php elseif($training->isRunning()): ?>


												<form
													method="POST"
													action="<?= url('/admin/trainings/status') ?>">

													<input
														type="hidden"
														name="id"
														value="<?= $training->id ?>">


													<input
														type="hidden"
														name="status"
														value="completed">


													<button
														class="dropdown-item">

														<i class="fas fa-check text-success mr-2"></i>

														Selesaikan Pelatihan

													</button>

												</form>


											<?php endif; ?>


										</div>


									</div>

								<?php endif; ?>



								<form
									method="POST"
									action="<?= url('/admin/trainings/delete') ?>">


									<input
										type="hidden"
										name="id"
										value="<?= $training->id ?>">


									<button
										type="submit"
										class="btn btn-outline-danger btn-sm"
										title="Hapus"
										onclick="return confirm('Yakin ingin menghapus pelatihan ini?')">


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

	.table td,
	.table th {

		vertical-align: middle;

	}


	.badge {

		font-size: .75rem;

		font-weight: 600;

	}


</style>

<script>
	document.addEventListener('DOMContentLoaded', function(){


		let table = $('#trainingTable').DataTable({

			responsive:true,

			autoWidth:false,

			pageLength:10,

			order:[
				[0,'asc']
			],

			columnDefs:[
				{
					orderable:false,
					targets:[7]
				}
			]

		});



		// Filter Bidang

		$('#filterField').on('change', function(){


			table
				.column(2)
				.search(this.value)
				.draw();


		});



		// Filter Status

		$('#filterStatus').on('change', function(){


			table
				.column(6)
				.search(this.value)
				.draw();


		});



		// Reset

		$('#resetFilter').on('click', function(){


			$('#filterField').val('');

			$('#filterStatus').val('');


			table
				.search('')
				.columns()
				.search('')
				.draw();


		});


	});
</script>



