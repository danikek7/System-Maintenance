<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Inspeksi PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #cce5ff;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h1>FORM INSPEKSI</h1>

    <div>
        <p><strong>Dibuat Pada:</strong>
            {{ $jadwal->create_at ? $jadwal->create_at->format('d F Y H:i') : '-' }}
        </p>
        <p><strong>Lokasi:</strong> {{ $detail->nama_location ?? '-' }}</p>
        <p><strong>Serial (Type):</strong> {{ $detail->asset->serial ?? '-' }}</p>
        <p><strong>Type Form:</strong> {{ $jadwal->typeInspeksi->nama ?? '-' }}</p>
    </div>

    <div class="section-title">Detail Inspeksi:</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Parameter</th>
                <th>Baik</th>
                <th>Buruk</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->indikator->nama ?? '-' }}</td>
                    <td style="text-align: center;">{{ $item->hasil_indikator == 1 ? '✓' : '' }}</td>
                    <td style="text-align: center;">{{ $item->hasil_indikator == 0 ? '✓' : '' }}</td>
                    <td>{{ $item->notes ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <br><br>
    <p style="text-align: right;">Tertanda,</p>
    <br><br><br>
    <p style="text-align: right;">_________________________</p> --}}

</body>

</html>
