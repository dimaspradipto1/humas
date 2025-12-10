<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Baru Diajukan</title>
</head>

<body>
    <table class="table table-bordered table-striped">
        <tr>
            <td><strong>Pengajuan Baru</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Diajukan oleh:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Mulai/Waktu:</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($pengajuan->tgl_awal)->locale('id')->format('d F Y') }} / {{ $pengajuan->jam_kegiatan }} WIB</td>
        </tr>
        <tr>
            <td><strong>Tanggal Selesai/Waktu:</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($pengajuan->tgl_selesai)->locale('id')->format('d F Y') }} / {{ $pengajuan->waktu_selesai }} WIB</td>
        </tr>
        <tr>
            <td><strong>Deskripsi:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->deskripsi_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Unit Kegiatan:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->unit_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Tempat Kegiatan:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->tempat_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Perlengkapan:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->perlengkapan }}</td>
        </tr>
        <tr>
            <td><strong>Link Zoom:</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->link_zoom }}</td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('login') }}" style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; border-radius: 5px;">Silahkan Login</a>
            </td>
        </tr>
    </table>

</body>
</html>
