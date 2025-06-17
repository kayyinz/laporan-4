<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Agus">
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="202332xxx">
                    </div>
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['proses'])) {
                    $nama = trim($_POST['nama']);
                    $nim = trim($_POST['nim']);
                    $kehadiran = trim($_POST['kehadiran']);
                    $tugas = trim($_POST['tugas']);
                    $uts = trim($_POST['uts']);
                    $uas = trim($_POST['uas']);

                    if ($nama === "" || $nim === "") {
                        echo "<div class='alert alert-danger mt-3'>Kolom NIM dan Nama harus diisi</div>";
                    } elseif ($kehadiran === "" || $tugas === "" || $uts === "" || $uas === "") {
                        echo "<div class='alert alert-danger mt-3'>Seluruh kolom harus terisi</div>";
                    } else {
                        $kehadiran = (int)$kehadiran;
                        $tugas = (int)$tugas;
                        $uts = (int)$uts;
                        $uas = (int)$uas;

                        $nilaiAkhir = ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);

                        if ($nilaiAkhir >= 85) {
                            $grade = "A";
                        } elseif ($nilaiAkhir >= 70) {
                            $grade = "B";
                        } elseif ($nilaiAkhir >= 55) {
                            $grade = "C";
                        } elseif ($nilaiAkhir >= 40) {
                            $grade = "D";
                        } else {
                            $grade = "E";
                        }

                        if ($kehadiran <= 70) {
                            $status = "TIDAK LULUS";
                        } elseif ($nilaiAkhir >= 60 && $tugas >= 40 && $uts >= 40 && $uas >= 40) {
                            $status = "LULUS";
                        } else {
                            $status = "TIDAK LULUS";
                        }

                        $warnaCard = ($status == "LULUS") ? "success" : "danger";
                        $warnaTombol = ($status == "LULUS") ? "btn-success" : "btn-danger";

                        echo "
                        <div class='card border-$warnaCard mt-4'>
                            <div class='card-header bg-$warnaCard text-white'>
                                <strong>Hasil Penilaian</strong>
                            </div>
                            <div class='card-body'>
                                <div class='row text-center mb-4'>
                                    <div class='col'>
                                        <h2 class='fw-bold mb-0'>Nama: $nama</h2>
                                    </div>
                                    <div class='col'>
                                        <h2 class='fw-bold mb-0'>NIM: $nim</h2>
                                    </div>
                                </div>
                                <p><strong>Nilai Kehadiran:</strong> $kehadiran%</p>
                                <p><strong>Nilai Tugas:</strong> $tugas</p>
                                <p><strong>Nilai UTS:</strong> $uts</p>
                                <p><strong>Nilai UAS:</strong> $uas</p>
                                <p><strong>Nilai Akhir:</strong> " . number_format($nilaiAkhir, 2) . "</p>
                                <p><strong>Grade:</strong> $grade</p>
                                <p><strong>Status:</strong> <span class='fw-bold'>$status</span></p>
                            </div>
                        </div>
                        <div class='d-grid mt-3'>
                            <button class='btn $warnaTombol w-100' onclick='redirectToForm()'>Selesai</button>
                        </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function redirectToForm() {
            window.location.href = window.location.pathname;
        }
    </script>
</body>
</html>
