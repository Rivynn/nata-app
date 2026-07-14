<div class="container-fluid">

	<div class="row justify-content-center">

		<div class="col-lg-10">

			<div class="card shadow mb-4">

				<div class="card-header bg-white py-3">

					<div class="d-flex justify-content-between align-items-center">

						<div>

							<h4 class="font-weight-bold text-primary mb-1">

								Edit Pelatih

							</h4>

							<p class="text-muted mb-0">

								Perbarui informasi pelatih yang terdaftar pada sistem.

							</p>

						</div>

						<a
							href="<?= url('/admin/trainers') ?>"
							class="btn btn-outline-secondary">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali

						</a>

					</div>

				</div>

				<form
					method="POST"
					action="<?= url('/admin/trainers/update') ?>">

					<input
						type="hidden"
						name="id"
						value="<?= $trainer['id'] ?>">

					<div class="card-body">

						<div class="row">

							<div class="col-md-8">

								<div class="form-group">

									<label>

										Nama Pelatih

									</label>

									<input
										type="text"
										name="name"
										id="name"
										class="form-control"
										value="<?= $trainer['name'] ?>"
										required>

								</div>

								<div class="form-row">

									<div class="form-group col-md-6">

										<label>

											Email

										</label>

										<input
											type="email"
											name="email"
											class="form-control"
											value="<?= $trainer['email'] ?>">

									</div>

									<div class="form-group col-md-6">

										<label>

											No. Telepon

										</label>

										<input
											type="text"
											name="phone"
											class="form-control"
											value="<?= $trainer['phone'] ?>">

									</div>

								</div>

								<div class="form-group">

									<label>

										Instansi

									</label>

									<input
										type="text"
										name="institution"
										id="institution"
										class="form-control"
										value="<?= $trainer['institution'] ?>">

								</div>

								<div class="form-group">

									<label>

										Keahlian

									</label>

									<input
										type="text"
										name="expertise"
										id="expertise"
										class="form-control"
										value="<?= $trainer['expertise'] ?>">

								</div>

								<div class="form-group">

									<label>

										Bidang Pelatihan

									</label>

									<select
										name="training_field_id"
										id="training_field_id"
										class="form-control"
										required>

										<?php foreach($fields as $field): ?>

											<option
												value="<?= $field['id'] ?>"
												<?= $trainer['training_field_id'] == $field['id'] ? 'selected' : '' ?>>

												<?= $field['name'] ?>

											</option>

										<?php endforeach; ?>

									</select>

								</div>
								<div class="form-group">

									<label>

										Sertifikat / Kualifikasi

									</label>

									<input
										type="text"
										name="certificate"
										id="certificate"
										class="form-control"
										value="<?= $trainer['certificate'] ?>"
										placeholder="Contoh: BNSP, Cisco, Microsoft, dll">

								</div>

								<div class="form-group">

									<label>

										Biografi

									</label>

									<textarea
										name="biography"
										id="biography"
										rows="5"
										class="form-control"
										placeholder="Deskripsi singkat mengenai pelatih..."><?= $trainer['biography'] ?></textarea>

								</div>

							</div>

							<div class="col-md-4">

								<div class="card border-left-primary shadow-sm">

									<div class="card-header bg-white">

										<h6 class="font-weight-bold text-primary mb-0">

											Preview Pelatih

										</h6>

									</div>

									<div class="card-body text-center">

										<div
											class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow"
											style="width:90px;height:90px;font-size:32px;">

											<i
												id="previewIcon"
												class="fas fa-chalkboard-teacher"></i>

										</div>

										<h5
											id="previewName"
											class="font-weight-bold mt-3 mb-1">

											<?= $trainer['name'] ?>

										</h5>

										<p
											id="previewExpertise"
											class="text-muted mb-2">

											<?= $trainer['expertise'] ?: 'Keahlian' ?>

										</p>

										<span
											id="previewField"
											class="badge badge-primary px-3 py-2">

											<?= $trainer['field_name'] ?>

										</span>

										<hr>

										<div class="text-left">

											<p class="mb-2">

												<i class="fas fa-building text-primary mr-2"></i>

												<span id="previewInstitution">

													<?= $trainer['institution'] ?: 'Instansi' ?>

												</span>

											</p>

											<p class="mb-2">

												<i class="fas fa-certificate text-warning mr-2"></i>

												<span id="previewCertificate">

													<?= $trainer['certificate'] ?: 'Sertifikat' ?>

												</span>

											</p>

											<p class="mb-0">

												<span
													id="previewStatus"
													class="badge badge-<?= $trainer['status'] === 'active' ? 'success' : 'danger' ?> px-3 py-2">

													<?= $trainer['status'] === 'active'
														? 'Aktif'
														: 'Nonaktif' ?>

												</span>

											</p>

										</div>

									</div>

								</div>

								<div class="form-group mt-4">

									<label>

										Status

									</label>

									<select
										name="status"
										id="status"
										class="form-control">

										<option
											value="active"
											<?= $trainer['status'] === 'active'
												? 'selected'
												: '' ?>>

											Aktif

										</option>

										<option
											value="inactive"
											<?= $trainer['status'] === 'inactive'
												? 'selected'
												: '' ?>>

											Nonaktif

										</option>

									</select>

								</div>

							</div>

						</div>

					</div>
					<div class="card-footer bg-white">

						<div class="d-flex justify-content-between">

							<a
								href="<?= url('/admin/trainers') ?>"
								class="btn btn-outline-secondary">

								<i class="fas fa-arrow-left mr-2"></i>

								Kembali

							</a>

							<div>

								<button
									type="reset"
									class="btn btn-outline-warning mr-2">

									<i class="fas fa-undo mr-2"></i>

									Reset

								</button>

								<button
									type="submit"
									class="btn btn-primary">

									<i class="fas fa-save mr-2"></i>

									Update Pelatih

								</button>

							</div>

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>