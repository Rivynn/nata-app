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

				<?= $participants->count() ?>

				Peserta

			</td>


		</tr>



		<tr>

			<td>

				Tanggal Cetak

			</td>


			<td>

				:

			</td>


			<td>

				<?= $printed_at ?? date('d M Y H:i') ?>

			</td>


		</tr>


	</table>

</div>





<table>


	<thead>


	<tr>


		<th width="40">

			No

		</th>


		<th>

			Nama Peserta

		</th>


		<th>

			Email

		</th>


		<th>

			No. HP

		</th>


		<th>

			Pelatihan

		</th>


		<th>

			Bidang

		</th>


		<th>

			Status Registrasi

		</th>


		<th>

			Status Profil

		</th>


		<th>

			Tanggal Daftar

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($participants as $i => $participant): ?>


		<?php

		$registrations = $participant->registrations;

		?>



		<tr>


			<td class="text-center">


				<?= $i + 1 ?>


			</td>





			<td>


				<?= $participant->user?->name ?? '-' ?>


			</td>





			<td>


				<?= $participant->user?->email ?? '-' ?>


			</td>





			<td>


				<?= $participant->phone ?: '-' ?>


			</td>





			<td>


				<?php if($registrations->count()): ?>


					<?php foreach($registrations as $registration): ?>


						<div>


							<?= $registration->training?->name ?? '-' ?>


						</div>


					<?php endforeach; ?>


				<?php else: ?>


					-


				<?php endif; ?>


			</td>





			<td>


				<?php if($registrations->count()): ?>


					<?php foreach($registrations as $registration): ?>


						<div>


							<?= $registration
								->training
								?->trainingField
								?->name ?? '-' ?>


						</div>


					<?php endforeach; ?>


				<?php else: ?>


					-


				<?php endif; ?>


			</td>





			<td class="text-center">


				<?php if($registrations->count()): ?>


					<?php foreach($registrations as $registration): ?>


						<div>


							<?= match($registration->status){


								'pending' =>
								'Pending',


								'approved' =>
								'Disetujui',


								'rejected' =>
								'Ditolak',


								'completed' =>
								'Selesai',


								default =>
								'-',


							} ?>


						</div>


					<?php endforeach; ?>


				<?php else: ?>


					-


				<?php endif; ?>


			</td>





			<td class="text-center">


				<?= $participant->profile?->is_completed

					? 'Lengkap'

					: 'Belum Lengkap'

				?>


			</td>





			<td>


				<?= $participant->created_at?->format('d/m/Y') ?>


			</td>



		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
