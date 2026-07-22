<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/training-fields/update/' . $field->id) ?>">

		<div class="row">

			<div class="col-lg-8">

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<div class="d-flex align-items-center">

							<div
								class="rounded-circle bg-<?= e($field->getColor()) ?> text-white d-flex align-items-center justify-content-center mr-3"
								style="width:55px;height:55px;">

								<i class="<?= e($field->getIcon()) ?> fa-lg"></i>

							</div>

							<div>

								<h4 class="font-weight-bold text-primary mb-1">

									Edit Jenis Pelatihan

								</h4>

								<p class="text-muted mb-0">

									Perbarui informasi jenis pelatihan yang sudah terdaftar.

								</p>

							</div>

						</div>

					</div>

					<div class="card-body">

						<h5 class="font-weight-bold text-primary mb-4">

							<i class="fas fa-info-circle mr-2"></i>

							Informasi Dasar

						</h5>

						<div class="form-group">

							<label class="font-weight-bold">

								Nama Jenis Pelatihan
								<span class="text-danger">*</span>

							</label>

							<input
								type="text"
								name="name"
								id="name"
								class="form-control"
								value="<?= e($field->name) ?>"
								required>

						</div>

						<div class="form-group">

							<label class="font-weight-bold">

								Slug

							</label>

							<input
								type="text"
								name="slug"
								id="slug"
								class="form-control"
								value="<?= e($field->slug) ?>">

							<small class="text-muted">

								Kosongkan apabila ingin dibuat ulang otomatis.

							</small>

						</div>

						<div class="form-group">

							<label class="font-weight-bold">

								Deskripsi

							</label>

							<textarea
								name="description"
								id="description"
								rows="5"
								class="form-control"><?= e($field->description) ?></textarea>

						</div>

						<hr class="my-4">

						<h5 class="font-weight-bold text-primary mb-4">

							<i class="fas fa-palette mr-2"></i>

							Tampilan

						</h5>
						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label class="font-weight-bold">

										Icon

									</label>

									<select
										name="icon"
										id="icon"
										class="form-control">

										<?php foreach (config('icons') as $icon): ?>

											<option
												value="<?= e($icon['class']) ?>"
												<?= $field->icon === $icon['class'] ? 'selected' : '' ?>>

												<?= e($icon['name']) ?>

											</option>

										<?php endforeach; ?>

									</select>

									<small class="text-muted">

										Pilih icon yang akan ditampilkan pada jenis pelatihan.

									</small>

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">

									<label class="font-weight-bold">

										Warna

									</label>

									<select
										name="color"
										id="color"
										class="form-control">

										<?php

											$colors = [
												'primary',
												'secondary',
												'success',
												'danger',
												'warning',
												'info',
												'dark',
											];

										?>

										<?php foreach ($colors as $color): ?>

											<option
												value="<?= $color ?>"
												<?= $field->color === $color ? 'selected' : '' ?>>

												<?= ucfirst($color) ?>

											</option>

										<?php endforeach; ?>

									</select>

								</div>

							</div>

						</div>

						<div class="form-group">

							<label class="font-weight-bold">

								Status

							</label>

							<div class="custom-control custom-switch">

								<input
									type="checkbox"
									class="custom-control-input"
									id="is_active"
									name="is_active"
									value="1"
									<?= $field->isActive() ? 'checked' : '' ?>>

								<label
									class="custom-control-label"
									for="is_active">

									Aktif

								</label>

							</div>

							<small class="text-muted">

								Jenis pelatihan yang nonaktif tidak dapat dipilih saat membuat pelatihan baru.

							</small>

						</div>

						<hr class="my-4">

						<div class="d-flex justify-content-between">

							<a
								href="<?= url('/admin/training-fields') ?>"
								class="btn btn-light border">

								<i class="fas fa-arrow-left mr-2"></i>

								Kembali

							</a>

							<div>

								<button
									type="reset"
									class="btn btn-outline-secondary mr-2">

									<i class="fas fa-undo mr-2"></i>

									Reset

								</button>

								<button
									type="submit"
									class="btn btn-primary">

									<i class="fas fa-save mr-2"></i>

									Simpan Perubahan

								</button>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="col-lg-4">

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Preview

						</h5>

					</div>

					<div class="card-body text-center">

						<div
							class="rounded-circle bg-light shadow d-flex align-items-center justify-content-center mx-auto"
							style="width:90px;height:90px;">

							<i
								id="iconPreview"
								class="<?= e($field->getIcon()) ?> text-<?= e($field->getColor()) ?>"
								style="font-size:36px;"></i>

						</div>

						<h5
							id="namePreview"
							class="font-weight-bold mt-4 mb-2">

							<?= e($field->name) ?>

						</h5>

						<span
							id="colorPreview"
							class="badge badge-<?= e($field->getColor()) ?> px-3 py-2">

							<?= strtoupper(e($field->getColor())) ?>

						</span>

						<hr>

						<p
							id="descriptionPreview"
							class="text-muted mb-0">

							<?= e($field->getDescription()) ?>

						</p>

					</div>

				</div>
				<div class="card shadow border-0">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Informasi Sistem

						</h5>

					</div>

					<div class="card-body">

						<div class="mb-3">

							<label class="text-muted small d-block">

								Status

							</label>

							<span
								id="statusPreview"
								class="badge badge-<?= $field->isActive() ? 'success' : 'danger' ?> px-3 py-2">

								<?= $field->isActive() ? 'AKTIF' : 'NONAKTIF' ?>

							</span>

						</div>

						<div class="mb-3">

							<label class="text-muted small d-block">

								Slug

							</label>

							<code id="slugPreview">

								<?= e($field->slug ?: '-') ?>

							</code>

						</div>

						<hr>

						<div class="mb-3">

							<label class="text-muted small d-block">

								ID

							</label>

							<strong>

								#<?= e($field->id) ?>

							</strong>

						</div>

						<div class="mb-3">

							<label class="text-muted small d-block">

								Dibuat Pada

							</label>

							<p class="mb-0">

								<?= e($field->created_at) ?>

							</p>

						</div>

						<div class="mb-3">

							<label class="text-muted small d-block">

								Terakhir Diperbarui

							</label>

							<p class="mb-0">

								<?= e($field->updated_at) ?>

							</p>

						</div>

						<hr>

						<h6 class="font-weight-bold">

							Panduan

						</h6>

						<ul class="small text-muted pl-3 mb-0">

							<li>

								Perubahan akan langsung mempengaruhi data pelatihan yang menggunakan jenis ini.

							</li>

							<li>

								Slug sebaiknya tidak sering diubah apabila sudah digunakan oleh sistem.

							</li>

							<li>

								Icon dan warna akan ditampilkan pada halaman daftar serta detail pelatihan.

							</li>

							<li>

								Status nonaktif akan menyembunyikan pilihan ini dari form pembuatan data baru.

							</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>
