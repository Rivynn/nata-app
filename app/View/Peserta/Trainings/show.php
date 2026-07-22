<?php

	/** @var \App\Models\Registration $registration */
	/** @var \App\Models\Training $training */

	$field = $training->trainingField;

	$trainer = $training->trainer;

	$schedule = $training->schedules
		->sortBy('schedule_date')
		->first();

?>

<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-start flex-wrap">

				<div>

                    <span class="badge badge-<?= $field?->color ?? 'primary' ?> mb-3">

                        <i class="<?= $field?->icon ?? 'fas fa-book-open' ?> mr-1"></i>

                        <?= e($field?->name ?? '-') ?>

                    </span>

					<h2 class="font-weight-bold mb-2">

						<?= e($training->name) ?>

					</h2>

					<p class="text-muted mb-0">

						<?= nl2br(e($training->description)) ?>

					</p>

				</div>

				<div class="text-right mt-3 mt-lg-0">

					<?php

						$badge = match ($registration->status) {

							'approved' => 'success',

							'completed' => 'primary',

							'pending' => 'warning',

							'rejected' => 'danger',

							default => 'secondary',

						};

					?>

					<span class="badge badge-<?= $badge ?> px-3 py-2">

                        <?= ucfirst($registration->status) ?>

                    </span>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-info-circle mr-2"></i>

						Informasi Pelatihan

					</h5>

				</div>

				<div class="card-body">

					<table class="table table-borderless mb-0">

						<tr>

							<th width="220">

								Bidang

							</th>

							<td>

								<?= e($field?->name ?? '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Durasi

							</th>

							<td>

								<?= $training->duration ?> Hari

							</td>

						</tr>

						<tr>

							<th>

								Lokasi

							</th>

							<td>

								<?= e($training->location ?: '-') ?>

							</td>

						</tr>

						<tr>

							<th>

								Kuota

							</th>

							<td>

								<?= $training->quota ?> Peserta

							</td>

						</tr>

						<tr>

							<th>

								Pendaftaran

							</th>

							<td>

								<?= $training->registration_open?->format('d M Y') ?? '-' ?>

								-

								<?= $training->registration_close?->format('d M Y') ?? '-' ?>

							</td>

						</tr>

						<tr>

							<th>

								Status Pelatihan

							</th>

							<td>

                                <span class="badge badge-info">

                                    <?= ucfirst($training->status) ?>

                                </span>

							</td>

						</tr>

					</table>

				</div>

			</div>
			<!-- Pelatih -->

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-chalkboard-teacher mr-2"></i>

						Informasi Pelatih

					</h5>

				</div>

				<div class="card-body">

					<div class="media">

						<?php if ($trainer?->user?->avatar_url): ?>

							<img
								src="<?= asset($trainer->user->avatar_url) ?>"
								class="rounded-circle mr-4 shadow"
								width="90"
								height="90"
								style="object-fit:cover;">

						<?php else: ?>

							<div
								class="avatar-circle mr-4"
								style="
                                    width:90px;
                                    height:90px;
                                    font-size:30px;
                                ">

								<?= initials($trainer?->getDisplayName() ?? 'T') ?>

							</div>

						<?php endif; ?>

						<div class="media-body">

							<h4 class="font-weight-bold mb-1">

								<?= e($trainer?->getDisplayName() ?? '-') ?>

							</h4>

							<?php if ($trainer?->institution): ?>

								<div class="text-muted mb-2">

									<i class="fas fa-building mr-2"></i>

									<?= e($trainer->institution) ?>

								</div>

							<?php endif; ?>

							<?php if ($trainer?->trainingField): ?>

								<span class="badge badge-info">

                                    <i class="fas fa-award mr-1"></i>

                                    <?= e($trainer->trainingField->name) ?>

                                </span>

							<?php endif; ?>

						</div>

					</div>

				</div>

			</div>

			<!-- Kompetensi -->

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-award mr-2"></i>

						Kompetensi yang Akan Dipelajari

					</h5>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-3">

							<div class="border rounded p-3 h-100">

								<i class="fas fa-book-open text-primary fa-lg mb-3"></i>

								<h6 class="font-weight-bold">

									Materi Teori

								</h6>

								<p class="text-muted small mb-0">

									Memahami konsep dasar dan teori sesuai bidang pelatihan.

								</p>

							</div>

						</div>

						<div class="col-md-6 mb-3">

							<div class="border rounded p-3 h-100">

								<i class="fas fa-laptop-code text-success fa-lg mb-3"></i>

								<h6 class="font-weight-bold">

									Praktik Langsung

								</h6>

								<p class="text-muted small mb-0">

									Praktik bersama instruktur menggunakan studi kasus nyata.

								</p>

							</div>

						</div>

						<div class="col-md-6 mb-3">

							<div class="border rounded p-3 h-100">

								<i class="fas fa-users text-warning fa-lg mb-3"></i>

								<h6 class="font-weight-bold">

									Diskusi Kelompok

								</h6>

								<p class="text-muted small mb-0">

									Kolaborasi dan penyelesaian kasus secara berkelompok.

								</p>

							</div>

						</div>

						<div class="col-md-6 mb-3">

							<div class="border rounded p-3 h-100">

								<i class="fas fa-certificate text-info fa-lg mb-3"></i>

								<h6 class="font-weight-bold">

									Sertifikat

								</h6>

								<p class="text-muted small mb-0">

									Sertifikat diberikan kepada peserta yang dinyatakan lulus.

								</p>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!-- Persyaratan -->

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-clipboard-check mr-2"></i>

						Persyaratan Peserta

					</h5>

				</div>

				<div class="card-body">

					<ul class="list-unstyled mb-0">

						<li class="mb-3">

							<i class="fas fa-check-circle text-success mr-2"></i>

							Profil peserta telah lengkap.

						</li>

						<li class="mb-3">

							<i class="fas fa-check-circle text-success mr-2"></i>

							Membawa identitas diri saat pelatihan berlangsung.

						</li>

						<li class="mb-3">

							<i class="fas fa-check-circle text-success mr-2"></i>

							Mengikuti seluruh jadwal pelatihan sesuai ketentuan.

						</li>

						<li class="mb-3">

							<i class="fas fa-check-circle text-success mr-2"></i>

							Menjaga ketertiban selama kegiatan berlangsung.

						</li>

						<li>

							<i class="fas fa-check-circle text-success mr-2"></i>

							Mengikuti evaluasi akhir pelatihan.

						</li>

					</ul>

				</div>

			</div>

		</div>
		<!-- RIGHT -->

		<div class="col-lg-4">

			<div class="card shadow sticky-top" style="top:20px;">

				<div class="card-header bg-primary text-white">

					<h5 class="mb-0">

						<i class="fas fa-clipboard-list mr-2"></i>

						Ringkasan

					</h5>

				</div>

				<div class="card-body">

					<table class="table table-sm table-borderless mb-3">

						<tbody>

						<tr>

							<td>Status Peserta</td>

							<td class="text-right">

								<?php

									$badge = match ($registration->status) {

										'approved' => 'success',

										'completed' => 'primary',

										'pending' => 'warning',

										'rejected' => 'danger',

										default => 'secondary',

									};

								?>

								<span class="badge badge-<?= $badge ?>">

                                        <?= ucfirst($registration->status) ?>

                                    </span>

							</td>

						</tr>

						<tr>

							<td>Ruang</td>

							<td class="text-right">

								<?= e($schedule?->room ?? '-') ?>

							</td>

						</tr>

						<tr>

							<td>Tanggal</td>

							<td class="text-right">

								<?= $schedule?->schedule_date?->format('d M Y') ?? '-' ?>

							</td>

						</tr>

						<tr>

							<td>Jam</td>

							<td class="text-right">

								<?php if ($schedule): ?>

									<?= substr($schedule->start_time, 0, 5) ?>

									-

									<?= substr($schedule->end_time, 0, 5) ?>

								<?php else: ?>

									-

								<?php endif; ?>

							</td>

						</tr>

						<tr>

							<td>Lokasi</td>

							<td class="text-right">

								<?= e($training->location ?: '-') ?>

							</td>

						</tr>

						</tbody>

					</table>

					<hr>

					<?php if ($registration->score): ?>

						<div class="alert alert-light border mb-3">

							<div class="small text-muted">

								Nilai Akhir

							</div>

							<h3 class="font-weight-bold mb-0 text-primary">

								<?= $registration->score->final_score ?>

							</h3>

						</div>

					<?php endif; ?>

					<?php if ($registration->certificate): ?>

						<a
							href="<?= url('/peserta/certificates/show?id=' . $registration->certificate->id) ?>"
							class="btn btn-success btn-lg btn-block">

							<i class="fas fa-certificate mr-2"></i>

							Lihat Sertifikat

						</a>

					<?php endif; ?>

					<a
						href="<?= url('/peserta/trainings') ?>"
						class="btn btn-outline-secondary btn-block <?= $registration->certificate ? 'mt-2' : '' ?>">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

</div>
