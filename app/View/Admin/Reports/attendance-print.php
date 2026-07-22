<div class="info">


	<table>


		<tr>


			<td width="180">

				Total Absensi

			</td>


			<td width="20">

				:

			</td>


			<td>

				<?= $attendances->count() ?>

				Data Kehadiran

			</td>


		</tr>





		<tr>


			<td>

				Total Hadir

			</td>


			<td>

				:

			</td>


			<td>


				<?= $attendances->where('status', 'present')->count() ?>

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

			Pelatihan

		</th>


		<th>

			Pertemuan

		</th>


		<th>

			Tanggal

		</th>


		<th>

			Waktu Hadir

		</th>


		<th>

			Status

		</th>


	</tr>


	</thead>





	<tbody>


	<?php foreach($attendances as $i => $attendance): ?>


		<?php


		$schedule = $attendance
			->attendanceSession
			?->trainingSchedule;


		$participant = $attendance
			->registration
			?->participant;


		$user = $participant
			?->user;


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


				<?= $schedule
					?->training
					?->name ?? '-' ?>


			</td>





			<td>


				<?= $schedule?->getMeetingLabel() ?? '-' ?>


			</td>





			<td>


				<?= $schedule
					?->schedule_date
					?->format('d/m/Y') ?? '-' ?>


			</td>





			<td>


				<?= $attendance->check_in_at

					?->format('H:i')

					?? '-'

				?>


			</td>





			<td class="text-center">


				<?= match($attendance->status){


					'present' => 'Hadir',


					'late' => 'Terlambat',


					'absent' => 'Tidak Hadir',


					default => '-',


				} ?>


			</td>



		</tr>



	<?php endforeach; ?>


	</tbody>


</table>
