<div class="info">


	<table>


		<tr>


			<td width="180">

				Total Lulusan

			</td>


			<td width="20">

				:

			</td>


			<td>

				<?= $scores->count() ?>

				Peserta

			</td>


		</tr>





		<tr>


			<td>

				Rata-rata Nilai

			</td>


			<td>

				:

			</td>


			<td>

				<?= number_format(
					$scores->avg('final_score') ?? 0,
					2
				) ?>


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

			Pelatihan

		</th>


		<th>

			Bidang

		</th>


		<th>

			Nilai Akhir

		</th>


		<th>

			Predikat

		</th>


		<th>

			Tanggal Lulus

		</th>


		<th>

			Status

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($scores as $i => $score): ?>


		<?php


		$registration = $score->registration;


		$participant = $registration?->participant;


		$user = $participant?->user;


		$training = $registration?->training;


		?>



		<tr>


			<td class="text-center">


				<?= $i + 1 ?>


			</td>





			<td>


				<?= $user?->name ?? '-' ?>


			</td>





			<td>


				<?= $user?->email ?? '-' ?>


			</td>





			<td>


				<?= $training?->name ?? '-' ?>


			</td>





			<td>


				<?= $training
					?->trainingField
					?->name ?? '-' ?>


			</td>





			<td class="text-center">


				<strong>

					<?= $score->getFinalScore() ?>

				</strong>


			</td>





			<td class="text-center">


				<?= $score->getPredicateLabel() ?>


			</td>





			<td>


				<?= $score->published_at

					?->format('d/m/Y')

					?? '-'

				?>


			</td>





			<td class="text-center">


				<?= $score->isPassed()

					? 'Lulus'

					: 'Tidak Lulus'

				?>


			</td>


		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
