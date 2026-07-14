<div class="container-fluid">

	<div class="card shadow border-0 mb-4">

		<div class="card-header bg-white py-3">

			<div class="d-flex justify-content-between align-items-center">

				<div>

					<h4 class="font-weight-bold text-primary mb-1">

						Data Peserta

					</h4>

					<p class="text-muted mb-0">

						Daftar seluruh peserta yang telah disetujui mengikuti pelatihan.

					</p>

				</div>

				<div>

                    <span class="badge badge-primary p-2">

                        <?= count($participants) ?> Peserta

                    </span>

				</div>

			</div>

		</div>

		<div class="card-body">

			<?php if (empty($participants)): ?>

				<div class="text-center py-5">

					<i class="fas fa-users fa-5x text-gray-300 mb-3"></i>

					<h5 class="font-weight-bold">

						Belum Ada Peserta

					</h5>

					<p class="text-muted">

						Belum terdapat peserta yang telah disetujui.

					</p>

				</div>

			<?php else: ?>

				<div class="table-responsive">

					<table
						id="participantsTable"
						class="table table-hover align-middle">

						<thead class="thead-light">

						<tr>

							<th width="70">

								#

							</th>

							<th>

								Peserta

							</th>

							<th>

								Kontak

							</th>

							<th>

								Pelatihan

							</th>

							<th width="250">

								Verifikasi

							</th>

							<th width="120">

								Status

							</th>

							<th width="100">

								Aksi

							</th>

						</tr>

						</thead>

						<tbody>

						<?php foreach($participants as $index => $participant): ?>

							<tr>

								<td>

									<?= $index + 1 ?>

								</td>

								<td>

									<div class="d-flex align-items-center">

										<?php if(!empty($participant['avatar'])): ?>

											<img
												src="<?= avatar($participant) ?>"
												class="rounded-circle shadow mr-3"
												width="52"
												height="52"
												style="object-fit:cover;">

										<?php else: ?>

											<div
												class="avatar-circle mr-3">

												<?= initials($participant['name']) ?>

											</div>

										<?php endif; ?>

										<div>

											<div class="font-weight-bold">

												<?= $participant['name'] ?>

											</div>

											<small class="text-muted">

												ID #<?= $participant['user_id'] ?>

											</small>

										</div>

									</div>

								</td>

								<td>

									<div>

										<i class="fas fa-envelope text-primary mr-2"></i>

										<?= $participant['email'] ?>

									</div>

									<small class="text-muted">

										<i class="fas fa-phone mr-2"></i>

										<?= $participant['phone'] ?>

									</small>

								</td>

								<td>

									<strong>

										<?= $participant['training_name'] ?>

									</strong>

									<br>

									<span class="badge badge-light">

                                        <?= $participant['field_name'] ?>

                                    </span>

								</td>

								<td>

                                    <span class="badge badge-success">

                                        <i class="fas fa-user-check mr-1"></i>

                                        <?= $participant['approved_by_name'] ?? '-' ?>

                                    </span>

									<br>

									<small class="text-muted mt-2 d-inline-block">

										<i class="far fa-calendar-alt mr-1"></i>

										<?= $participant['approved_at']
											? date(
												'd M Y H:i',
												strtotime($participant['approved_at'])
											)
											: '-' ?>

									</small>

								</td>

								<td>

                                    <span class="badge badge-success px-3 py-2">

                                        <i class="fas fa-check-circle mr-1"></i>

                                        Approved

                                    </span>

								</td>

								<td>

									<div class="btn-group shadow-sm">

										<a
											href="<?= url('/pegawai/participants/show?id='.$participant['id']) ?>"
											class="btn btn-outline-primary btn-sm"
											data-toggle="tooltip"
											title="Detail">

											<i class="fas fa-eye"></i>

										</a>

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

