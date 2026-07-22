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
		action="<?= url('/admin/employees/store') ?>">

		<!-- Hero -->

		<div class="card shadow border-0 mb-4">

			<div class="card-body">

				<div class="d-flex justify-content-between align-items-center">

					<div>

						<span class="badge badge-primary px-3 py-2 mb-3">

							Master Data

						</span>

						<h3 class="font-weight-bold text-gray-800 mb-2">

							Tambah Pegawai

						</h3>

						<p class="text-muted mb-0">

							Buat akun pegawai baru beserta informasi kepegawaiannya.
							Data ini dapat diubah kembali setelah pegawai dibuat.

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

			<!-- Main -->

			<div class="col-lg-8">
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
								placeholder="Masukkan nama lengkap..."
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
									placeholder="Username"
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
									placeholder="Email"
									required>

							</div>

						</div>

					</div>

				</div>
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
									placeholder="Contoh : Analis">

							</div>

						</div>

					</div>

				</div>
				<div class="card shadow mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							Keamanan Akun

						</h5>

					</div>

					<div class="card-body">

						<div class="form-row">

							<div class="form-group col-md-6">

								<label>

									Password

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

						<div class="mb-3">

							<label>

								Kekuatan Password

							</label>

							<div class="progress" style="height:8px;">

								<div
									id="passwordStrength"
									class="progress-bar"
									style="width:0%"></div>

							</div>

							<small
								id="passwordStrengthText"
								class="text-muted">

								Belum diisi

							</small>

						</div>

						<div class="text-right">
							<button
								type="button"
								class="btn btn-outline-primary"
								id="generatePassword">

								<i class="fas fa-random mr-2"></i>

								Generate Password

							</button>

						</div>

					</div>

				</div>
			</div>
				<div class="col-lg-4">

					<div class="card shadow mb-4">

						<div class="card-body text-center">

							<div
								id="avatarPreview"
								class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
								style="width:90px;height:90px;font-size:30px;font-weight:bold;">

								?

							</div>

							<h5 id="previewName">

								Nama Pegawai

							</h5>

							<p
								id="previewUsername"
								class="text-muted">

								@username

							</p>

							<hr>

							<div class="text-left">

								<div class="mb-3">

									<label>

										Role

									</label>

									<input
										class="form-control"
										value="Pegawai"
										readonly>

									<input
										type="hidden"
										name="role"
										value="pegawai">

								</div>

								<div class="mb-3">

									<label>

										Status Akun

									</label>

									<input
										class="form-control"
										value="Aktif"
										readonly>

									<input
										type="hidden"
										name="status"
										value="active">

								</div>

							</div>

							<button
								type="submit"
								class="btn btn-primary btn-block">

								<i class="fas fa-save mr-2"></i>

								Simpan Pegawai

							</button>

							<a
								href="<?= url('/admin/employees') ?>"
								class="btn btn-light btn-block">

								Batal

							</a>

						</div>

					</div>

					<div class="card border-left-info shadow">

						<div class="card-body">

							<h6 class="font-weight-bold text-info">

								Informasi

							</h6>

							<ul class="small pl-3 mb-0">

								<li>Username harus unik.</li>

								<li>Email harus unik.</li>

								<li>Password minimal 8 karakter.</li>

								<li>NIP mengikuti data instansi.</li>

							</ul>

						</div>

					</div>


				</div>

			</div>

	</form>

</div>
<script>

	function togglePassword(id){

		const input=document.getElementById(id);

		input.type=input.type==='password'
			?'text'
			:'password';

	}

	document.getElementById('name').addEventListener('input',function(){

		const value=this.value.trim();

		document.getElementById('previewName').innerText=value||'Nama Pegawai';

		const words=value.split(' ');

		let initials='?';

		if(words.length===1){

			initials=words[0].substring(0,2);

		}else if(words.length>1){

			initials=words[0][0]+words[words.length-1][0];

		}

		document.getElementById('avatarPreview').innerText=initials.toUpperCase();

	});

	document.querySelector('[name=username]').addEventListener('input',function(){

		document.getElementById('previewUsername').innerText='@'+this.value;

	});


	const generatePasswordButton = document.getElementById('generatePassword');

	if (generatePasswordButton) {

		generatePasswordButton.addEventListener('click', function () {

			const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';

			let password = '';

			for (let i = 0; i < 12; i++) {

				password += chars.charAt(Math.floor(Math.random() * chars.length));

			}

			document.getElementById('password').value = password;
			document.getElementById('password_confirmation').value = password;

			checkStrength();

		});

	}

	document.getElementById('password').addEventListener('keyup',checkStrength);

	function checkStrength(){

		const password=document.getElementById('password').value;

		const bar=document.getElementById('passwordStrength');
		const text=document.getElementById('passwordStrengthText');

		let score=0;

		if(password.length>=8) score++;
		if(/[A-Z]/.test(password)) score++;
		if(/[a-z]/.test(password)) score++;
		if(/[0-9]/.test(password)) score++;
		if(/[^A-Za-z0-9]/.test(password)) score++;

		const width=score*20;

		bar.style.width=width+'%';

		if(score<=2){

			bar.className='progress-bar bg-danger';
			text.innerHTML='Lemah';

		}else if(score<=4){

			bar.className='progress-bar bg-warning';
			text.innerHTML='Sedang';

		}else{

			bar.className='progress-bar bg-success';
			text.innerHTML='Kuat';

		}

	}

</script>
