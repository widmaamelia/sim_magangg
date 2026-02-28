<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Magang - {{ $kelas }}</title>
    <style>
        /* CSS Murni untuk DomPDF */
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 18px;
        }

        .header h3 {
            margin: 5px 0 0 0;
            font-weight: normal;
            font-size: 14px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }

        td {
            padding: 8px;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .signature {
            float: right;
            width: 250px;
            text-align: center;
        }

        .signature-space {
            height: 80px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Daftar Nilai Magang Mahasiswa</h2>
        <h3>Program Studi Manajemen Informatika</h3>
        <strong>Kelas: {{ $kelas }}</strong>
    </div>

    <table class="info-table" style="border: none;">
        <tr style="border: none;">
            <td style="border: none; width: 15%;">Tanggal Cetak</td>
            <td style="border: none;">: {{ date('d F Y') }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIM</th>
                <th width="30%">Nama Mahasiswa</th>
                <th width="10%">Nilai</th>
                <th width="40%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $n)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $n->magang->mahasiswa->identity_number ?? '-' }}</td>
                    <td>{{ $n->magang->mahasiswa->name ?? 'User Tidak Ditemukan' }}</td>

                    {{-- PERBAIKAN: Ganti dari 'nilai' menjadi 'angka_nilai' --}}
                    <td class="text-center"><strong>{{ $n->angka_nilai }}</strong></td>

                    <td>{{ $n->keterangan ?? '-' }}</td>
                </tr>
            @empty
                {{-- ... --}}
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Padang, {{ date('d F Y') }}</p>
            <p>Dosen Pembimbing,</p>
            <div class="signature-space"></div>
            <p><strong>( {{ auth()->user()->name }} )</strong></p>
            <p>NIP. {{ auth()->user()->identity_number }}</p>
        </div>
    </div>

</body>

</html>
