<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Evaluasi Kegiatan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 2px 0;
            font-size: 12px;
        }

        .line {
            border-top: 2px solid black;
            margin: 10px 0 20px;
        }

        .section {
            margin-bottom: 15px;
        }

        .label {
            width: 180px;
            display: inline-block;
            font-weight: bold;
        }

        .value {
            display: inline-block;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
            background: #f9f9f9;
        }

        .status {
            padding: 5px 10px;
            display: inline-block;
            font-weight: bold;
            border-radius: 4px;
        }

        .tercapai {
            background: #d4edda;
            color: #155724;
        }

        .belum {
            background: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>LAPORAN EVALUASI KEGIATAN</h2>
        <p>Sistem Monitoring Kegiatan Diskominfo</p>
    </div>

    <div class="line"></div>

    <!-- INFORMASI KEGIATAN -->
    <div class="section">
        <span class="label">Nama Kegiatan</span>:
        <span class="value">{{ $evaluasi->kegiatan->nama_kegiatan }}</span>
    </div>

    <div class="section">
        <span class="label">Bidang</span>:
        <span class="value">{{ $evaluasi->kegiatan->bidang->nama_bidang }}</span>
    </div>

    <div class="section">
        <span class="label">Status Pencapaian</span>:
        <span class="status {{ $evaluasi->status_pencapaian == 'Tercapai' ? 'tercapai' : 'belum' }}">
            {{ $evaluasi->status_pencapaian }}
        </span>
    </div>

    <!-- CATATAN -->
    <div class="section">
        <span class="label">Catatan Evaluasi</span>
        <div class="box">
            {{ $evaluasi->catatan }}
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak pada: {{ now()->format('d-m-Y') }}
    </div>

</body>
</html>