<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4">

		<div class="card-body">

			<div class="d-flex justify-content-between align-items-start flex-wrap">

				<div>

                    <span class="badge badge-<?= $training['color'] ?> mb-3">

                        <i class="<?= $training['icon'] ?> mr-1"></i>

                        <?= $training['field_name'] ?>

                    </span>

					<h2 class="font-weight-bold mb-2">

						<?= htmlspecialchars($training['name']) ?>

					</h2>

					<p class="text-muted mb-0">

						<?= htmlspecialchars($training['description']) ?>

					</p>

				</div>

				<div class="text-right mt-3 mt-lg-0">

                    <span class="badge badge-success px-3 py-2">

                        Pendaftaran Dibuka

                    </span>

				</div>

			</div>

		</div>

	</div>

	<div class="row">

		<!-- LEFT -->

		<div class="col-lg-8">

			<!-- Informasi -->

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

							<th width="220">Bidang</th>

							<td><?= $training['field_name'] ?></td>

						</tr>

						<tr>

							<th>Durasi</th>

							<td><?= $training['duration'] ?> Hari</td>

						</tr>

						<tr>

							<th>Lokasi</th>

							<td><?= $training['location'] ?></td>

						</tr>

						<tr>

							<th>Kuota</th>

							<td><?= $training['quota'] ?> Peserta</td>

						</tr>

						<tr>

							<th>Pendaftaran</th>

							<td>

								<?= date('d M Y', strtotime($training['registration_open'])) ?>

								-

								<?= date('d M Y', strtotime($training['registration_close'])) ?>

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

						Pelatih

					</h5>

				</div>

				<div class="card-body">

					<div class="media">
						<?php if (!empty($training['trainer_avatar'])): ?>

							<img
								src="<?= asset('uploads/trainers/' . $training['trainer_avatar']) ?>"
								class="rounded-circle mr-4"
								width="90"
								height="90"
								style="object-fit: cover;">

						<?php else: ?>

							<div
								class="avatar-circle mr-4"
								style="
            width:90px;
            height:90px;
            font-size:32px;
        ">

								<?= initials($training['trainer_name']) ?>

							</div>

						<?php endif; ?>

						<div class="media-body">

							<h5 class="font-weight-bold mb-1">

								<?= $training['trainer_name'] ?>

							</h5>

							<div class="text-muted mb-2">

								<?= $training['institution'] ?>

							</div>

							<span class="badge badge-info">

                                <?= $training['expertise'] ?>

                            </span>

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

					<ul class="mb-0">

						<li>Materi teori sesuai bidang pelatihan.</li>

						<li>Praktik langsung bersama instruktur.</li>

						<li>Pengerjaan studi kasus.</li>

						<li>Evaluasi akhir pelatihan.</li>

						<li>Sertifikat bagi peserta yang lulus.</li>

					</ul>

				</div>

			</div>

			<!-- Persyaratan -->

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-clipboard-check mr-2"></i>

						Persyaratan

					</h5>

				</div>

				<div class="card-body">

					<ul class="mb-0">

						<li>Profil peserta telah lengkap.</li>

						<li>Mengunggah KTP.</li>

						<li>Mengunggah Pas Foto.</li>

						<li>Mengunggah Ijazah terakhir.</li>

						<li>Mengikuti seluruh jadwal pelatihan.</li>

					</ul>

				</div>

			</div>

		</div>

		<!-- RIGHT -->

		<div class="col-lg-4">

			<div class="card shadow sticky-top" style="top:20px;">

				<div class="card-header bg-primary text-white">

					<h5 class="mb-0">

						Ringkasan

					</h5>

				</div>

				<div class="card-body">

					<table class="table table-sm table-borderless">

						<tr>

							<td>Batch</td>

							<td class="text-right">

								<?= $training['batch_name'] ?: '-' ?>

							</td>

						</tr>

						<tr>

							<td>Ruang</td>

							<td class="text-right">

								<?= $training['room'] ?: '-' ?>

							</td>

						</tr>

						<tr>

							<td>Mulai</td>

							<td class="text-right">

								<?= $training['start_date']
									? date('d M Y', strtotime($training['start_date']))
									: '-' ?>

							</td>

						</tr>

						<tr>

							<td>Selesai</td>

							<td class="text-right">

								<?= $training['end_date']
									? date('d M Y', strtotime($training['end_date']))
									: '-' ?>

							</td>

						</tr>

					</table>

					<hr>

					<?php if(!$profileCompleted): ?>

						<a
							href="<?= url('/peserta/profile') ?>"
							class="btn btn-warning btn-lg btn-block">

							<i class="fas fa-user-edit mr-2"></i>

							Lengkapi Biodata

						</a>

					<?php elseif($alreadyRegistered): ?>

						<button
							class="btn btn-success btn-lg btn-block"
							disabled>

							<i class="fas fa-check-circle mr-2"></i>

							Sudah Terdaftar

						</button>

					<?php else: ?>

						<a
							href="<?= url('/peserta/registrations/create?id=' . $training['id']) ?>"
							class="btn btn-primary btn-lg btn-block">

							<i class="fas fa-paper-plane mr-2"></i>

							Daftar Sekarang

						</a>

					<?php endif; ?>

					<a
						href="<?= url('/peserta/registrations') ?>"
						class="btn btn-light btn-block mt-2">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

	</div>

</div>
