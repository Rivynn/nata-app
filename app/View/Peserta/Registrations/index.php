<div class="container-fluid">

	<!-- Header -->

	<div class="card border-0 shadow mb-4">

		<div class="card-body">

			<div class="row align-items-center">

				<div class="col-md-8">

					<h3 class="font-weight-bold text-primary mb-2">

						Daftar Pelatihan

					</h3>

					<p class="text-muted mb-0">

						Pilih pelatihan yang sesuai dengan minat dan kemampuan Anda.
						Pastikan membaca informasi pelatihan sebelum melakukan pendaftaran.

					</p>

				</div>

				<div class="col-md-4 text-md-right mt-3 mt-md-0">

                    <span class="badge badge-success px-3 py-2">

                        <?= count($trainings) ?>

                        Pelatihan Tersedia

                    </span>

				</div>

			</div>

		</div>

	</div>

	<?php if (!empty($trainings)): ?>

		<div class="row">

			<?php foreach ($trainings as $training): ?>

				<div class="col-xl-4 col-lg-6 mb-4">

					<div class="card shadow border-0 h-100">

						<div class="card-body d-flex flex-column">

							<div class="d-flex justify-content-between align-items-center mb-3">

                                <span class="badge badge-primary">

                                    <?= $training['field_name'] ?>

                                </span>

								<span class="badge badge-success">

                                    Dibuka

                                </span>

							</div>

							<h5 class="font-weight-bold">

								<?= $training['name'] ?>

							</h5>

							<p class="text-muted small mb-3">

								<?= $training['description'] ?>

							</p>

							<div class="mb-3">

								<small class="text-muted">

									Kuota

								</small>

								<div class="progress mt-1" style="height:8px;">

									<div
										class="progress-bar bg-primary"
										style="width:100%">

									</div>

								</div>

								<small class="text-primary font-weight-bold">

									<?= $training['quota'] ?>

									Peserta

								</small>

							</div>

							<table class="table table-sm table-borderless mb-3">

								<tr>

									<td width="35">

										<i class="fas fa-clock text-warning"></i>

									</td>

									<td>

										<?= $training['duration'] ?>

										Hari

									</td>

								</tr>

								<tr>

									<td>

										<i class="fas fa-map-marker-alt text-danger"></i>

									</td>

									<td>

										<?= $training['location'] ?>

									</td>

								</tr>

								<tr>

									<td>

										<i class="fas fa-calendar text-info"></i>

									</td>

									<td>

										<?= date('d M Y', strtotime($training['registration_open'])) ?>

										-

										<?= date('d M Y', strtotime($training['registration_close'])) ?>

									</td>

								</tr>

							</table>

							<div class="mt-auto">

								<a
									href="<?= url('/peserta/registrations/create?id=' . $training['id']) ?>"
									class="btn btn-primary btn-block">

									<i class="fas fa-paper-plane mr-2"></i>

									Daftar Sekarang

								</a>

							</div>

						</div>

					</div>

				</div>

			<?php endforeach; ?>

		</div>

	<?php else: ?>

		<div class="card shadow border-0">

			<div class="card-body text-center py-5">

				<i class="fas fa-book-open fa-4x text-gray-300 mb-3"></i>

				<h4 class="font-weight-bold">

					Belum Ada Pelatihan

				</h4>

				<p class="text-muted">

					Saat ini belum ada pelatihan yang tersedia.
					Silakan kembali beberapa waktu lagi.

				</p>

			</div>

		</div>

	<?php endif; ?>

</div>