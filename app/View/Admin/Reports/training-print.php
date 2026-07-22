<div class="info">


	<table>


		<tr>


			<td width="180">

				Total Pelatihan

			</td>


			<td width="20">

				:

			</td>


			<td>

				<?= $trainings->count() ?>

				Pelatihan

			</td>


		</tr>





		<tr>


			<td>

				Total Peserta

			</td>


			<td>

				:

			</td>


			<td>

				<?= $trainings->sum(
					fn($training) =>
					$training->registrations->count()
				) ?>

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

			Kode

		</th>


		<th>

			Nama Pelatihan

		</th>


		<th>

			Bidang

		</th>


		<th>

			Pelatih

		</th>


		<th>

			Periode

		</th>


		<th>

			Kuota

		</th>


		<th>

			Peserta

		</th>


		<th>

			Status

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($trainings as $i => $training): ?>



		<tr>



			<td class="text-center">


				<?= $i + 1 ?>


			</td>





			<td>


				<?= $training->code ?? '-' ?>


			</td>





			<td>


				<?= $training->name ?? '-' ?>


			</td>





			<td>


				<?= $training->trainingField?->name ?? '-' ?>


			</td>





			<td>


				<?= $training->trainer?->user?->name ?? '-' ?>


			</td>





			<td>


				<?= $training->training_start?->format('d/m/Y') ?? '-' ?>


				<br>


				s/d


				<br>


				<?= $training->training_end?->format('d/m/Y') ?? '-' ?>


			</td>





			<td class="text-center">


				<?= $training->quota ?>


			</td>





			<td class="text-center">


				<?= $training->registrations->count() ?>


			</td>





			<td class="text-center">


				<?= match($training->status){


					'draft' => 'Draft',


					'open' => 'Buka Pendaftaran',


					'closed' => 'Ditutup',


					'running' => 'Berjalan',


					'completed' => 'Selesai',


					'cancelled' => 'Dibatalkan',


					default => '-',


				} ?>


			</td>



		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
