<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/training-fields/store') ?>">

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-primary mb-1">

							Tambah Jenis Pelatihan

						</h4>

						<p class="text-muted mb-0">

							Tambahkan kategori atau bidang pelatihan baru ke dalam sistem.

						</p>

					</div>

					<a
						href="<?= url('/admin/training-fields') ?>"
						class="btn btn-secondary">

						<i class="fas fa-arrow-left mr-2"></i>

						Kembali

					</a>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="col-lg-4">

				<div class="card shadow mb-4">

					<div class="card-body text-center">

						<div
							id="iconPreview"
							class="rounded-circle bg-light shadow mx-auto mb-4 d-flex align-items-center justify-content-center"
							style="width:120px;height:120px;">

							<i
								id="previewIcon"
								class="fas fa-layer-group text-primary"
								style="font-size:45px;"></i>

						</div>

						<h5
							id="previewName"
							class="font-weight-bold">

							Jenis Pelatihan

						</h5>

						<p
							id="previewDescription"
							class="text-muted mb-3">

							Deskripsi bidang pelatihan.

						</p>

						<span
							id="previewBadge"
							class="badge badge-primary px-3 py-2">

							Primary

						</span>

					</div>

				</div>

			</div>

			<div class="col-lg-8">

				<div class="card shadow">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi Bidang

						</h6>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Nama Bidang

							</label>

							<input
								type="text"
								name="name"
								id="name"
								class="form-control"
								placeholder="Contoh: Komputer"
								required>

						</div>

						<div class="form-group">

							<label>

								Deskripsi

							</label>

							<textarea
								name="description"
								id="description"
								rows="4"
								class="form-control"
								placeholder="Deskripsi singkat bidang pelatihan..."
								required></textarea>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Icon

								</label>

								<select
									name="icon"
									id="icon"
									class="form-control"
									required>

									<?php foreach (config('icons') as $icon): ?>

										<option
											value="<?= $icon['class'] ?>"
											<?= $icon['class'] === 'fas fa-layer-group' ? 'selected' : '' ?>>

											<?= $icon['name'] ?>

										</option>

									<?php endforeach; ?>

								</select>

								<small class="text-muted">

									Pilih icon yang mewakili jenis pelatihan.

								</small>

							</div>

							<div class="form-group col-md-6">

								<label>

									Warna

								</label>

								<select
									name="color"
									id="color"
									class="form-control">

									<option value="primary">

										Primary

									</option>

									<option value="success">

										Success

									</option>

									<option value="danger">

										Danger

									</option>

									<option value="warning">

										Warning

									</option>

									<option value="info">

										Info

									</option>

									<option value="secondary">

										Secondary

									</option>

									<option value="dark">

										Dark

									</option>

								</select>

							</div>

						</div>

						<div class="form-group">

							<label>

								Status

							</label>

							<select
								name="is_active"
								class="form-control">

								<option value="1">

									Aktif

								</option>

								<option value="0">

									Nonaktif

								</option>

							</select>

						</div>

					</div>

					<div class="card-footer bg-white d-flex justify-content-between">

						<a
							href="<?= url('/admin/training-fields') ?>"
							class="btn btn-light">

							<i class="fas fa-times mr-2"></i>

							Batal

						</a>

						<button
							type="submit"
							class="btn btn-primary">

							<i class="fas fa-save mr-2"></i>

							Simpan Jenis

						</button>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>
