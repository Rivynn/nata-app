<div class="container-fluid">

	<form
		method="POST"
		action="<?= url('/admin/training-fields/store') ?>">

		<div class="row">

			<div class="col-lg-8">

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white py-3">

						<div class="d-flex align-items-center">

							<div
								class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
								style="width:55px;height:55px;">

								<i class="fas fa-layer-group fa-lg"></i>

							</div>

							<div>

								<h4 class="font-weight-bold text-primary mb-1">

									Tambah Jenis Pelatihan

								</h4>

								<p class="text-muted mb-0">

									Tambahkan kategori atau bidang pelatihan baru ke dalam sistem.

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
								placeholder="Contoh : Web Development"
								required>

							<small class="text-muted">

								Nama kategori pelatihan.

							</small>

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
								placeholder="web-development">

							<small class="text-muted">

								Akan dibuat otomatis dari nama apabila dikosongkan.

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
								class="form-control"
								placeholder="Masukkan deskripsi jenis pelatihan..."></textarea>

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
												<?= $icon['class'] === 'fas fa-layer-group' ? 'selected' : '' ?>>

												<?= e($icon['name']) ?>

											</option>

										<?php endforeach; ?>

									</select>

									<small class="text-muted">

										Pilih icon yang akan digunakan untuk jenis pelatihan.

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

										<option value="primary">Primary</option>
										<option value="success">Success</option>
										<option value="info">Info</option>
										<option value="warning">Warning</option>
										<option value="danger">Danger</option>
										<option value="secondary">Secondary</option>
										<option value="dark">Dark</option>

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
									checked>

								<label
									class="custom-control-label"
									for="is_active">

									Aktif

								</label>

							</div>

							<small class="text-muted">

								Jenis pelatihan yang aktif dapat digunakan pada data pelatih dan pelatihan.

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

									<i class="fas fa-redo mr-2"></i>

									Reset

								</button>

								<button
									type="submit"
									class="btn btn-primary">

									<i class="fas fa-save mr-2"></i>

									Simpan Jenis Pelatihan

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
							id="iconPreviewWrapper"
							class="rounded-circle bg-light shadow d-flex align-items-center justify-content-center mx-auto"
							style="width:90px;height:90px;">

							<i
								id="iconPreview"
								class="fas fa-layer-group text-primary"
								style="font-size:36px;"></i>

						</div>

						<h5
							id="namePreview"
							class="font-weight-bold mt-4 mb-2">

							Jenis Pelatihan

						</h5>

						<span
							id="colorPreview"
							class="badge badge-primary px-3 py-2">

							PRIMARY

						</span>

						<hr>

						<p
							id="descriptionPreview"
							class="text-muted mb-0">

							Belum ada deskripsi.

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
								class="badge badge-success px-3 py-2">

								AKTIF

							</span>

						</div>

						<div class="mb-3">

							<label class="text-muted small d-block">

								Slug

							</label>

							<code id="slugPreview">

								-

							</code>

						</div>

						<hr>

						<h6 class="font-weight-bold">

							Panduan

						</h6>

						<ul class="small text-muted pl-3 mb-0">

							<li>

								Nama jenis pelatihan harus unik.

							</li>

							<li>

								Slug akan digunakan sebagai identifier sistem.

							</li>

							<li>

								Icon menggunakan class Font Awesome.

							</li>

							<li>

								Warna digunakan pada badge dan tampilan kategori.

							</li>

							<li>

								Jenis pelatihan yang nonaktif tidak dapat dipilih saat membuat data pelatih maupun pelatihan.

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
				icon.value.trim() || 'fas fa-layer-group';

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
					'<i class="fas fa-check-circle mr-1"></i>AKTIF';

			} else {

				statusBadge.className =
					'badge badge-danger px-3 py-2';

				statusBadge.innerHTML =
					'<i class="fas fa-ban mr-1"></i>NONAKTIF';

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
			'input',
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

					delete slug.dataset.manual;

					updatePreview();

				}, 50);

			}
		);

		slug.value = slugify(name.value);

		updatePreview();

	});

</script>
