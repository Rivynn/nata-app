<div class="container-fluid">

	<?php if ($message = flash('error')): ?>

		<div class="alert alert-danger alert-dismissible fade show shadow-sm">

			<i class="fas fa-times-circle mr-2"></i>

			<?= $message ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

	<form
		method="POST"
		action="<?= url('/admin/trainers/store') ?>">

		<input
			type="hidden"
			name="role"
			value="trainer">

		<input
			type="hidden"
			name="status"
			value="active">

		<div class="row">

			<div class="col-lg-8">

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<div class="d-flex justify-content-between align-items-center">

							<div>

								<h4 class="font-weight-bold text-primary mb-1">

									Tambah Pelatih

								</h4>

								<p class="text-muted mb-0">

									Buat akun pelatih baru untuk mengelola kegiatan pelatihan.

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

					<div class="card-body">

						<h5 class="font-weight-bold text-primary mb-4">

							<i class="fas fa-user-circle mr-2"></i>

							Informasi Akun

						</h5>

						<div class="form-group">

							<label>

								Nama Lengkap

								<span class="text-danger">*</span>

							</label>

							<input
								type="text"
								name="name"
								id="name"
								class="form-control"
								placeholder="Masukkan nama lengkap"
								required>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Username

									<span class="text-danger">*</span>

								</label>

								<input
									type="text"
									name="username"
									id="username"
									class="form-control"
									placeholder="Username"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Email

									<span class="text-danger">*</span>

								</label>

								<input
									type="email"
									name="email"
									id="email"
									class="form-control"
									placeholder="Email aktif"
									required>

							</div>

						</div>

						<hr class="my-4">

						<h5 class="font-weight-bold text-primary mb-4">

							<i class="fas fa-chalkboard-teacher mr-2"></i>

							Informasi Pelatih

						</h5>
						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Nomor Induk Pelatih

								</label>

								<input
									type="text"
									name="employee_number"
									id="employee_number"
									class="form-control"
									placeholder="Contoh: TRN-0001">

								<small class="text-muted">

									Opsional, digunakan sebagai identitas internal.

								</small>

							</div>

							<div class="form-group col-md-6">

								<label>

									Bidang Pelatihan

									<span class="text-danger">*</span>

								</label>

								<select
									name="training_field_id"
									id="training_field_id"
									class="form-control"
									required>

									<option value="">

										-- Pilih Bidang Pelatihan --

									</option>

									<?php foreach ($fields as $field): ?>

										<option value="<?= $field->id ?>">

											<?= e($field->name) ?>

										</option>

									<?php endforeach; ?>

								</select>

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Nomor Telepon

								</label>

								<input
									type="text"
									name="phone"
									id="phone"
									class="form-control"
									placeholder="08xxxxxxxxxx">

							</div>

							<div class="form-group col-md-6">

								<label>

									Instansi

								</label>

								<input
									type="text"
									name="institution"
									id="institution"
									class="form-control"
									placeholder="Contoh: PT ABC Indonesia">

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Keahlian

								</label>

								<input
									type="text"
									name="expertise"
									id="expertise"
									class="form-control"
									placeholder="Contoh: Web Development">

							</div>

							<div class="form-group col-md-6">

								<label>

									Spesialisasi

								</label>

								<input
									type="text"
									name="specialization"
									id="specialization"
									class="form-control"
									placeholder="Contoh: Laravel, Networking">

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Pengalaman

								</label>

								<div class="input-group">

									<input
										type="number"
										name="experience_year"
										id="experience_year"
										class="form-control"
										min="0"
										max="60"
										value="0">

									<div class="input-group-append">

										<span class="input-group-text">

											Tahun

										</span>

									</div>

								</div>

							</div>

							<div class="form-group col-md-6">

								<label>

									Avatar

								</label>

								<input
									type="text"
									name="avatar"
									id="avatar"
									class="form-control"
									placeholder="URL Avatar (Opsional)">

							</div>

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
								placeholder="Tuliskan biografi singkat mengenai pelatih..."></textarea>

						</div>

						<hr class="my-4">

						<h5 class="font-weight-bold text-primary mb-4">

							<i class="fas fa-lock mr-2"></i>

							Keamanan Akun

						</h5>
						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Password

									<span class="text-danger">*</span>

								</label>

								<div class="input-group">

									<input
										type="password"
										name="password"
										id="password"
										class="form-control"
										required>

									<div class="input-group-append">

										<button
											type="button"
											class="btn btn-outline-secondary"
											onclick="togglePassword('password')">

											<i class="fas fa-eye"></i>

										</button>

									</div>

								</div>

							</div>

							<div class="form-group col-md-6">

								<label>

									Konfirmasi Password

									<span class="text-danger">*</span>

								</label>

								<div class="input-group">

									<input
										type="password"
										name="password_confirmation"
										id="password_confirmation"
										class="form-control"
										required>

									<div class="input-group-append">

										<button
											type="button"
											class="btn btn-outline-secondary"
											onclick="togglePassword('password_confirmation')">

											<i class="fas fa-eye"></i>

										</button>

									</div>

								</div>

							</div>

						</div>

						<div class="mb-4">

							<div class="progress">

								<div
									id="passwordStrength"
									class="progress-bar"
									role="progressbar"
									style="width:0%">

								</div>

							</div>

							<small
								id="passwordStrengthText"
								class="text-muted">

								Minimal 8 karakter.

							</small>

						</div>

					</div>

					<div class="card-footer bg-white">

						<div class="d-flex justify-content-between align-items-center">

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

									Simpan Pelatih

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

							Preview Pelatih

						</h5>

					</div>

					<div class="card-body text-center">

						<div
							id="avatarPreview"
							class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mx-auto shadow"
							style="width:90px;height:90px;font-size:34px;font-weight:700;">

							?

						</div>

						<h5
							id="previewName"
							class="font-weight-bold mt-3 mb-1">

							Nama Pelatih

						</h5>

						<p
							id="previewUsername"
							class="text-muted mb-3">

							@username

						</p>

						<span
							id="previewField"
							class="badge badge-primary px-3 py-2">

							Bidang Pelatihan

						</span>

						<hr>

						<div class="text-left">

							<div class="mb-3">

								<label class="text-muted small d-block mb-1">

									Instansi

								</label>

								<div id="previewInstitution">

									-

								</div>

							</div>

							<div class="mb-3">

								<label class="text-muted small d-block mb-1">

									Keahlian

								</label>

								<div id="previewExpertise">

									-

								</div>

							</div>

							<div class="mb-3">

								<label class="text-muted small d-block mb-1">

									Spesialisasi

								</label>

								<div id="previewSpecialization">

									-

								</div>

							</div>

							<div>

								<label class="text-muted small d-block mb-1">

									Pengalaman

								</label>

								<div id="previewExperience">

									0 Tahun

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0">

					<div class="card-header bg-white">

						<h6 class="font-weight-bold text-primary mb-0">

							Informasi Sistem

						</h6>

					</div>

					<div class="card-body">

						<div class="d-flex justify-content-between mb-3">

							<span class="text-muted">

								Role

							</span>

							<span class="badge badge-primary">

								TRAINER

							</span>

						</div>

						<div class="d-flex justify-content-between mb-4">

							<span class="text-muted">

								Status

							</span>

							<span class="badge badge-success">

								ACTIVE

							</span>

						</div>

						<button
							type="button"
							id="generatePassword"
							class="btn btn-outline-primary btn-block">

							<i class="fas fa-key mr-2"></i>

							Generate Password

						</button>

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
		const username = $('username');
		const institution = $('institution');
		const expertise = $('expertise');
		const specialization = $('specialization');
		const experience = $('experience_year');
		const trainingField = $('training_field_id');

		const password = $('password');
		const passwordConfirmation = $('password_confirmation');

		/*
		|--------------------------------------------------------------------------
		| Live Preview
		|--------------------------------------------------------------------------
		*/

		function initials(value)
		{
			value = value.trim();

			if (!value) {
				return '?';
			}

			const words = value.split(/\s+/);

			if (words.length === 1) {
				return words[0].substring(0, 2).toUpperCase();
			}

			return (
				words[0][0] +
				words[words.length - 1][0]
			).toUpperCase();
		}

		function updatePreview()
		{
			$('previewName').textContent =
				name.value || 'Nama Pelatih';

			$('previewUsername').textContent =
				username.value
					? '@' + username.value
					: '@username';

			$('previewInstitution').textContent =
				institution.value || '-';

			$('previewExpertise').textContent =
				expertise.value || '-';

			$('previewSpecialization').textContent =
				specialization.value || '-';

			$('previewExperience').textContent =
				experience.value
					? experience.value + ' Tahun'
					: '0 Tahun';

			const option =
				trainingField.options[
					trainingField.selectedIndex
					];

			$('previewField').textContent =
				option && option.value
					? option.text
					: 'Bidang Pelatihan';

			$('avatarPreview').textContent =
				initials(name.value);
		}

		[
			name,
			username,
			institution,
			expertise,
			specialization,
			experience
		].forEach(element => {

			element.addEventListener(
				'input',
				updatePreview
			);

		});

		trainingField.addEventListener(
			'change',
			updatePreview
		);

		updatePreview();

		/*
		|--------------------------------------------------------------------------
		| Toggle Password
		|--------------------------------------------------------------------------
		*/

		window.togglePassword = function(id)
		{
			const input = $(id);

			input.type =
				input.type === 'password'
					? 'text'
					: 'password';
		};

		/*
		|--------------------------------------------------------------------------
		| Generate Password
		|--------------------------------------------------------------------------
		*/

		$('generatePassword').addEventListener(
			'click',
			() => {

				const chars =
					'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789@#$%';

				let generated = '';

				for (let i = 0; i < 12; i++) {

					generated += chars.charAt(
						Math.floor(
							Math.random() * chars.length
						)
					);

				}

				password.value = generated;
				passwordConfirmation.value = generated;

				checkPasswordStrength();

			}
		);

		/*
		|--------------------------------------------------------------------------
		| Password Strength
		|--------------------------------------------------------------------------
		*/

		function checkPasswordStrength()
		{
			const value = password.value;

			const bar = $('passwordStrength');

			const text = $('passwordStrengthText');

			let score = 0;

			if (value.length >= 8) score++;
			if (/[A-Z]/.test(value)) score++;
			if (/[a-z]/.test(value)) score++;
			if (/[0-9]/.test(value)) score++;
			if (/[^A-Za-z0-9]/.test(value)) score++;

			const width = score * 20;

			bar.style.width = width + '%';

			bar.className = 'progress-bar';

			switch (score) {

				case 0:
				case 1:
					bar.classList.add('bg-danger');
					text.innerHTML =
						'Password sangat lemah';
					break;

				case 2:
					bar.classList.add('bg-warning');
					text.innerHTML =
						'Password lemah';
					break;

				case 3:
					bar.classList.add('bg-info');
					text.innerHTML =
						'Password cukup';
					break;

				case 4:
					bar.classList.add('bg-primary');
					text.innerHTML =
						'Password kuat';
					break;

				case 5:
					bar.classList.add('bg-success');
					text.innerHTML =
						'Password sangat kuat';
					break;

			}
		}

		password.addEventListener(
			'input',
			checkPasswordStrength
		);

	});
</script>
