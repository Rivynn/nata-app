<div class="container-fluid">

	<?php if ($message = flash('success')): ?>

		<div class="alert alert-success alert-dismissible fade show shadow-sm">

			<i class="fas fa-check-circle mr-2"></i>

			<?= $message ?>

			<button
				type="button"
				class="close"
				data-dismiss="alert">

				<span>&times;</span>

			</button>

		</div>

	<?php endif; ?>

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
		action="<?= url('/admin/employees/update') ?>">

		<input
			type="hidden"
			name="id"
			value="<?= $employee->id ?>">

		<!-- Hero -->

		<div class="card shadow border-0 mb-4">

			<div class="card-body">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<span class="badge badge-warning px-3 py-2 mb-3">

							Master Data

						</span>

						<h3 class="font-weight-bold text-gray-800 mb-2">

							Edit Pegawai

						</h3>

						<p class="text-muted mb-0">

							Perbarui informasi akun dan data kepegawaian pegawai.

						</p>

					</div>

					<div>

						<a
							href="<?= url('/admin/employees') ?>"
							class="btn btn-light border">

							<i class="fas fa-arrow-left mr-2"></i>

							Kembali

						</a>

					</div>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="col-lg-8">

				<!-- Informasi Akun -->

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Informasi Akun

						</h5>

					</div>

					<div class="card-body">

						<div class="form-group">

							<label>

								Nama Lengkap

							</label>

							<input
								type="text"
								name="name"
								id="name"
								class="form-control"
								value="<?= e($employee->user->name) ?>"
								required>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Username

								</label>

								<input
									type="text"
									name="username"
									class="form-control"
									value="<?= e($employee->user->username) ?>"
									required>

							</div>

							<div class="form-group col-md-6">

								<label>

									Email

								</label>

								<input
									type="email"
									name="email"
									class="form-control"
									value="<?= e($employee->user->email) ?>"
									required>

							</div>

						</div>

					</div>

				</div>
				<!-- Data Kepegawaian -->

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Data Kepegawaian

						</h5>

					</div>

					<div class="card-body">

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Nomor Induk Pegawai (NIP)

								</label>

								<input
									type="text"
									name="employee_number"
									class="form-control"
									value="<?= e($employee->employee_number) ?>"
									placeholder="Masukkan Nomor Induk Pegawai">

							</div>

							<div class="form-group col-md-6">

								<label>

									Nomor Telepon

								</label>

								<input
									type="text"
									name="phone"
									class="form-control"
									value="<?= e($employee->phone) ?>"
									placeholder="08xxxxxxxxxx">

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Departemen

								</label>

								<input
									type="text"
									name="department"
									class="form-control"
									value="<?= e($employee->department) ?>"
									placeholder="Contoh : Sekretariat">

							</div>

							<div class="form-group col-md-6">

								<label>

									Jabatan

								</label>

								<input
									type="text"
									name="position"
									class="form-control"
									value="<?= e($employee->position) ?>"
									placeholder="Contoh : Administrator">

							</div>

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Dibuat Pada

								</label>

								<input
									type="text"
									class="form-control"
									value="<?= $employee->created_at?->format('d M Y H:i') ?>"
									readonly>

							</div>

							<div class="form-group col-md-6">

								<label>

									Terakhir Diubah

								</label>

								<input
									type="text"
									class="form-control"
									value="<?= $employee->updated_at?->format('d M Y H:i') ?>"
									readonly>

							</div>

						</div>

					</div>

				</div>
				<!-- Keamanan Akun -->

				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Keamanan Akun

						</h5>

					</div>

					<div class="card-body">

						<div class="alert alert-light border mb-4">

							<i class="fas fa-info-circle text-primary mr-2"></i>

							Kosongkan password apabila tidak ingin mengubah password akun.

						</div>

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Password Baru

								</label>

								<div class="input-group">

									<input
										type="password"
										name="password"
										id="password"
										class="form-control"
										placeholder="Kosongkan jika tidak diubah">

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

									Konfirmasi Password Baru

								</label>

								<div class="input-group">

									<input
										type="password"
										name="password_confirmation"
										id="password_confirmation"
										class="form-control"
										placeholder="Ulangi password">

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

						<div class="mb-3">

							<label>

								Kekuatan Password

							</label>

							<div
								class="progress"
								style="height:8px;">

								<div
									id="passwordStrength"
									class="progress-bar"
									style="width:0%">

								</div>

							</div>

							<small
								id="passwordStrengthText"
								class="text-muted">

								Password tidak diubah.

							</small>

						</div>

						<div class="text-right">

							<button
								type="button"
								id="generatePassword"
								class="btn btn-outline-primary">

								<i class="fas fa-random mr-2"></i>

								Generate Password Baru

							</button>

						</div>

					</div>

				</div>

			</div>
			<div class="col-lg-4">

				<!-- Profile -->

				<div class="card shadow mb-4">

					<div class="card-body text-center">

						<div
							id="avatarPreview"
							class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto mb-3"
							style="width:90px;height:90px;font-size:30px;font-weight:bold;">

							<?= e($employee->user->getInitials()) ?>

						</div>

						<h5
							id="previewName"
							class="font-weight-bold mb-1">

							<?= e($employee->user->name) ?>

						</h5>

						<p
							id="previewUsername"
							class="text-muted mb-3">

							@<?= e($employee->user->username) ?>

						</p>

						<hr>

						<div class="text-left">

							<div class="form-group">

								<label>

									Role

								</label>

								<input
									type="text"
									class="form-control"
									value="Pegawai"
									readonly>

							</div>

							<div class="form-group">

								<label>

									Status Akun

								</label>

								<select
									name="status"
									class="form-control">

									<option
										value="active"
										<?= $employee->user->status === 'active' ? 'selected' : '' ?>>

										Aktif

									</option>

									<option
										value="inactive"
										<?= $employee->user->status === 'inactive' ? 'selected' : '' ?>>

										Nonaktif

									</option>

									<option
										value="banned"
										<?= $employee->user->status === 'banned' ? 'selected' : '' ?>>

										Diblokir

									</option>

								</select>

							</div>

							<div class="form-group">

								<label>

									Terakhir Login

								</label>

								<input
									type="text"
									class="form-control"
									value="<?= $employee->user->last_login_at ? $employee->user->last_login_at->format('d M Y H:i') : '-' ?>"
									readonly>

							</div>

						</div>

						<button
							type="submit"
							class="btn btn-warning btn-block">

							<i class="fas fa-save mr-2"></i>

							Simpan Perubahan

						</button>

						<a
							href="<?= url('/admin/employees/show?id=' . $employee->id) ?>"
							class="btn btn-light btn-block">

							Batal

						</a>

					</div>

				</div>

				<!-- Informasi -->

				<div class="card border-left-info shadow">

					<div class="card-body">

						<h6 class="font-weight-bold text-info">

							Informasi

						</h6>

						<ul class="small pl-3 mb-0">

							<li>Username harus tetap unik.</li>

							<li>Email tidak boleh sama.</li>

							<li>Password hanya diubah jika diisi.</li>

							<li>Status akun dapat diubah kapan saja.</li>

							<li>NIP mengikuti data instansi.</li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</form>

