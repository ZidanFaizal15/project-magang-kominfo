<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        .header {
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
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

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
            background: #f9f9f9;
            line-height: 1.6;
        }

        .image-box {
            margin-top: 10px;
            text-align: center;
        }

        .image-box img {
            max-width: 400px;
            border: 1px solid #ccc;
            padding: 5px;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .ttd {
            text-align: right;
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>DINAS KOMUNIKASI DAN INFORMATIKA</h2>
        <p>Kabupaten Temanggung</p>
        <p>Sistem Monitoring Kegiatan</p>
    </div>

    <div class="line"></div>

    <!-- TITLE -->
    <div class="title">
        LAPORAN KEGIATAN
    </div>

    <!-- DATA -->
    <table>
        <tr>
            <td class="label">Nama Kegiatan</td>
            <td>: {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Bidang</td>
            <td>: {{ $laporan->kegiatan->bidang->nama_bidang ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Pelapor</td>
            <td>: {{ $laporan->user->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal</td>
            <td>: {{ $laporan->created_at->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    <!-- ISI -->
    <div style="margin-top: 20px;">
        <strong>Isi Laporan:</strong>
        <div class="box">
            {{ $laporan->isi_laporan }}
        </div>
    </div>

    <!-- DOKUMENTASI -->
    @if($laporan->dokumentasi)
        <div style="margin-top: 20px;">
            <strong>Dokumentasi:</strong>
            <div class="image-box">
                <img src="{{ public_path('storage/'.$laporan->dokumentasi) }}">
            </div>
        </div>
    @endif

    <!-- FOOTER -->
    <div class="ttd">
        <p>
            {{ $laporan->kegiatan->bidang->lokasi ?? 'Temanggung' }},
            {{ now()->format('d-m-Y') }}
        </p>
        <p><strong>Pelapor</strong></p>

        <br><br><br>

        <p><strong>{{ $laporan->user->name }}</strong></p>
    </div>

</body>
</html>