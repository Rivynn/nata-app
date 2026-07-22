<?php

	/**
	 * Variables
	 *
	 * $certificate
	 * $qrcode
	 */


	$registration = $certificate->registration;


	$participant = $registration?->participant;


	$user = $participant?->user;


	$training = $registration?->training;


	$field = $training?->trainingField;


	$score = $registration?->score;


	$issuer = $certificate->issuer;


?>



<!DOCTYPE html>

<html lang="id">


<head>


	<meta charset="UTF-8">


	<title>

		Sertifikat - <?= $user?->name ?? '-' ?>

	</title>



	<style>


		*{

			margin:0;

			padding:0;

			box-sizing:border-box;

		}



		html,

		body{


			width:100%;


			height:100%;


			background:#ececec;


			font-family:"Times New Roman",serif;


		}



		body{


			padding:40px;


		}





		.toolbar{


			width:100%;


			display:flex;


			justify-content:flex-end;


			gap:15px;


			margin-bottom:25px;


		}





		.btn{


			padding:12px 26px;


			border-radius:8px;


			text-decoration:none;


			color:#fff;


			font-weight:bold;


			transition:.25s;


			display:inline-flex;


			align-items:center;


			gap:8px;


		}



		.btn:hover{


			opacity:.9;


		}



		.btn-primary{


			background:#2563eb;


		}



		.btn-success{


			background:#16a34a;


		}





		.certificate{


			width:1123px;


			height:794px;


			margin:auto;


			position:relative;


			background:white;


			overflow:hidden;


			border:14px solid #caa548;


			outline:3px solid #8b6a1d;


			outline-offset:-20px;


			box-shadow:0 15px 40px rgba(0,0,0,.25);


		}





		.pattern-top{


			position:absolute;


			top:0;


			left:0;


			width:100%;


			height:12px;


			background:#caa548;


		}





		.pattern-bottom{


			position:absolute;


			bottom:0;


			left:0;


			width:100%;


			height:12px;


			background:#caa548;


		}





		.watermark{


			position:absolute;


			top:50%;


			left:50%;


			transform:translate(-50%,-50%);


			width:420px;


			opacity:.04;


		}





		.content{

			position:relative;

			z-index:5;

			padding:25px 70px;

			height:100%;

			transform:scale(.94);

			transform-origin:top center;

		}





		.header{


			display:flex;


			justify-content:space-between;


			align-items:center;


		}





		.logo{


			width:95px;


			height:95px;


			object-fit:contain;


		}





		.agency{


			text-align:center;


			flex:1;


		}





		.agency h3{


			font-size:18px;


			letter-spacing:2px;


		}





		.agency h2{


			font-size:30px;


			margin-top:6px;


			color:#123c7a;


		}





		.agency p{


			margin-top:6px;


			color:#555;


			font-size:14px;


		}





		.divider{


			width:100%;


			border-top:4px solid #caa548;


			border-bottom:1px solid #caa548;


			margin:20px 0;


		}





		.title{


			text-align:center;


			font-size:52px;


			color:#123c7a;


			font-weight:bold;


			letter-spacing:5px;


		}





		.subtitle{


			margin-top:5px;


			text-align:center;


			color:#666;


			font-size:20px;


			letter-spacing:2px;


		}





		.recipient{


			margin-top:40px;


			text-align:center;


		}





		.recipient small{


			display:block;


			font-size:18px;


			color:#666;


			margin-bottom:12px;


		}





		.recipient h1{


			font-size:50px;


			color:#8b6a1d;


			border-bottom:2px solid #caa548;


			display:inline-block;


			padding:0 35px 8px;


		}





		.description{


			width:82%;


			margin:20px auto;


			text-align:center;


			line-height:1.5;


			font-size:18px;


			color:#333;


		}





		.training{


			text-align:center;


			font-size:26px;


			font-weight:bold;


			color:#123c7a;


		}





		.field{


			text-align:center;


			margin-top:5px;


			color:#666;


			font-size:16px;


		}







		.detail-section{


			margin-top:20px;


			display:flex;


			justify-content:space-between;


			align-items:flex-start;


		}





		.detail-table{


			width:58%;


			font-size:16px;


			border-collapse:collapse;


		}





		.qrcode-box{


			width:150px;


			text-align:center;


		}





		.qrcode-box svg{


			width:140px;


			height:140px;


		}





		.qrcode-wrapper{


			width:140px;


			height:140px;


			margin:auto;


			margin-bottom:5px;


			overflow:visible;


			display:flex;


			align-items:center;


			justify-content:center;


		}





		.qrcode-text{


			font-size:12px;


			color:#777;


			line-height:1.3;


		}





		.signature{


			margin-top:15px;


			display:flex;


			justify-content:space-between;


			align-items:flex-end;


		}




		.signature-box{


			width:300px;


			text-align:center;


		}





		.signature-space{


			height:70px;


		}





		.signature-name{


			border-top:1px solid #444;


			padding-top:8px;


			font-weight:bold;


		}





		@media print{

			@page{

				size:landscape;

				margin:0;

			}
			body{


				background:white;


				padding:0;


			}



			.toolbar{


				display:none;


			}



			.certificate{

				margin:0;

				width:1123px;

				height:794px;

				border:none;

				outline:none;

				box-shadow:none;

			}


		}



	</style>

