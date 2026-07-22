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

				<?= $summary['total_training'] ?>

				Program

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

				<?= $summary['total_participant'] ?>

				Peserta

			</td>


		</tr>





		<tr>


			<td>

				Total Kehadiran

			</td>


			<td>

				:

			</td>


			<td>

				<?= $summary['total_attendance'] ?>

				Kehadiran

			</td>


		</tr>





		<tr>


			<td>

				Total Lulusan

			</td>


			<td>

				:

			</td>


			<td>

				<?= $summary['total_graduation'] ?>

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

			Pelatihan

		</th>


		<th>

			Bidang

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

			Kehadiran

		</th>


		<th>

			Lulus

		</th>


		<th>

			Status

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($summary['trainings'] as $i => $training): ?>


		<?php


		$registrations = $training->registrations;



		$totalParticipant = $registrations

			->pluck('participant_id')

			->unique()

			->count();



		$totalGraduation = \Natasya\NataApp\Model\TrainingScore::query()

			->whereIn(
				'registration_id',
				$registrations->pluck('id')
			)

			->where(
				'is_passed',
				true
			)

			->count();


		?>



		<tr>


			<td class="text-center">


				<?= $i + 1 ?>


			</td>





			<td>


				<?= $training->name ?>


			</td>





			<td>


				<?= $training
					->trainingField
					?->name ?? '-' ?>


			</td>





			<td>


				<?= $training->training_start

					?->format('d/m/Y')

					?? '-'

				?>

				-

				<?= $training->training_end

					?->format('d/m/Y')

					?? '-'

				?>


			</td>





			<td class="text-center">


				<?= $training->quota ?? 0 ?>


			</td>





			<td class="text-center">


				<?= $totalParticipant ?>


			</td>





			<td class="text-center">


				<?= $registrations->count() ?>


			</td>





			<td class="text-center">


				<?= $totalGraduation ?>


			</td>





			<td class="text-center">


				<?= ucfirst($training->status ?? '-') ?>


			</td>



		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
