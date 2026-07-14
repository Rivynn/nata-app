<div class="info">

	<table>

		<tr>

			<td width="180">

				Total Peserta

			</td>

			<td width="20">

				:

			</td>

			<td>

				<?= count($participants) ?>

			</td>

		</tr>

	</table>

</div>

<table>

	<thead>

	<tr>

		<th width="40">No</th>

		<th>Nama Peserta</th>

		<th>Email</th>

		<th>No. HP</th>

		<th>Bidang</th>

		<th>Pelatihan</th>

		<th>Status Registrasi</th>

		<th>Status Akun</th>

		<th>Tanggal Daftar</th>

	</tr>

	</thead>

	<tbody>

	<?php foreach($participants as $i => $participant): ?>

		<tr>

			<td class="text-center">

				<?= $i + 1 ?>

			</td>

			<td>

				<?= $participant['name'] ?>

			</td>

			<td>

				<?= $participant['email'] ?>

			</td>

			<td>

				<?= $participant['phone'] ?: '-' ?>

			</td>

			<td>

				<?= $participant['field_name'] ?: '-' ?>

			</td>

			<td>

				<?= $participant['training_name'] ?: '-' ?>

			</td>

			<td class="text-center">

				<?= match($participant['status']){

					'pending'   => 'Pending',
					'approved'  => 'Disetujui',
					'rejected'  => 'Ditolak',
					'completed' => 'Selesai',
					default     => '-',

				} ?>

			</td>
			<td>

				<?= match($participant['account_status']){

					'active'   => 'Aktif',
					'inactive' => 'Belum Aktif',
					'disabled' => 'Nonaktif',
					default    => '-',

				} ?>

			</td>

			<td>

				<?= date('d/m/Y', strtotime($participant['created_at'])) ?>

			</td>
		</tr>

	<?php endforeach; ?>

	</tbody>

</table>