</head>


<body>


<div class="toolbar">


	<a
		href="<?= url('/pegawai/certificates') ?>"
		class="btn btn-primary">


		<i class="fas fa-arrow-left mr-2"></i>


		Kembali


	</a>




	<a
		href="javascript:window.print();"
		class="btn btn-success">


		🖨 Cetak / Simpan PDF


	</a>


</div>

<div class="certificate">


	<div class="pattern-top"></div>


	<div class="pattern-bottom"></div>




	<!-- watermark -->


	<img

		src="<?= asset('img/logo.png') ?>"

		class="watermark"

	>





	<div class="content">





		<div class="header">


			<img

				src="<?= asset('img/logo.png') ?>"

				class="logo"

			>





			<div class="agency">


				<h3>

					PEMERINTAH KOTA BANJARBARU

				</h3>



				<h2>

					DINAS KOPERASI, USAHA MIKRO DAN TENAGA KERJA

				</h2>



				<p>

					Jl. Ahmad Yani KM 33 Banjarbaru

				</p>


			</div>





			<img

				src="<?= asset('img/logo.png') ?>"

				class="logo"

			>


		</div>





		<div class="divider"></div>





		<div class="title">


			SERTIFIKAT


		</div>





		<div class="subtitle">


			CERTIFICATE OF COMPLETION


		</div>





		<div class="recipient">


			<small>


				Diberikan Kepada


			</small>





			<h1>


				<?= strtoupper(

					$user?->name ?? '-'

				) ?>


			</h1>


		</div>





		<div class="description">


			Dengan ini menyatakan bahwa peserta telah berhasil

			menyelesaikan pelatihan yang diselenggarakan oleh



			<strong>

				Dinas Koperasi, Usaha Mikro dan Tenaga Kerja Kota Banjarbaru

			</strong>



			dengan hasil yang memuaskan.


		</div>





		<div class="training">


			<?= $training?->name ?? '-' ?>


		</div>





		<div class="field">


			<?= $field?->name ?? '-' ?>


		</div>





		<div
			class="detail-section"

		>




			<table class="detail-table"

			>



				<tr>


					<td width="220">


						Nomor Sertifikat


					</td>



					<td width="20">


						:


					</td>



					<td>


						<strong>


							<?= $certificate->certificate_number ?>


						</strong>


					</td>


				</tr>





				<tr>


					<td>


						Verification Code


					</td>



					<td>


						:


					</td>



					<td>


						<?= $certificate->verification_code ?>


					</td>


				</tr>





				<tr>


					<td>


						Tanggal Terbit


					</td>



					<td>


						:


					</td>



					<td>


						<?= $certificate->issued_at?->format('d F Y') ?>


					</td>


				</tr>





				<tr>


					<td>


						Disetujui Oleh


					</td>



					<td>


						:


					</td>



					<td>


						<?= $issuer?->name ?? 'Pegawai' ?>


					</td>


				</tr>



			</table>





			<div class="qrcode-box">

				<div class="qrcode-wrapper">

					<?= $qrcode ?>

				</div>

				<div class="qrcode-text">

					Scan QR Code untuk melakukan<br>
					verifikasi sertifikat.

				</div>

			</div>





		</div>
		<div
			class="signature"

		>



			<div
				class="signature-box"
			>


				<div

		class="signature-name"
		class="signature-name"
				>


					Peserta


				</div>





				<div

					style="

						border-top:1px solid #444;

						padding-top:8px;

						font-weight:bold;

					"

				>


					<?= $user?->name ?? '-' ?>


				</div>



			</div>





			<div

				style="

					width:320px;

					text-align:center;

				"

			>



				<div>


					Banjarbaru,

					<?= $certificate->issued_at?->format('d F Y') ?>


				</div>





				<div

					style="

						margin-top:10px;

					"

				>


					Kepala Dinas


				</div>





				<div

					style="

						height:95px;

					"

				>



				</div>





				<div

					style="

						border-top:1px solid #444;

						padding-top:8px;

						font-weight:bold;

					"

				>


					<?= strtoupper(

						$issuer?->name ?? 'PEJABAT TERKAIT'

					) ?>



				</div>



			</div>




		</div>





	</div>


</div>
</body>


</html>