<script>

	document.addEventListener('DOMContentLoaded', () => {

		const $ = id => document.getElementById(id);

		const name = $('name');
		const slug = $('slug');
		const description = $('description');
		const icon = $('icon');
		const color = $('color');
		const status = $('is_active');

		const initial = {
			name: name.value,
			slug: slug.value,
			description: description.value,
			icon: icon.value,
			color: color.value,
			status: status.checked,
		};

		function slugify(text)
		{
			return text
				.toLowerCase()
				.trim()
				.replace(/[^\w\s-]/g, '')
				.replace(/\s+/g, '-')
				.replace(/-+/g, '-');
		}

		function updatePreview()
		{
			const currentName =
				name.value.trim() || 'Jenis Pelatihan';

			const currentDescription =
				description.value.trim() || 'Belum ada deskripsi.';

			const currentSlug =
				slug.value.trim() || slugify(name.value);

			const currentColor =
				color.value;

			const currentIcon =
				icon.value || 'fas fa-layer-group';

			$('namePreview').textContent =
				currentName;

			$('descriptionPreview').textContent =
				currentDescription;

			$('slugPreview').textContent =
				currentSlug || '-';

			$('iconPreview').className =
				currentIcon + ' text-' + currentColor;

			const badge =
				$('colorPreview');

			badge.className =
				'badge badge-' + currentColor + ' px-3 py-2';

			badge.textContent =
				currentColor.toUpperCase();

			const statusBadge =
				$('statusPreview');

			if (status.checked) {

				statusBadge.className =
					'badge badge-success px-3 py-2';

				statusBadge.innerHTML =
					'<i class="fas fa-check-circle mr-1"></i> AKTIF';

			} else {

				statusBadge.className =
					'badge badge-danger px-3 py-2';

				statusBadge.innerHTML =
					'<i class="fas fa-ban mr-1"></i> NONAKTIF';

			}
		}

		name.addEventListener('input', () => {

			if (!slug.dataset.manual) {

				slug.value = slugify(name.value);

			}

			updatePreview();

		});

		slug.addEventListener('input', () => {

			slug.dataset.manual = '1';

			updatePreview();

		});

		description.addEventListener(
			'input',
			updatePreview
		);

		icon.addEventListener(
			'change',
			updatePreview
		);

		color.addEventListener(
			'change',
			updatePreview
		);

		status.addEventListener(
			'change',
			updatePreview
		);

		document.querySelector('form').addEventListener(
			'reset',
			() => {

				setTimeout(() => {

					name.value = initial.name;
					slug.value = initial.slug;
					description.value = initial.description;
					icon.value = initial.icon;
					color.value = initial.color;
					status.checked = initial.status;

					delete slug.dataset.manual;

					updatePreview();

				}, 0);

			}
		);

		updatePreview();

	});

</script>
