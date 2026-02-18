<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan</title>
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
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        img {
            margin-top: 10px;
            width: 300px;
        }
        hr {
            margin: 15px 0;
        }
    </style>
</head>
<body>

<div class="title">
    LAPORAN KEGIATAN
</div>

<hr>

<div class="section">
    <span class="label">Nama Kegiatan:</span><br>
    {{ $laporan->kegiatan->nama_kegiatan ?? '-' }}
</div>

<div class="section">
    <span class="label">Pelapor:</span><br>
    {{ $laporan->user->name ?? '-' }}
</div>

<div class="section">
    <span class="label">Tanggal:</span><br>
    {{ $laporan->created_at->format('d-m-Y H:i') }}
</div>

<hr>

<div class="section">
    <span class="label">Isi Laporan:</span><br><br>
    {{ $laporan->isi_laporan }}
</div>

@if($laporan->dokumentasi)
<hr>
<div class="section">
    <span class="label">Dokumentasi:</span><br>
    <img src="{{ public_path('storage/'.$laporan->dokumentasi) }}">
</div>
@endif

</body>
</html>
