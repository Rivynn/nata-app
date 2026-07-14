<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4 bg-gradient-primary text-white">

		<div class="card-body py-4">

			<div class="row align-items-center">

				<div class="col">

					<h2 class="font-weight-bold mb-2">

						Status Pendaftaran

					</h2>

					<p class="mb-0 text-white-50">

						Pantau seluruh proses pendaftaran pelatihan Anda secara realtime.

					</p>

				</div>

				<div class="col-auto text-center">

					<div
						class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow"
						style="width:70px;height:70px;">

						<i class="fas fa-clipboard-check fa-2x"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php if(empty($registrations)): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-folder-open fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Pendaftaran

				</h4>

				<p class="text-muted">

					Anda belum mengikuti pelatihan apapun.

				</p>

				<a
					href="<?= url('/peserta/registrations') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus mr-2"></i>

					Daftar Sekarang

				</a>

			</div>

		</div>

	<?php else: ?>

		<?php foreach($registrations as $registration): ?>

			<?php

			switch($registration['status']){

				case 'approved':

					$color='success';
					$icon='check-circle';
					$status='Disetujui';
					$progress=100;
					break;

				case 'completed':

					$color='primary';
					$icon='award';
					$status='Selesai';
					$progress=100;
					break;

				case 'rejected':

					$color='danger';
					$icon='times-circle';
					$status='Ditolak';
					$progress=100;
					break;

				default:

					$color='warning';
					$icon='clock';
					$status='Pending';
					$progress=45;

			}

			?>

			<div class="card shadow border-0 mb-4">

				<div class="card-body">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<h4 class="font-weight-bold mb-1">

								<?= $registration['training_name'] ?>

							</h4>

							<small class="text-muted">

								<?= $registration['field_name'] ?>

							</small>

						</div>

						<span class="badge badge-<?= $color ?> px-3 py-2">

                            <i class="fas fa-<?= $icon ?> mr-2"></i>

                            <?= $status ?>

                        </span>

					</div>

					<hr>

					<div class="row">

						<div class="col-md-4">

							<small class="text-muted d-block">

								Lokasi

							</small>

							<strong>

								<?= $registration['location'] ?>

							</strong>

						</div>

						<div class="col-md-4">

							<small class="text-muted d-block">

								Durasi

							</small>

							<strong>

								<?= $registration['duration'] ?>

								Hari

							</strong>

						</div>

						<div class="col-md-4">

							<small class="text-muted d-block">

								Tanggal Daftar

							</small>

							<strong>

								<?= date('d F Y',strtotime($registration['created_at'])) ?>

							</strong>

						</div>

					</div>

					<hr>

					<div class="d-flex justify-content-between mb-2">

						<small>

							Progress Verifikasi

						</small>

						<strong class="text-<?= $color ?>">

							<?= $progress ?>%

						</strong>

					</div>

					<div class="progress mb-4" style="height:10px;">

						<div
							class="progress-bar bg-<?= $color ?>"
							style="width:<?= $progress ?>%">

						</div>

					</div>

					<div class="row text-center">

						<div class="col">

							<div class="<?= $progress>=20?'text-success':'text-gray-400' ?>">

								<i class="fas fa-file-import fa-lg"></i>

								<br>

								<small>

									Dikirim

								</small>

							</div>

						</div>

						<div class="col">

							<div class="<?= $progress>=50?'text-success':'text-gray-400' ?>">

								<i class="fas fa-user-check fa-lg"></i>

								<br>

								<small>

									Diverifikasi

								</small>

							</div>

						</div>

						<div class="col">

							<div class="<?= $registration['status']=='approved' || $registration['status']=='completed'?'text-success':'text-gray-400' ?>">

								<i class="fas fa-check-circle fa-lg"></i>

								<br>

								<small>

									Disetujui

								</small>

							</div>

						</div>

						<div class="col">

							<div class="<?= $registration['status']=='completed'?'text-success':'text-gray-400' ?>">

								<i class="fas fa-award fa-lg"></i>

								<br>

								<small>

									Selesai

								</small>

							</div>

						</div>

					</div>

					<?php if($registration['status']=='rejected'): ?>

						<div class="alert alert-danger mt-4 mb-0">

							<strong>

								Alasan Penolakan

							</strong>

							<br>

							<?= $registration['rejected_reason'] ?>

						</div>

					<?php endif; ?>

				</div>

			</div>

		<?php endforeach; ?>

	<?php endif; ?>

</div>