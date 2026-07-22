<?php

	/**
	 * Variables:
	 *
	 * $valid
	 * $certificate
	 */


	$registration = $certificate?->registration;


	$participant = $registration?->participant;


	$user = $participant?->user;


	$training = $registration?->training;


	$field = $training?->trainingField;


	$issuer = $certificate?->issuer;


?>


<!DOCTYPE html>

<html lang="id">


<head>


	<meta charset="UTF-8">


	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title>

		Verifikasi Sertifikat

	</title>



	<style>


		*{

			margin:0;

			padding:0;

			box-sizing:border-box;

		}



		body{

			min-height:100vh;

			background:#f1f5f9;

			font-family:Arial, Helvetica, sans-serif;

			display:flex;

			align-items:center;

			justify-content:center;

			padding:30px;

		}



		.container{

			width:100%;

			max-width:700px;

		}



		.card{

			background:#fff;

			border-radius:18px;

			padding:40px;

			box-shadow:

				0 20px 50px rgba(0,0,0,.08);

		}



		.header{

			text-align:center;

			margin-bottom:30px;

		}



		.logo{

			width:90px;

			height:90px;

			object-fit:contain;

			margin-bottom:15px;

		}



		.header h1{

			font-size:28px;

			color:#123c7a;

			margin-bottom:8px;

		}



		.header p{

			color:#64748b;

			font-size:14px;

		}



		.status{

			text-align:center;

			padding:18px;

			border-radius:12px;

			margin-bottom:30px;

		}



		.status.valid{

			background:#dcfce7;

			color:#166534;

		}



		.status.invalid{

			background:#fee2e2;

			color:#991b1b;

		}



		.status i{

			font-size:40px;

			display:block;

			margin-bottom:10px;

		}



		.status h2{

			font-size:24px;

			margin-bottom:5px;

		}



		.info{

			width:100%;

			border-collapse:collapse;

		}



		.info tr{

			border-bottom:1px solid #e5e7eb;

		}



		.info td{

			padding:14px 5px;

			font-size:15px;

			vertical-align:top;

		}



		.info td:first-child{

			width:180px;

			color:#64748b;

			font-weight:bold;

		}



		.badge{

			display:inline-block;

			padding:6px 14px;

			border-radius:20px;

			background:#16a34a;

			color:white;

			font-size:13px;

		}



		.footer{

			margin-top:30px;

			text-align:center;

			color:#64748b;

			font-size:13px;

		}



		.code{

			background:#f8fafc;

			padding:12px;

			border-radius:8px;

			font-family:monospace;

			color:#334155;

		}



		@media(max-width:600px){


			body{

				padding:15px;

			}



			.card{

				padding:25px;

			}



			.info td:first-child{

				width:120px;

			}


		}


	</style>


</head>



<body>



<div class="container">



	<div class="card">



		<div class="header">


			<img

				src="<?= asset('img/logo.png') ?>"

				class="logo"

			>



			<h1>

				Verifikasi Sertifikat

			</h1>



			<p>

				Sistem Verifikasi Sertifikat Digital

			</p>


		</div>





		<?php if($valid): ?>





			<div class="status valid">


				<i>

					✓

				</i>


				<h2>

					Sertifikat Valid

				</h2>


				<p>

					Sertifikat resmi dan terdaftar pada sistem.

				</p>



			</div>





			<table class="info">



				<tr>

					<td>

						Nomor Sertifikat

					</td>


					<td>

						<strong>

							<?= $certificate->certificate_number ?>

						</strong>

					</td>


				</tr>





				<tr>

					<td>

						Nama Peserta

					</td>


					<td>

						<?= $user?->name ?? '-' ?>

					</td>


				</tr>





				<tr>

					<td>

						Pelatihan

					</td>


					<td>

						<?= $training?->name ?? '-' ?>

					</td>


				</tr>





				<tr>

					<td>

						Bidang Pelatihan

					</td>


					<td>

						<?= $field?->name ?? '-' ?>

					</td>


				</tr>





				<tr>

					<td>

						Tanggal Terbit

					</td>


					<td>

						<?= $certificate->issued_at?->format('d F Y') ?? '-' ?>

					</td>


				</tr>





				<tr>

					<td>

						Diterbitkan Oleh

					</td>


					<td>

						<?= $issuer?->name ?? '-' ?>

					</td>


				</tr>





				<tr>

					<td>

						Kode Verifikasi

					</td>


					<td>

						<div class="code">

							<?= $certificate->verification_code ?>

						</div>

					</td>


				</tr>





				<tr>

					<td>

						Status

					</td>


					<td>

						<span class="badge">

							VALID

						</span>

					</td>


				</tr>



			</table>






		<?php else: ?>





			<div class="status invalid">


				<i>

					✕

				</i>


				<h2>

					Sertifikat Tidak Valid

				</h2>


				<p>

					Kode verifikasi tidak ditemukan atau sertifikat tidak terdaftar.

				</p>



			</div>





		<?php endif; ?>





		<div class="footer">


			© <?= date('Y') ?>

			Sistem Informasi Pelatihan


		</div>




	</div>



</div>



</body>


</html>
