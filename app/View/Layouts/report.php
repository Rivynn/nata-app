<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>

        <?= $title ?> - <?= app_name() ?>

    </title>

    <link
            rel="stylesheet"
            href="<?= asset('css/sb-admin-2.min.css') ?>">

    <style>

        *{
            box-sizing:border-box;
        }

        body{

            font-family:"Times New Roman", serif;

            font-size:14px;

            color:#000;

            margin:20mm;

        }

        .report-header{

            display:flex;

            align-items:center;

            padding-bottom:8px;

            margin-bottom:8px;

        }

        .report-logo{

            width:82px;

            margin-right:18px;

            flex-shrink:0;

        }

        .report-logo img{

            width:100%;

        }

        .report-company{

            flex:1;

            text-align:center;

        }

        .report-company .government{

            font-size:18px;

            font-weight:normal;

            text-transform:uppercase;

            line-height:1.2;

        }

        .report-company .department{

            font-size:28px;

            font-weight:bold;

            text-transform:uppercase;

            line-height:1.2;

            margin:2px 0 6px;

        }

        .report-company .address{

            font-size:12px;

            line-height:1.3;

        }

        .report-company .website{

            font-size:12px;

            line-height:1.3;

        }

        .report-line{

            height:6px;

            background:#000;

            margin-bottom:2px;

        }

        .report-line::after{

            content:"";

            display:block;

            height:2px;

            background:#000;

            margin-top:2px;

        }

        .report-title{

            text-align:center;

            margin:30px 0;

        }

        .report-title h3{

            margin:0;

            text-transform:uppercase;

            text-decoration:underline;

            font-size:20px;

        }

        .report-title p{

            margin-top:8px;

            font-size:13px;

        }

        table{

            width:100%;

            border-collapse:collapse;

            font-size:13px;

        }

        table th,
        table td{

            border:1px solid #000;

            padding:8px;

        }

        table th{

            background:#efefef;

            text-align:center;

        }

        .report-footer{

            width:320px;

            margin-top:90px;

            margin-left:auto;

            text-align:center;

        }

        .report-footer .space{

            height:90px;

        }

        .report-footer strong{

            text-decoration:underline;

        }

        @page{

            size:A4 portrait;

            margin:15mm;

        }

    </style>

</head>

<body>

<div class="report-header">

    <div class="report-logo">

        <img
                src="<?= asset('img/logo.png') ?>"
                alt="Logo">

    </div>

    <div class="report-company">

        <div class="government">

            PEMERINTAH KOTA BANJARBARU

        </div>

        <div class="department">

            DINAS KOPERASI USAHA MIKRO DAN TENAGA KERJA

        </div>

        <div class="address">

            Alamat Kantor :
            Jalan Sukarno Hatta (Trikora)
            Telp./Fax. 0511 6749523 Banjarbaru.
            Kode Pos 70712, Kalimantan Selatan

        </div>

        <div class="website">

            Website :
            http://diskopukmnaker.banjarbarukota.go.id
            /
            Email :
            admin@diskopukmnaker.banjarbarukota.go.id

        </div>

    </div>

</div>

<div class="report-line"></div>

<div class="report-title">

    <h3>

        <?= $title ?>

    </h3>

    <p>

        Dicetak pada
        <?= date('d F Y H:i') ?>

    </p>

</div>

<?= $content ?>

<div class="report-footer">

    <p>

        Banjarmasin,
        <?= date('d F Y') ?>

    </p>

    <p>

        KEPALA DINAS

    </p>

    <div class="space"></div>

    <strong>

        SARTONO, S.Sos., MM

    </strong>

    <br>

    NIP. 19720804 199403 1 005

</div>

<script>

    window.onload = function(){

        window.print();

    };

</script>

</body>

</html>