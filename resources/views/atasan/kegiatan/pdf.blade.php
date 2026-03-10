<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Program Kegiatan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 12px;
        }
        .label {
            font-weight: bold;
        }
        hr {
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="title">
    SURAT PROGRAM KEGIATAN
</div>

<hr>

<div class="section">
    <span class="label">Nama Kegiatan:</span><br>
    {{ $kegiatan->nama_kegiatan ?? '-' }}
</div>

<div class="section">
    <span class="label">Bidang:</span><br>
    {{ $kegiatan->bidang?->nama_bidang ?? '-' }}
</div>

<div class="section">
    <span class="label">Jenis Kegiatan:</span><br>
    {{ $kegiatan->jenis_kegiatan ?? '-' }}
</div>

<div class="section">
    <span class="label">Tanggal Kegiatan:</span><br>
    {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->format('d-m-Y') }}
</div>

<div class="section">
    <span class="label">Status:</span><br>
    {{ $kegiatan->status ?? '-' }}
</div>

<hr>

<div class="section">
    <span class="label">Deskripsi Kegiatan:</span><br><br>
    {!! nl2br(e($kegiatan->deskripsi)) !!}
</div>

</body>
</html>