<div class="container-fluid">

	<!-- Header -->

	<div class="card shadow border-0 mb-4 bg-gradient-primary text-white">

		<div class="card-body py-4">

			<div class="row align-items-center">

				<div class="col">

					<h2 class="font-weight-bold mb-2">

						Sertifikat Saya

					</h2>

					<p class="mb-0 text-white-50">

						Seluruh sertifikat pelatihan yang telah Anda peroleh.

					</p>

				</div>

				<div class="col-auto">

					<i class="fas fa-award fa-4x text-white-50"></i>

				</div>

			</div>

		</div>

	</div>

	<?php if(empty($certificates)): ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-certificate fa-5x text-gray-300 mb-4"></i>

				<h4 class="font-weight-bold">

					Belum Ada Sertifikat

				</h4>

				<p class="text-muted">

					Sertifikat akan muncul setelah Anda menyelesaikan pelatihan dan dinyatakan lulus.

				</p>

				<a
					href="<?= url('/peserta/registrations') ?>"
					class="btn btn-primary">

					<i class="fas fa-plus mr-2"></i>

					Daftar Pelatihan

				</a>

			</div>

		</div>

	<?php else: ?>

		<div class="row">

			<?php foreach($certificates as $certificate): ?>

				<div class="col-lg-6 mb-4">

					<div class="card shadow h-100 border-left-success">

						<div class="card-body">

							<div class="d-flex justify-content-between align-items-center mb-3">

								<div>

                                    <span class="badge badge-success">

                                        VALID

                                    </span>

								</div>

								<i class="fas fa-award fa-3x text-warning"></i>

							</div>

							<h4 class="font-weight-bold">

								<?= $certificate['training_name'] ?>

							</h4>

							<p class="text-muted mb-4">

								<?= $certificate['field_name'] ?>

							</p>

							<table class="table table-borderless table-sm">

								<tr>

									<th width="170">

										Nomor Sertifikat

									</th>

									<td>

										<?= $certificate['certificate_number'] ?>

									</td>

								</tr>

								<tr>

									<th>

										Tanggal Terbit

									</th>

									<td>

										<?= date(
											'd F Y',
											strtotime($certificate['issued_at'])
										) ?>

									</td>

								</tr>

								<tr>

									<th>

										Kode Verifikasi

									</th>

									<td>

										<code>

											<?= $certificate['verification_code'] ?>

										</code>

									</td>

								</tr>

							</table>

						</div>

						<div class="card-footer bg-white">

							<div class="row">

								<div class="col">
                                    <a
                                            href="<?= url('/peserta/certificates/show?id='.$certificate['id']) ?>"
                                            class="btn btn-success btn-block">

                                        <i class="fas fa-eye mr-2"></i>

                                        Lihat Sertifikat

                                    </a>


								</div>

							</div>

						</div>

					</div>

				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</div>