<?php

	/**
	 * @var string $title
	 * @var \Natasya\NataApp\Model\TrainingAttendanceSession $session
	 */

?>

<div class="container-fluid">

	<nav aria-label="breadcrumb">

		<ol class="breadcrumb bg-white shadow-sm">

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih') ?>">

					Dashboard

				</a>

			</li>

			<li class="breadcrumb-item">

				<a href="<?= url('/pelatih/attendances') ?>">

					Kelola Absensi

				</a>

			</li>

			<li class="breadcrumb-item active">

				QR Code

			</li>

		</ol>

	</nav>

	<div class="card shadow border-left-primary mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h3 class="font-weight-bold text-primary mb-1">

						<?= e($title) ?>

					</h3>

					<p class="text-muted mb-0">

						Tampilkan QR Code berikut kepada peserta untuk melakukan absensi.

					</p>

				</div>

				<span class="badge badge-success px-3 py-2">

                    Sesi Aktif

                </span>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-header">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Sesi

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless table-sm mb-0">

						<tr>

							<th width="120">

								Pelatihan

							</th>

							<td>

								<?= e($session->trainingSchedule->training->name) ?>

							</td>

						</tr>

						<tr>

							<th>

								Pertemuan

							</th>

							<td>

								<?= e($session->trainingSchedule->getMeetingLabel()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Tanggal

							</th>

							<td>

								<?= $session->trainingSchedule->schedule_date->format('d M Y') ?>

							</td>

						</tr>

						<tr>

							<th>

								Jam

							</th>

							<td>

								<?= e($session->trainingSchedule->getTimeRange()) ?>

							</td>

						</tr>

						<tr>

							<th>

								Metode

							</th>

							<td>

								<?= strtoupper($session->attendance_type) ?>

							</td>

						</tr>

						<tr>

							<th>

								Berakhir

							</th>

							<td>

								<?= $session->expired_at->format('d M Y H:i') ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow">

				<div class="card-body text-center">

					<h5 class="font-weight-bold mb-4">

						Scan QR Code

					</h5>

					<div
						id="qrcode"
						class="d-inline-block p-4 bg-white border rounded">

					</div>

					<p class="text-muted mt-4 mb-0">

						Peserta dapat melakukan absensi dengan memindai QR Code ini.

					</p>

				</div>

			</div>

		</div>

	</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>

	new QRCode(document.getElementById('qrcode'), {

		text: "<?= e($session->qr_token) ?>",

		width: 320,

		height: 320,

		correctLevel: QRCode.CorrectLevel.H

	});

	setInterval(function () {

		location.reload();

	}, 30000);

</script>
