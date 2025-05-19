<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - {{ $gaji->karyawan->user->name }} -
        {{ \Carbon\Carbon::create(null, $gaji->bulan)->isoFormat('MMMM') }} {{ $gaji->tahun }}
    </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #2ec4b6;
            --info: #3f8efc;
            --warning: #f9c74f;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --gray-light: #f1f3f5;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            line-height: 1.6;
        }

        .salary-slip {
            max-width: 850px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }

        .slip-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .slip-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            pointer-events: none;
        }

        .slip-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .slip-header h2 {
            font-size: 18px;
            font-weight: 500;
            opacity: 0.9;
            letter-spacing: -0.3px;
        }

        .slip-header .company-logo {
            position: absolute;
            top: 20px;
            right: 30px;
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            z-index: 1;
        }

        .slip-content {
            padding: 30px;
        }

        .employee-info {
            background-color: rgba(67, 97, 238, 0.03);
            border-radius: 12px;
            border-left: 5px solid var(--primary);
            margin-bottom: 30px;
            padding: 20px;
        }

        .employee-info .row {
            margin-bottom: 10px;
        }

        .employee-info .row:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-weight: 600;
            color: var(--primary);
            border-bottom: 2px solid var(--gray-light);
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 18px;
        }

        .section-title i {
            margin-right: 10px;
            background-color: rgba(67, 97, 238, 0.1);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .detail-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            margin-bottom: 25px;
            overflow: hidden;
        }

        .detail-row {
            border-bottom: 1px dashed var(--gray-light);
            padding: 12px 20px;
            transition: all 0.2s ease;
        }

        .detail-row:hover {
            background-color: rgba(67, 97, 238, 0.02);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: 500;
            color: var(--gray-dark);
        }

        .value {
            font-weight: 600;
            color: var(--dark);
        }

        .total-row {
            background-color: rgba(67, 97, 238, 0.05);
            font-weight: 700;
            border-radius: 8px;
            padding: 15px 20px;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-left: 5px solid var(--primary);
        }

        .total-row .label {
            color: var(--primary-dark);
        }

        .total-row .value {
            font-size: 22px;
            color: var(--primary-dark);
        }

        .signature-area {
            border-top: 1px solid var(--gray-light);
            margin-top: 30px;
            padding-top: 30px;
        }

        .signature-block {
            text-align: center;
            padding: 0 15px;
        }

        .signature-block p {
            margin-bottom: 5px;
        }

        .signature-line {
            border-top: 1px solid var(--gray-dark);
            width: 80%;
            margin: 60px auto 10px;
        }

        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.03;
            font-size: 120px;
            transform: rotate(-45deg);
            pointer-events: none;
            color: var(--primary);
        }

        .btn-print {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 100;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-print i {
            margin-right: 6px;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code img {
            width: 100px;
            height: 100px;
        }

        .qr-code p {
            font-size: 12px;
            color: var(--gray);
            margin-top: 5px;
        }

        .note-box {
            background-color: rgba(67, 97, 238, 0.03);
            border-radius: 12px;
            padding: 15px;
            border-left: 3px solid var(--info);
            margin-bottom: 25px;
            font-style: italic;
            color: var(--gray-dark);
        }

        .note-box i {
            color: var(--info);
            margin-right: 8px;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .salary-slip {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }

            .btn-print {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .slip-header {
                padding: 20px;
            }

            .slip-header h1 {
                font-size: 22px;
            }

            .slip-header h2 {
                font-size: 16px;
            }

            .slip-content {
                padding: 20px;
            }

            .section-title {
                font-size: 16px;
            }

            .total-row .value {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="salary-slip">
            <button onclick="window.print()" class="btn btn-primary btn-print">
                <i class="fas fa-print"></i> Cetak Slip
            </button>

            <div class="slip-header">
                <div class="company-logo">
                    <i class="fas fa-building"></i>
                </div>
                <h1><i class="fas fa-file-invoice-dollar me-2"></i>SLIP GAJI KARYAWAN</h1>
                <h2>Periode: {{ \Carbon\Carbon::create(null, $gaji->bulan)->isoFormat('MMMM') }} {{ $gaji->tahun }}</h2>
            </div>

            <div class="slip-content">
                <div class="employee-info">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex flex-column">
                                <div class="mb-3">
                                    <span class="label d-block text-uppercase small">Nama Karyawan</span>
                                    <span class="value fs-5">{{ $gaji->karyawan->user->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="label d-block text-uppercase small">Posisi</span>
                                    <span class="value">{{ $gaji->karyawan->posisi }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <div class="mb-3">
                                    <span class="label d-block text-uppercase small">NIK</span>
                                    <span class="value">{{ $gaji->karyawan->nik }}</span>
                                </div>
                                <div>
                                    <span class="label d-block text-uppercase small">Tanggal Pembayaran</span>
                                    <span
                                        class="value">{{ $gaji->tanggal_pembayaran ? $gaji->tanggal_pembayaran->isoFormat('D MMMM YYYY') : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="section-title">
                    <i class="fas fa-money-bill-wave"></i>Rincian Gaji
                </h5>
                <div class="detail-card">
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Gaji Pokok</span>
                        <span class="value">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Total Hari Hadir</span>
                        <span class="value">{{ $gaji->total_hadir }} hari</span>
                    </div>
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Total Hari Izin</span>
                        <span class="value">{{ $gaji->total_izin }} hari</span>
                    </div>
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Total Hari Sakit</span>
                        <span class="value">{{ $gaji->total_sakit }} hari</span>
                    </div>
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Total Hari Tanpa Keterangan</span>
                        <span class="value">{{ $gaji->total_tanpa_keterangan }} hari</span>
                    </div>
                </div>

                <h5 class="section-title">
                    <i class="fas fa-minus-circle"></i>Potongan
                </h5>
                <div class="detail-card">
                    <div class="detail-row d-flex justify-content-between align-items-center">
                        <span class="label">Potongan Ketidakhadiran</span>
                        <span class="value text-danger">Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</span>
                    </div>
                    <!-- Tambahkan jenis potongan lain jika ada -->
                </div>

                <div class="total-row">
                    <span class="label">GAJI BERSIH (Take Home Pay)</span>
                    <span class="value">Rp {{ number_format($gaji->gaji_bersih, 0, ',', '.') }}</span>
                </div>

                @if($gaji->keterangan_gaji)
                    <div class="note-box">
                        <i class="fas fa-info-circle"></i>Keterangan: {{ $gaji->keterangan_gaji }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="signature-area row">
                            <div class="col-6 signature-block">
                                <p>Diterima oleh,</p>
                                <div class="signature-line"></div>
                                <p class="fw-bold">{{ $gaji->karyawan->user->name }}</p>
                            </div>
                            <div class="col-6 signature-block">
                                <p>Mengetahui/Disetujui oleh,</p>
                                <div class="signature-line"></div>
                                <p class="fw-bold">Admin / HRD</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="qr-code">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=ID:{{ $gaji->id }}_NIK:{{ $gaji->karyawan->nik }}_PERIODE:{{ $gaji->bulan }}/{{ $gaji->tahun }}"
                                alt="QR Code Verifikasi">
                            <p>Scan untuk verifikasi slip gaji</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="watermark">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>