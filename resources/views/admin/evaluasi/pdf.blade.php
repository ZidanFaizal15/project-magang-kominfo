<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Evaluasi Kegiatan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .title { text-align: center; font-weight: bold; font-size: 18px; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>

<div class="title">
    LAPORAN EVALUASI KEGIATAN
</div>

<div class="content">
    <p><strong>Nama Kegiatan:</strong> {{ $evaluasi->kegiatan->nama_kegiatan }}</p>
    <p><strong>Bidang:</strong> {{ $evaluasi->kegiatan->bidang->nama_bidang }}</p>
    <p><strong>Status Pencapaian:</strong> {{ $evaluasi->status_pencapaian }}</p>

    <p><strong>Catatan Evaluasi:</strong></p>
    <p>{{ $evaluasi->catatan }}</p>

    <br><br>

    <p>Dicetak pada: {{ now()->format('d-m-Y') }}</p>
</div>

</body>
</html>