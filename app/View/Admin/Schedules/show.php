<div class="container-fluid">

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<div
						class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow mb-3"
						style="width:110px;height:110px;font-size:42px;">

						<i class="fas fa-calendar-alt"></i>

					</div>

					<h4 class="font-weight-bold mb-2">

						<?= $schedule['title'] ?>

					</h4>

					<p class="text-muted mb-3">

						<?= $schedule['training_name'] ?>

					</p>

					<?php

						switch($schedule['status']){

							case 'draft':
								$badge='secondary';
								$text='Draft';
								break;

							case 'scheduled':
								$badge='primary';
								$text='Terjadwal';
								break;

							case 'ongoing':
								$badge='warning';
								$text='Berlangsung';
								break;

							case 'completed':
								$badge='success';
								$text='Selesai';
								break;

							default:
								$badge='danger';
								$text='Dibatalkan';

						}

					?>

					<span class="badge badge-<?= $badge ?> px-3 py-2">

						<?= $text ?>

					</span>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						Informasi Jadwal

					</h5>

				</div>

				<div class="card-body">

					<div class="row">
						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Judul Jadwal

							</label>

							<div class="font-weight-bold">

								<?= $schedule['title'] ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Pelatihan

							</label>

							<div>

								<i class="fas fa-book text-primary mr-2"></i>

								<?= $schedule['training_name'] ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Pelatih

							</label>

							<div>

								<i class="fas fa-chalkboard-teacher text-success mr-2"></i>

								<?= $schedule['trainer_name'] ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Status

							</label>

							<div>

								<span class="badge badge-<?= $badge ?> px-3 py-2">

									<?= $text ?>

								</span>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Lokasi

							</label>

							<div>

								<i class="fas fa-map-marker-alt text-danger mr-2"></i>

								<?= $schedule['location'] ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Ruangan

							</label>

							<div>

								<?= $schedule['room'] ?: '-' ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Tanggal Pelaksanaan

							</label>

							<div>

								<?= date('d F Y', strtotime($schedule['start_date'])) ?>

								—

								<?= date('d F Y', strtotime($schedule['end_date'])) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Waktu

							</label>

							<div>

								<?= substr($schedule['start_time'],0,5) ?>

								-

								<?= substr($schedule['end_time'],0,5) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								Kuota Peserta

							</label>

							<div>

								<?= $schedule['max_participants'] ?>

								Peserta

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted small mb-1">

								ID Jadwal

							</label>

							<div>

								SCH-<?= str_pad($schedule['id'], 4, '0', STR_PAD_LEFT) ?>

							</div>

						</div>

						<div class="col-md-12 mb-4">

							<label class="text-muted small mb-1">

								Catatan

							</label>

							<div class="border rounded p-3 bg-light">

								<?= nl2br($schedule['notes'] ?: '-') ?>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Dibuat Pada

							</label>

							<div>

								<?= date(
									'd F Y H:i',
									strtotime($schedule['created_at'])
								) ?>

							</div>

						</div>

						<div class="col-md-6">

							<label class="text-muted small mb-1">

								Terakhir Diubah

							</label>

							<div>

								<?= date(
									'd F Y H:i',
									strtotime($schedule['updated_at'])
								) ?>

							</div>

						</div>

					</div>

				</div>

			</div>
			<div class="card shadow">

				<div class="card-footer bg-white">

					<div class="d-flex justify-content-between">

						<a
							href="<?= url('/admin/schedules') ?>"
							class="btn btn-outline-secondary">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali

						</a>

						<div>

							<a
								href="<?= url('/admin/schedules/edit?id=' . $schedule['id']) ?>"
								class="btn btn-warning">

								<i class="fas fa-edit mr-2"></i>

								Edit

							</a>

							<form
								method="POST"
								action="<?= url('/admin/schedules/delete') ?>"
								class="d-inline">

								<input
									type="hidden"
									name="id"
									value="<?= $schedule['id'] ?>">

								<button
									type="submit"
									class="btn btn-danger"
									onclick="return confirm('Yakin ingin menghapus jadwal ini?')">

									<i class="fas fa-trash mr-2"></i>

									Hapus

								</button>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>