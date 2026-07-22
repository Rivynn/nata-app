<div class="info">


	<table>


		<tr>


			<td width="180">

				Total Sertifikat

			</td>


			<td width="20">

				:

			</td>


			<td>

				<?= $certificates->count() ?>

				Sertifikat

			</td>


		</tr>





		<tr>


			<td>

				Sertifikat Aktif

			</td>


			<td>

				:

			</td>


			<td>

				<?= $certificates

					->where('status','active')

					->count()

				?>

				Sertifikat

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

			Nomor Sertifikat

		</th>


		<th>

			Nama Peserta

		</th>


		<th>

			Pelatihan

		</th>


		<th>

			Bidang

		</th>


		<th>

			Tanggal Terbit

		</th>


		<th>

			Status

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($certificates as $i => $certificate): ?>


		<?php


		$registration = $certificate->registration;


		$participant = $registration?->participant;


		$user = $participant?->user;


		$training = $registration?->training;


		?>



		<tr>


			<td class="text-center">


				<?= $i + 1 ?>


			</td>





			<td>


				<?= $certificate->certificate_number ?? '-' ?>


			</td>





			<td>


				<?= $user?->name ?? '-' ?>


			</td>





			<td>


				<?= $training?->name ?? '-' ?>


			</td>





			<td>


				<?= $training

					?->trainingField

					?->name ?? '-'

				?>


			</td>





			<td>


				<?= $certificate->issued_at

					?->format('d/m/Y')

					?? '-'

				?>


			</td>





			<td class="text-center">


				<?= match($certificate->status){


					'active' => 'Aktif',


					'inactive' => 'Tidak Aktif',


					default => '-',


				} ?>


			</td>


		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
