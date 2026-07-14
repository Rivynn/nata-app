<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/training-fields/update') ?>">

		<input
			type="hidden"
			name="id"
			value="<?= $field['id'] ?>">

		<div class="card shadow border-0 mb-4">

			<div class="card-header bg-white py-3">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<h4 class="font-weight-bold text-warning mb-1">

							Edit Jenis Pelatihan

						</h4>

						<p class="text-muted mb-0">

							Perbarui informasi bidang pelatihan.

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

				<div class="card shadow">

					<div class="card-body text-center">

						<div
							class="rounded-circle bg-light shadow mx-auto mb-4 d-flex align-items-center justify-content-center"
							style="width:120px;height:120px;">

							<i
								id="previewIcon"
								class="<?= $field['icon'] ?> text-<?= $field['color'] ?>"
								style="font-size:48px;"></i>

						</div>

						<h4
							id="previewName"
							class="font-weight-bold">

							<?= $field['name'] ?>

						</h4>

						<p
							id="previewDescription"
							class="text-muted mb-3">

							<?= $field['description'] ?>

						</p>

						<span
							id="previewBadge"
							class="badge badge-<?= $field['color'] ?> px-3 py-2">

							<?= ucfirst($field['color']) ?>

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
								id="name"
								name="name"
								class="form-control"
								value="<?= $field['name'] ?>"
								required>

						</div>

						<div class="form-group">

							<label>

								Deskripsi

							</label>

							<textarea
								id="description"
								name="description"
								rows="4"
								class="form-control"
								required><?= $field['description'] ?></textarea>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Icon

								</label>

								<select
									name="icon"
									id="icon"
									class="form-control">

									<?php foreach (config('icons') as $icon): ?>

										<option
											value="<?= $icon['class'] ?>"
											<?= $icon['class'] === 'fas fa-layer-group' ? 'selected' : '' ?>>

											<?= $icon['name'] ?>

										</option>

									<?php endforeach; ?>
								</select>

							</div>

							<div class="form-group col-md-6">

								<label>

									Warna

								</label>

								<select
									id="color"
									name="color"
									class="form-control">

									<?php

										$colors = [

											'primary',

											'success',

											'danger',

											'warning',

											'info',

											'secondary',

											'dark'

										];

									?>

									<?php foreach($colors as $color): ?>

										<option
											value="<?= $color ?>"
											<?= $field['color'] == $color ? 'selected' : '' ?>>

											<?= ucfirst($color) ?>

										</option>

									<?php endforeach; ?>

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

								<option
									value="1"
									<?= $field['is_active'] ? 'selected' : '' ?>>

									Aktif

								</option>

								<option
									value="0"
									<?= !$field['is_active'] ? 'selected' : '' ?>>

									Nonaktif

								</option>

							</select>

						</div>

					</div>

					<div class="card-footer bg-white d-flex justify-content-between">

						<a
							href="<?= url('/admin/training-fields/show?id='.$field['id']) ?>"
							class="btn btn-light">

							<i class="fas fa-times mr-2"></i>

							Batal

						</a>

						<button
							type="submit"
							class="btn btn-warning">

							<i class="fas fa-save mr-2"></i>

							Simpan Perubahan

						</button>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>

