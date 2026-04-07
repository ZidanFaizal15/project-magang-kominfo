<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Program Kegiatan</title>

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
            margin-bottom: 20px;
            text-decoration: underline;
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
            width: 180px;
            font-weight: bold;
        }

        .value {
            width: auto;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
            background: #f9f9f9;
        }

        .status {
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .selesai {
            color: green;
        }

        .proses {
            color: orange;
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
        SURAT PROGRAM KEGIATAN
    </div>

    <!-- DATA KEGIATAN -->
    <table>
        <tr>
            <td class="label">Nama Kegiatan</td>
            <td>: {{ $kegiatan->nama_kegiatan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Bidang</td>
            <td>: {{ $kegiatan->bidang?->nama_bidang ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kegiatan</td>
            <td>: {{ $kegiatan->jenis_kegiatan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Kegiatan</td>
            <td>: {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>:
                <span class="status {{ $kegiatan->status == 'Selesai' ? 'selesai' : 'proses' }}">
                    {{ $kegiatan->status ?? '-' }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="label">Target Laporan</td>
            <td>: {{ $kegiatan->target_laporan ?? 0 }} User</td>
        </tr>
    </table>

    <!-- DESKRIPSI -->
    <div style="margin-top: 20px;">
        <strong>Deskripsi Kegiatan:</strong>
        <div class="box">
            {!! nl2br(e($kegiatan->deskripsi)) !!}
        </div>
    </div>

    <!-- FOOTER -->
    <div class="ttd">
        <p>__________, {{ now()->format('d-m-Y') }}</p>
        <p><strong>Penanggung Jawab</strong></p>

        <br><br><br>

        <p>__________________________</p>
    </div>

</body>
</html>