</div>
<script>

	function togglePassword(id)
	{
		const input = document.getElementById(id);

		input.type = input.type === 'password'
			? 'text'
			: 'password';
	}

	/*
	|--------------------------------------------------------------------------
	| Live Preview
	|--------------------------------------------------------------------------
	*/

	const nameInput = document.getElementById('name');

	if (nameInput) {

		nameInput.addEventListener('input', function () {

			const value = this.value.trim();

			document.getElementById('previewName').innerText = value || 'Nama Pegawai';

			const words = value.split(' ').filter(Boolean);

			let initials = '?';

			if (words.length === 1) {

				initials = words[0].substring(0, 2);

			} else if (words.length > 1) {

				initials = words[0][0] + words[words.length - 1][0];

			}

			document.getElementById('avatarPreview').innerText = initials.toUpperCase();

		});

	}

	const usernameInput = document.querySelector('[name=username]');

	if (usernameInput) {

		usernameInput.addEventListener('input', function () {

			document.getElementById('previewUsername').innerText =
				this.value
					? '@' + this.value
					: '@username';

		});

	}

	/*
	|--------------------------------------------------------------------------
	| Generate Password
	|--------------------------------------------------------------------------
	*/

	const generatePasswordButton = document.getElementById('generatePassword');

	if (generatePasswordButton) {

		generatePasswordButton.addEventListener('click', function () {

			const chars =
				'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';

			let password = '';

			for (let i = 0; i < 12; i++) {

				password += chars.charAt(
					Math.floor(Math.random() * chars.length)
				);

			}

			document.getElementById('password').value = password;

			document.getElementById('password_confirmation').value = password;

			checkStrength();

		});

	}

	/*
	|--------------------------------------------------------------------------
	| Password Strength
	|--------------------------------------------------------------------------
	*/

	const passwordInput = document.getElementById('password');

	if (passwordInput) {

		passwordInput.addEventListener('keyup', checkStrength);

		passwordInput.addEventListener('input', checkStrength);

	}

	function checkStrength()
	{
		const password = document.getElementById('password').value;

		const bar = document.getElementById('passwordStrength');

		const text = document.getElementById('passwordStrengthText');

		if (password.length === 0) {

			bar.style.width = '0%';

			bar.className = 'progress-bar';

			text.innerHTML = 'Password tidak diubah.';

			return;

		}

		let score = 0;

		if (password.length >= 8) score++;

		if (/[A-Z]/.test(password)) score++;

		if (/[a-z]/.test(password)) score++;

		if (/[0-9]/.test(password)) score++;

		if (/[^A-Za-z0-9]/.test(password)) score++;

		bar.style.width = (score * 20) + '%';

		if (score <= 2) {

			bar.className = 'progress-bar bg-danger';

			text.innerHTML = 'Lemah';

		}
		else if (score <= 4) {

			bar.className = 'progress-bar bg-warning';

			text.innerHTML = 'Sedang';

		}
		else {

			bar.className = 'progress-bar bg-success';

			text.innerHTML = 'Kuat';

		}

	}

	checkStrength();

</script>
