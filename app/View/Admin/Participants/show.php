<div class="container-fluid">

	<div class="d-sm-flex align-items-center justify-content-between mb-4">

		<div>

			<h1 class="h3 mb-1 text-gray-800">

				Detail Peserta

			</h1>

			<p class="mb-0 text-muted">

				Informasi lengkap mengenai data peserta pelatihan.

			</p>

		</div>

		<div>

			<a
				href="<?= url('/admin/participants') ?>"
				class="btn btn-secondary shadow-sm">

				<i class="fas fa-arrow-left mr-1"></i>

				Kembali

			</a>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-4 mb-4">

			<div class="card shadow border-0">

				<div class="card-body text-center">

					<?php if ($participant->user->hasAvatar()): ?>

						<img
							src="<?= avatar($participant->user) ?>"
							class="rounded-circle shadow mb-3"
							width="130"
							height="130"
							style="object-fit:cover;">

					<?php else: ?>

						<div
							class="avatar-circle mx-auto mb-3">

							<?= e($participant->user->getInitials()) ?>

						</div>

					<?php endif; ?>

					<h4 class="font-weight-bold mb-1">

						<?= e($participant->user->getDisplayName()) ?>

					</h4>

					<p class="text-muted mb-3">

						Peserta Pelatihan

					</p>

					<?php if ($participant->isProfileCompleted()): ?>

						<span class="badge badge-success px-3 py-2">

							<i class="fas fa-check-circle mr-1"></i>

							Profile Lengkap

						</span>

					<?php else: ?>

						<span class="badge badge-warning px-3 py-2">

							<i class="fas fa-exclamation-circle mr-1"></i>

							Profile Belum Lengkap

						</span>

					<?php endif; ?>

					<hr>

					<div class="text-left">

						<div class="mb-3">

							<small class="text-muted d-block">

								Email

							</small>

							<div class="font-weight-bold">

								<?= e($participant->user->email) ?>

							</div>

						</div>

						<div class="mb-3">

							<small class="text-muted d-block">

								Nomor HP

							</small>

							<div class="font-weight-bold">

								<?= e($participant->phone ?: '-') ?>

							</div>

						</div>

						<div class="mb-3">

							<small class="text-muted d-block">

								Institusi

							</small>

							<div class="font-weight-bold">

								<?= e($participant->institution ?: '-') ?>

							</div>

						</div>

						<div class="mb-3">

							<small class="text-muted d-block">

								Terdaftar

							</small>

							<div class="font-weight-bold">

								<?= $participant->created_at->format('d F Y') ?>

							</div>

						</div>

						<div>

							<small class="text-muted d-block">

								ID Peserta

							</small>

							<div class="font-weight-bold">

								#<?= $participant->id ?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-8">

			<div class="card shadow border-0 mb-4">

				<div class="card-header bg-white">

					<h5 class="font-weight-bold text-primary mb-0">

						<i class="fas fa-user mr-2"></i>

						Informasi Pribadi

					</h5>

				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-4">

							<label class="text-muted">

								Nama Lengkap

							</label>

							<div class="font-weight-bold">

								<?= e($participant->user->getDisplayName()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted">

								NIK

							</label>

							<div class="font-weight-bold">

								<?= e(optional($participant->profile)->nik ?: '-') ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted">

								Jenis Kelamin

							</label>

							<div class="font-weight-bold">

								<?= e($participant->getGenderLabel()) ?>

							</div>

						</div>

						<div class="col-md-6 mb-4">

							<label class="text-muted">

								Tanggal Lahir

							</label>

							<div class="font-weight-bold">
								<div class="font-weight-bold">

									<?php if ($participant->birth_date): ?>

										<?= $participant->birth_date->format('d F Y') ?>

									<?php else: ?>

										-

									<?php endif; ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Umur

								</label>

								<div class="font-weight-bold">

									<?= $participant->getAge() ? $participant->getAge() . ' Tahun' : '-' ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Tempat Lahir

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->birth_place ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Agama

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->religion ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6">

								<label class="text-muted">

									Status Pernikahan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)?->getMaritalStatusLabel() ?: '-') ?>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-map-marker-alt mr-2"></i>

							Alamat

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-12 mb-4">

								<label class="text-muted">

									Alamat Lengkap

								</label>

								<div class="font-weight-bold">

									<?= e($participant->address ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Provinsi

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->province ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Kabupaten / Kota

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->city ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Kecamatan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->district ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Kelurahan / Desa

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->village ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6">

								<label class="text-muted">

									Kode Pos

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->postal_code ?: '-') ?>

								</div>

							</div>

						</div>

					</div>

				</div>
				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-graduation-cap mr-2"></i>

							Pendidikan

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Pendidikan Terakhir

								</label>

								<div class="font-weight-bold">

									<?= e($participant->education ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Institusi

								</label>

								<div class="font-weight-bold">

									<?= e($participant->institution ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Jurusan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->major ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Tahun Lulus

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->graduation_year ?: '-') ?>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-briefcase mr-2"></i>

							Pekerjaan

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Status Pekerjaan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)?->getEmploymentStatusLabel() ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Pekerjaan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->occupation ?: '-') ?>

								</div>

							</div>

							<div class="col-md-12">

								<label class="text-muted">

									Instansi / Perusahaan

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->company_name ?: '-') ?>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-bullseye mr-2"></i>

							Tujuan Mengikuti Pelatihan

						</h5>

					</div>

					<div class="card-body">

						<div class="mb-4">

							<label class="text-muted">

								Tujuan Pelatihan

							</label>

							<div class="font-weight-bold">

								<?= nl2br(e(optional($participant->profile)->training_goal ?: '-')) ?>

							</div>

						</div>

						<div>

							<label class="text-muted">

								Keahlian / Skill

							</label>

							<div class="font-weight-bold">

								<?= nl2br(e(optional($participant->profile)->skill ?: '-')) ?>

							</div>

						</div>

					</div>

				</div>
				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-phone-alt mr-2"></i>

							Kontak Darurat

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Nama Kontak

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->emergency_contact_name ?: '-') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Nomor Telepon

								</label>

								<div class="font-weight-bold">

									<?= e(optional($participant->profile)->emergency_contact_phone ?: '-') ?>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-folder-open mr-2"></i>

							Dokumen Peserta

						</h5>

					</div>

					<div class="card-body">

						<div class="table-responsive">

							<table class="table table-bordered align-middle">

								<thead class="thead-light">

								<tr>

									<th width="220">

										Dokumen

									</th>

									<th width="160">

										Status

									</th>

									<th>

										Aksi

									</th>

								</tr>

								</thead>

								<tbody>

								<tr>

									<td>

										Foto Peserta

									</td>

									<td>

										<?php if (optional($participant->profile)->hasPhoto()): ?>

											<span class="badge badge-success">

												Tersedia

											</span>

										<?php else: ?>

											<span class="badge badge-secondary">

												Belum Upload

											</span>

										<?php endif; ?>

									</td>

									<td>

										<?php if (optional($participant->profile)->hasPhoto()): ?>

											<a
												href="<?= asset($participant->profile->photo) ?>"
												target="_blank"
												class="btn btn-outline-primary btn-sm">

												<i class="fas fa-eye mr-1"></i>

												Lihat

											</a>

										<?php else: ?>

											-

										<?php endif; ?>

									</td>

								</tr>

								<tr>

									<td>

										KTP

									</td>

									<td>

										<?php if (optional($participant->profile)->hasKtp()): ?>

											<span class="badge badge-success">

												Tersedia

											</span>

										<?php else: ?>

											<span class="badge badge-secondary">

												Belum Upload

											</span>

										<?php endif; ?>

									</td>

									<td>

										<?php if (optional($participant->profile)->hasKtp()): ?>

											<a
												href="<?= asset($participant->profile->ktp_file) ?>"
												target="_blank"
												class="btn btn-outline-primary btn-sm">

												<i class="fas fa-download mr-1"></i>

												Lihat

											</a>

										<?php else: ?>

											-

										<?php endif; ?>

									</td>

								</tr>


								</tbody>

							</table>

						</div>

					</div>

				</div>
				<div class="card shadow border-0 mb-4">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-chart-pie mr-2"></i>

							Ringkasan Profil

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-4 mb-4">

								<div class="border rounded p-3 text-center h-100">

									<i class="fas fa-user-check fa-2x text-success mb-3"></i>

									<h6 class="font-weight-bold">

										Status Profil

									</h6>

									<?php if ($participant->isProfileCompleted()): ?>

										<span class="badge badge-success px-3 py-2">

										Lengkap

									</span>

									<?php else: ?>

										<span class="badge badge-warning px-3 py-2">

										Belum Lengkap

									</span>

									<?php endif; ?>

								</div>

							</div>

							<div class="col-md-4 mb-4">

								<div class="border rounded p-3 text-center h-100">

									<i class="fas fa-file-alt fa-2x text-primary mb-3"></i>

									<h6 class="font-weight-bold">

										Dokumen

									</h6>

									<p class="mb-0 text-muted">

										<?= collect([
											optional($participant->profile)->hasPhoto(),
											optional($participant->profile)->hasKtp(),

										])->filter()->count() ?>

										/

										2 Dokumen

									</p>

								</div>

							</div>

							<div class="col-md-4 mb-4">

								<div class="border rounded p-3 text-center h-100">

									<i class="fas fa-calendar-alt fa-2x text-info mb-3"></i>

									<h6 class="font-weight-bold">

										Usia Akun

									</h6>

									<p class="mb-0 text-muted">

										<?= $participant->created_at->diffForHumans() ?>

									</p>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="card shadow border-0">

					<div class="card-header bg-white">

						<h5 class="font-weight-bold text-primary mb-0">

							<i class="fas fa-info-circle mr-2"></i>

							Informasi Sistem

						</h5>

					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									ID Peserta

								</label>

								<div class="font-weight-bold">

									#<?= $participant->id ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									ID User

								</label>

								<div class="font-weight-bold">

									#<?= $participant->user->id ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Dibuat Pada

								</label>

								<div class="font-weight-bold">

									<?= $participant->created_at->format('d F Y H:i') ?>

								</div>

							</div>

							<div class="col-md-6 mb-4">

								<label class="text-muted">

									Terakhir Diperbarui

								</label>

								<div class="font-weight-bold">

									<?= $participant->updated_at->format('d F Y H:i') ?>

								</div>

							</div>

						</div>

						<hr>

						<div class="d-flex justify-content-between align-items-center">

							<div>

								<h6 class="font-weight-bold mb-1">

									Aksi

								</h6>

								<small class="text-muted">

									Kelola data peserta dari halaman ini.

								</small>

							</div>

							<div>

								<a
									href="<?= url('/admin/participants') ?>"
									class="btn btn-secondary">

									<i class="fas fa-arrow-left mr-1"></i>

									Kembali

								</a>


								<form
									method="POST"
									action="<?= url('/admin/participants/delete') ?>"
									class="d-inline">

									<input
										type="hidden"
										name="id"
										value="<?= $participant->id ?>">

									<button
										type="submit"
										class="btn btn-danger"
										onclick="return confirm('Yakin ingin menghapus peserta ini?')">

										<i class="fas fa-trash mr-1"></i>

										Hapus

									</button>

								</form>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
	</div>

</div>



<script>

	document.addEventListener('DOMContentLoaded', function () {


		// tooltip bootstrap

		$('[data-toggle="tooltip"]').tooltip();


	});


</script>
