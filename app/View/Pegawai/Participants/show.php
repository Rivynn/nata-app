<div class="container-fluid">

	<div class="d-flex justify-content-between align-items-center mb-4">

		<div>

			<h3 class="font-weight-bold text-primary mb-1">

				Detail Peserta

			</h3>

			<p class="text-muted mb-0">

				Informasi lengkap peserta pelatihan.

			</p>

		</div>

		<a
			href="<?= url('/pegawai/participants') ?>"
			class="btn btn-secondary">

			<i class="fas fa-arrow-left mr-2"></i>

			Kembali

		</a>

	</div>

	<div class="row">

		<!-- Profil -->

		<div class="col-lg-4">

			<div class="card shadow mb-4">

				<div class="card-body text-center">

					<?php if(has_avatar($participant)): ?>

						<img
							src="<?= avatar($participant) ?>"
							class="rounded-circle shadow mb-3"
							width="150"
							height="150"
							style="object-fit:cover;">

					<?php else: ?>

						<div class="avatar-circle-lg mx-auto mb-3">

							<?= initials($participant['name']) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold">

						<?= $participant['name'] ?>

					</h4>

					<p class="text-muted">

						<?= $participant['email'] ?>

					</p>

					<span class="badge badge-success">

                        Peserta Aktif

                    </span>

				</div>

			</div>

		</div>

		<!-- Informasi -->

		<div class="col-lg-8">

			<div class="card shadow mb-4">

				<div class="card-header bg-white">

					<h6 class="m-0 font-weight-bold text-primary">

						Informasi Peserta

					</h6>

				</div>

				<div class="card-body">

					<table class="table table-borderless">

						<tr>

							<th width="220">

								Nama Lengkap

							</th>

							<td>

								<?= $participant['name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Email

							</th>

							<td>

								<?= $participant['email'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Nomor Telepon

							</th>

							<td>

								<?= $participant['phone'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Pelatihan

							</th>

							<td>

								<?= $participant['training_name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Bidang

							</th>

							<td>

								<?= $participant['field_name'] ?>

							</td>

						</tr>

						<tr>

							<th>

								Status

							</th>

							<td>

                                <span class="badge badge-success">

                                    Disetujui

                                </span>

							</td>

						</tr>

						<tr>

							<th>

								Tanggal Pendaftaran

							</th>

							<td>

								<?= date('d F Y', strtotime($participant['created_at'])) ?>

							</td>

						</tr>

					</table>

				</div>

			</div>

			<?php if(!empty($participant['motivation'])): ?>

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h6 class="m-0 font-weight-bold text-primary">

							Motivasi Peserta

						</h6>

					</div>

					<div class="card-body">

						<?= nl2br($participant['motivation']) ?>

					</div>

				</div>

			<?php endif; ?>

			<div class="card shadow">

				<div class="card-header bg-white">

					<h6 class="m-0 font-weight-bold text-primary">

						Aksi

					</h6>

				</div>

				<div class="card-body">


					<div class="btn-group">
                        <?php if ($participant['certificate_id']): ?>

                            <a
                                    href="<?= url('/pegawai/certificates/show?id='.$participant['certificate_id']) ?>"
                                    class="btn btn-primary">

                                <i class="fas fa-eye mr-2"></i>

                                Lihat Sertifikat

                            </a>

                        <?php else: ?>

                            <a
                                    href="<?= url('/pegawai/certificates/create?id='.$participant['registration_id']) ?>"
                                    class="btn btn-success">

                                <i class="fas fa-award mr-2"></i>

                                Terbitkan Sertifikat

                            </a>

                        <?php endif; ?>

						<a
							href="<?= url('/pegawai/participants') ?>"
							class="btn btn-secondary">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali

						</a>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>