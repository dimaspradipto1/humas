<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Diperbarui</title>
</head>

<body>
    <h3>Pengajuan Anda Telah Diperbarui</h3>

    <table class="table table-bordered table-striped">
        <tr>
            <td><strong>Nama Kegiatan</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td><strong>Status Pengajuan</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->status }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Mulai/Waktu:</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($pengajuan->tgl_awal)->locale('id')->format('d F Y') }} /
                {{ $pengajuan->jam_kegiatan }} WIB</td>
        </tr>
        <tr>
            <td><strong>Tanggal Selesai/Waktu:</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($pengajuan->tgl_selesai)->locale('id')->format('d F Y') }} /
                {{ $pengajuan->waktu_selesai }} WIB</td>
        </tr>
        <tr>
            <td><strong>Deskripsi Kegiatan:</strong></td>
            <td>:</td>
            <td>{{ strip_tags($pengajuan->deskripsi_kegiatan) }}</td>
        </tr>
        <tr>
            <td><strong>Berikut ini adalah Link Desain</strong></td>
            <td>:</td>
            <td>{{ $pengajuan->link_desain }}</td>
        </tr>
        <tr>
            <td>
                <a href="{{ route('login') }}"
                    style="display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; border-radius: 5px;">Silahkan
                    Login</a>
            </td>
        </tr>
    </table>

    <p>Hormat Kami,</p>
    <p>TIM HUMAS</p>
</body>

</html>
