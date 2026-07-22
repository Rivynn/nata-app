<div class="container-fluid">

	<div class="row justify-content-center">

		<div class="col-lg-8">

			<div class="card shadow">

				<div class="card-header py-3">

					<h6 class="m-0 font-weight-bold text-primary">

						Ubah Profil

					</h6>

				</div>

				<div class="card-body">

					<?php if ($message = flash('success')): ?>

						<div class="alert alert-success">
							<?= $message ?>
						</div>

					<?php endif; ?>

					<?php if ($message = flash('error')): ?>

						<div class="alert alert-danger">
							<?= $message ?>
						</div>

					<?php endif; ?>



					<form
						method="POST"
						action="<?= url('/profile/edit') ?>"
                        enctype="multipart/form-data">
                        <div class="text-center mb-4">

                            <div
                                    id="avatarPreview"
                                    class="mx-auto mb-3"
                                    style="width:140px;height:140px;">

								<?php if (!empty($user->avatar)): ?>

									<img
										src="<?= asset('assets/uploads/avatars/' . $user->avatar) ?>"
										id="avatarImage"
										class="rounded-circle shadow"
										style="width:140px;height:140px;object-fit:cover;"
										alt="Avatar">

								<?php else: ?>

									<div
										id="avatarInitial"
										class="avatar-circle-lg mx-auto">

										<?= initials($user->name) ?>

									</div>

								<?php endif; ?>

                            </div>

                            <div class="mb-3">

                                <input
                                        type="file"
                                        name="avatar"
                                        id="avatar"
                                        class="d-none"
                                        accept=".jpg,.jpeg,.png,.webp,image/*">

                                <button
                                        type="button"
                                        class="btn btn-outline-primary btn-sm"
                                        onclick="document.getElementById('avatar').click();">

                                    <i class="fas fa-camera mr-2"></i>

                                    Pilih Foto

                                </button>

                                <small class="d-block text-muted mt-2">

                                    JPG, PNG atau WEBP (Maks. 2 MB)

                                </small>

                            </div>

                            <h4 class="font-weight-bold mb-1">

								<?= e($user->name) ?>

                            </h4>

                            <span class="badge badge-primary">

    <?= ucfirst($user->role) ?>
    </span>

                        </div>
						<div class="form-group">

							<label>Nama Lengkap</label>

							<div class="input-group">

								<div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-user"></i>

                                    </span>

								</div>

								<input
									type="text"
									name="name"
									class="form-control"
									value="<?= e($user->name) ?>"
									required>

							</div>

						</div>

						<div class="form-group">

							<label>Username</label>

							<div class="input-group">

								<div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-at"></i>

                                    </span>

								</div>

								<input
									type="text"
									class="form-control"
									value="<?= e($user->username) ?>"
									readonly>

							</div>

							<small class="text-muted">

								Username tidak dapat diubah.

							</small>

						</div>

						<div class="form-group">

							<label>Email</label>

							<div class="input-group">

								<div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-envelope"></i>

                                    </span>

								</div>

								<input
									type="email"
									name="email"
									class="form-control"
									value="<?= e($user->email) ?>"
									required>

							</div>

						</div>

						<div class="form-group">

							<label>Nomor Telepon</label>

							<div class="input-group">

								<div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-phone"></i>

                                    </span>

								</div>

								<input
									type="text"
									name="phone"
									class="form-control"
									value="<?= e($participant?->phone ?? '') ?>">

							</div>

						</div>

						<div class="form-group">

							<label>Role</label>

							<div class="input-group">

								<div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-user-shield"></i>

                                    </span>

								</div>

								<input
									type="text"
									class="form-control"
									value="<?= ucfirst($user->role) ?>"
									readonly>

							</div>

						</div>

						<hr>

						<div class="d-flex justify-content-between">

							<a
								href="<?= url('/profile') ?>"
								class="btn btn-secondary">

								<i class="fas fa-arrow-left mr-2"></i>

								Kembali

							</a>

							<button
								type="submit"
								class="btn btn-primary">

								<i class="fas fa-save mr-2"></i>

								Simpan Perubahan

							</button>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>

<script>

    document
        .getElementById('avatar')
        .addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                let image = document.getElementById('avatarImage');

                if (!image) {

                    const initial = document.getElementById('avatarInitial');

                    if (initial) {

                        initial.remove();

                    }

                    image = document.createElement('img');

                    image.id = 'avatarImage';

                    image.className = 'rounded-circle shadow';

                    image.style.width = '140px';
                    image.style.height = '140px';
                    image.style.objectFit = 'cover';

                    document
                        .getElementById('avatarPreview')
                        .appendChild(image);

                }

                image.src = event.target.result;

            };

            reader.readAsDataURL(file);

        });

</script>
