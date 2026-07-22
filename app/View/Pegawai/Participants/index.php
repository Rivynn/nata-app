<div class="container-fluid">

	<!-- Header -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h3 class="font-weight-bold text-primary mb-1">
				Data Peserta
			</h3>

			<p class="text-muted mb-0">
				Daftar peserta yang telah disetujui mengikuti pelatihan.
			</p>

		</div>

	</div>

	<!-- Quick Filter -->
	<div class="card shadow mb-4">

		<div class="card-body">

			<div class="d-flex flex-wrap">

				<a
					href="<?= url('/pegawai/participants') ?>"
					class="btn <?= $selectedTraining === 0 ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm mr-2 mb-2">

					Semua

					<span class="badge badge-light ml-1">

                        <?= $participants->count() ?>

                    </span>

				</a>

				<?php foreach ($trainings as $training): ?>

					<a
						href="<?= url('/pegawai/participants?training=' . $training->id) ?>"
						class="btn <?= $selectedTraining == $training->id ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm mr-2 mb-2">

						<?= e($training->name) ?>

						<span class="badge badge-light ml-1">

                            <?= $training->approved_count ?>

                        </span>

					</a>

				<?php endforeach; ?>

			</div>

		</div>

	</div>

	<!-- Search -->
	<div class="card shadow mb-4">

		<div class="card-body">

			<div class="input-group">

				<div class="input-group-prepend">

                    <span class="input-group-text bg-white">

                        <i class="fas fa-search"></i>

                    </span>

				</div>

				<input
					type="text"
					id="participantSearch"
					class="form-control"
					placeholder="Cari peserta berdasarkan nama, email, atau pelatihan...">

			</div>

		</div>

	</div>
	<div class="card shadow mb-4">

		<div class="card-header py-3 d-flex justify-content-between align-items-center">

			<h6 class="m-0 font-weight-bold text-primary">

				Daftar Peserta

			</h6>

			<span class="badge badge-primary">

            <?= $participants->count() ?> Peserta

        </span>

		</div>

		<div class="card-body">

			<?php if ($participants->isEmpty()): ?>

				<div class="text-center py-5">

					<i class="fas fa-users fa-4x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Peserta

					</h5>

					<p class="text-muted mb-0">

						Belum terdapat peserta yang telah disetujui.

					</p>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table
						id="participantsTable"
						class="table table-hover table-bordered mb-0">

						<thead class="thead-light">

						<tr>

							<th width="60">

								No

							</th>

							<th>

								Peserta

							</th>

							<th>

								Pelatihan

							</th>

							<th>

								Trainer

							</th>

							<th>

								Disetujui Oleh

							</th>

							<th width="170">

								Tanggal Disetujui

							</th>

							<th width="90">

								Aksi

							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach ($participants as $index => $participant): ?>

							<tr>

								<td>

									<?= $index + 1 ?>

								</td>

								<td>

									<strong>

										<?= e($participant->participant->user->name) ?>

									</strong>

									<br>

									<small class="text-muted">

										<?= e($participant->participant->user->email) ?>

									</small>

								</td>

								<td>

									<strong>

										<?= e($participant->training->name) ?>

									</strong>

									<br>

									<small class="text-muted">

										<?= e($participant->training->trainingField->name) ?>

									</small>

								</td>

								<td>

									<?= e($participant->training->trainer->user->name ?? '-') ?>

								</td>

								<td>

									<?= e($participant->approver->name ?? '-') ?>

								</td>

								<td>

									<?= $participant->approved_at?->format('d M Y H:i') ?? '-' ?>

								</td>

								<td class="text-center">

									<a
										href="<?= url('/pegawai/participants/show?id=' . $participant->id) ?>"
										class="btn btn-sm btn-outline-primary">

										<i class="fas fa-eye"></i>

									</a>

								</td>

							</tr>

						<?php endforeach; ?>

						</tbody>

					</table>

				</div>

			<?php endif; ?>

		</div>

	</div>
	<script>

		$(function () {

			const table = $('#participantsTable').DataTable({

				responsive: true,

				autoWidth: false,

				pageLength: 10,

				order: [
					[0, 'asc']
				],

				language: {

					emptyTable: "Belum ada data peserta.",

					zeroRecords: "Peserta tidak ditemukan.",

					info: "Menampilkan _START_ - _END_ dari _TOTAL_ peserta",

					infoEmpty: "Menampilkan 0 peserta",

					lengthMenu: "Tampilkan _MENU_ peserta",

					search: "Cari:",

					paginate: {

						first: "Awal",

						previous: "‹",

						next: "›",

						last: "Akhir"

					}

				}

			});

			$('#participantSearch').on('keyup', function () {

				table.search($(this).val()).draw();

			});

		});

	</script>

</div>
