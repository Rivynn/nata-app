<?php

	/**
	 * Variables
	 *
	 * $certificate
	 */

?>
<!DOCTYPE html>
<html lang="id">

<head>

	<meta charset="UTF-8">

	<title>

		Sertifikat - <?= $certificate['name'] ?>

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

            padding:45px 70px;

            height:100%;

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

            margin:25px 0;

        }

        .title{

            text-align:center;

            font-size:52px;

            color:#123c7a;

            font-weight:bold;

            letter-spacing:5px;

        }

        .subtitle{

            margin-top:8px;

            text-align:center;

            color:#666;

            font-size:20px;

            letter-spacing:2px;

        }

        .recipient{

            margin-top:55px;

            text-align:center;

        }

        .recipient small{

            display:block;

            font-size:18px;

            color:#666;

            margin-bottom:18px;

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

            margin:40px auto;

            text-align:center;

            line-height:2;

            font-size:21px;

            color:#333;

        }

        .training{

            text-align:center;

            font-size:34px;

            font-weight:bold;

            color:#123c7a;

        }

        .field{

            text-align:center;

            margin-top:10px;

            color:#666;

            font-size:18px;

        }

	</style>

</head>

<body>

<div class="toolbar">

	<a
		href="<?= url('/pegawai/participants/show?id=' . $certificate['registration_id']) ?>"
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
		class="watermark">

	<div class="content">

		<div class="header">

			<img
				src="<?= asset('img/logo.png') ?>"
				class="logo">

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
				class="logo">

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

				<?= strtoupper($certificate['name']) ?>

			</h1>

		</div>

		<div class="description">

			Dengan ini menyatakan bahwa peserta telah berhasil
			menyelesaikan pelatihan yang diselenggarakan oleh
			<strong>Dinas Koperasi, Usaha Mikro dan Tenaga Kerja Kota Banjarbaru</strong>
			dengan hasil yang memuaskan.

		</div>

		<div class="training">

			<?= $certificate['training_name'] ?>

		</div>

		<div class="field">

			<?= $certificate['field_name'] ?>

		</div>
		<div
			style="
        margin-top:60px;
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
">

			<table
				style="
            width:58%;
            font-size:18px;
            border-collapse:collapse;
        ">

				<tr>

					<td width="220">

						Nomor Sertifikat

					</td>

					<td width="20">

						:

					</td>

					<td>

						<strong>

							<?= $certificate['certificate_number'] ?>

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

						<?= $certificate['verification_code'] ?>

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

						<?= date(
							'd F Y',
							strtotime($certificate['issued_at'])
						) ?>

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

						<?= $certificate['approved_by_name'] ?>

					</td>

				</tr>

			</table>

			<div
				style="
            width:240px;
            text-align:center;
        ">

				<img
					src="<?= asset('images/qrcode-placeholder.png') ?>"
					style="
                width:170px;
                margin-bottom:10px;
            ">

				<div
					style="
                font-size:13px;
                color:#777;
            ">

					Scan QR Code untuk melakukan
					verifikasi sertifikat.

				</div>

			</div>

		</div>

		<div
			style="
        margin-top:70px;
        display:flex;
        justify-content:space-between;
        align-items:flex-end;
">

			<div
				style="
            width:300px;
            text-align:center;
        ">

				<div
					style="
                margin-bottom:80px;
            ">

					Peserta

				</div>

				<div
					style="
                border-top:1px solid #444;
                padding-top:8px;
                font-weight:bold;
            ">

					<?= $certificate['name'] ?>

				</div>

			</div>

			<div
				style="
            width:320px;
            text-align:center;
        ">

				<div>

					Banjarbaru,

					<?= date(
						'd F Y',
						strtotime($certificate['issued_at'])
					) ?>

				</div>

				<div
					style="
                margin-top:10px;
            ">

					Kepala Dinas

				</div>

				<div
					style="
                height:95px;
            ">

				</div>

				<div
					style="
                border-top:1px solid #444;
                padding-top:8px;
                font-weight:bold;
            ">

					<?= strtoupper(
						$certificate['approved_by_name']
					) ?>

				</div>

			</div>

		</div>



	</div>

</div>

<style>

    @media print{

        body{

            background:white;

            padding:0;

        }

        .toolbar{

            display:none;

        }

        .certificate{

            margin:0;

            width:100%;

            height:100vh;

            border:none;

            outline:none;

            box-shadow:none;

            page-break-after:avoid;

        }

    }

</style>

</body>

</html>