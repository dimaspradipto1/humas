<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kop Surat Universitas Ibnu Sina</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            float: left;
            width: 100px;
            margin-right: 10px;
        }

        .kop-surat h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            color: green;
        }

        .kop-surat h2 {
            font-size: 36px;
            margin: 0;
            color: green;
        }

        .kop-surat h3 {
            font-size: 24px;
            margin: 0;
            color: red;
        }

        .kop-surat p {
            font-size: 16px;
            margin: 5px 0;
            color: black;
            margin-left: 110px;
        }

        .kop-surat .contact-info {
            margin-top: 5px;
            font-size: 14px;
        }

        .kop-surat hr {
            border: none;
            border-top: 3px solid green;
            margin: 2px 0;
        }

        .kop-surat hr.thin {
            border-top: 1px solid green;
        }

        .letter-header {
            width: 100%;
            margin: 20px auto;
            text-align: center;
            text-transform: uppercase;
        }

        .letter-header h3,
        .letter-header h4 {
            margin: 0;
        }

        .letter-header h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .letter-header h4 {
            font-size: 14px;
        }

        .subject {
            margin-top: 20px;
            font-weight: bold;
        }

        .content {
            margin-top: 20px;
            text-align: justify;
        }

        .table-container {
    width: 100%;
    margin-top: 20px;
    text-align: center;
}

.laporan-table {
    width: 80%;
    border: 2px solid #000;
    border-collapse: collapse;
    margin: 0 auto;
}

.laporan-table th, .laporan-table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

.laporan-table td a {
    color: #007bff;
    text-decoration: none;
}

.laporan-table td a:hover {
    text-decoration: underline;
}


        .footer {
            margin-top: 40px;
        }

        .signature-section {
            margin-top: 40px;
            position: relative;
            width: 100%;
            height: 150px;
            text-align: left;
        }

        .signature-section img.stamp {
            width: 230px;
            opacity: 1;
            position: relative;
            margin-left: -130px;
            margin-top: -20px;
        }

        .signature-section img.cap {
            width: 150px;
            opacity: 1;
            position: relative;
            margin-left: -80px;
            margin-top: -30px;
            margin-bottom: -10px;
        }

        .signature-section .text {
            position: absolute;
            top: 20px;
            right: 0;
            text-align: left;
        }

        .signature-section .text p {
            margin: 0;
            font-size: 14px;
        }

        .signature-section .text strong {
            font-size: 14px;
            margin-bottom: 200px;
        }

        .footer {
            font-size: 14px;
        }

        .signature-section .tembusan {
            float: left;
            /* Tembusan di sebelah kiri */
            margin-left: 0;
            /* Menjaga tembusan di tepi kiri */
            text-align: left;
            /* Text di-align ke kiri */
        }
    </style>

</head>

<body onload="window.print()">


    <!-- Kop Surat Section -->
    <div class="kop-surat">
        <!-- Logo Universitas Ibnu Sina -->
        <img src="{{ asset('volt/assets/img/surat/logouis.png') }}" alt="Logo Universitas Ibnu Sina">

        <!-- Informasi Universitas -->
        <div class="text-center">
            <h1>YAYASAN PENDIDIKAN IBNU SINA BATAM (YAPISTA)</h1>
            <h2>UNIVERSITAS IBNU SINA (UIS)</h2>
            <p>Jalan Teuku Umar, Lubuk Baja Kota Batam Indonesia Telp. 0778 425391</p>
            <p>Email: info@uis.ac.id/uisibnusina@gmail.com Website: uis.ac.id</p>
        </div>

        <!-- Garis Pembatas -->
        <hr>
        <hr class="thin">
    </div>

    <!-- Letter Content Section -->

    <div class="letter-header">
        <h3 class="text-uppercase">laporan kegiatan humas dan publikasi</h3>
        <h4>periode 2024-2025 Gasal</h4>
        <h4>universitas ibnu sina</h4>
    </div>


    <div class="table-container">
        <table id="laporanPublikasi-table" class="laporan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun Akademik</th>
                    <th>Fakultas</th>
                    <th>Nama Kegiatan</th>
                    <th>Link Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>tahun_akademik</td>
                    <td>fakultas</td>
                    <td>nama_kegiatan</td>
                    <td>
                        <a href="#" target="_blank">link dokumen</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>




    <!-- Signature Section with Stamp -->
    <div class="signature-section">
        <div class="text" style="text-align: left; margin-top: 20px;">
            <p style="margin: 0;">Batam, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p style="margin: 0;">Kabit Humas dan Publikasi</p>
            <div
                style="display: flex; flex-direction: column; justify-content: left; align-items: center; margin-top: 15px;">

                <!-- Cap and Signature -->
                <div style="display: flex; justify-content: center; align-items: center; margin-bottom: -10px;">
                    <img src="{{ asset('volt/assets/img/surat/sanusi.png') }}" alt="Tanda Tangan" class="stamp"
                        style="width: 250px; position: absolute; z-index: 1; margin-top: 40px;">
                    {{-- <img src="{{ asset('volt/assets/img/surat/cap_fst.png') }}" alt="Stempel" class="cap"
                        style="width: 110px; position: absolute; left: 40px; top: 50px; opacity: 0.8; z-index: 0;"> --}}
                </div>

                <!-- Name and NIP -->
                <div style="display: flex; align-items: center; text-align: left; margin-top: 80px;">
                    <!-- paraf dekan II -->
                    {{-- <img src="{{ asset('volt/assets/img/surat/okta.png') }}" alt="Paraf" class="paraf"
                        style="width: 15px; margin-right: 5px; margin-left: -30px"> --}}

                    <!-- nama dekan -->
                    <div>
                        <p style="margin: 0; font-weight: bold; text-decoration: underline;">Andi Akbar, SE., MM
                        </p>
                        <p style="margin: 0;">NUP. 777 0707 688</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Tembusan:</p>
        <p style="margin-left: 25px; margin-bottom: 30px;">- Arsip</p>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Array nama bulan dalam bahasa Indonesia
            var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober",
                "November", "Desember"
            ];

            // Mendapatkan tanggal saat ini
            var tanggalSekarang = new Date();
            var tanggal = tanggalSekarang.getDate();
            var namaBulan = bulan[tanggalSekarang.getMonth()];
            var tahun = tanggalSekarang.getFullYear();

            // Format tanggal: Batam, 07 November 2023
            var tanggalIndonesia = `Batam, ${tanggal} ${namaBulan} ${tahun}`;

            // Menyisipkan tanggal ke dalam elemen dengan id 'tanggal'
            document.getElementById("tanggal").textContent = tanggalIndonesia;
        });
    </script>

</body>

</html>
