<?php
include 'koneksi.php';
session_start();
if ($_SESSION['status'] != "login") { header("location:login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring PJU - Realtime</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Style tetap sama dengan tambahan untuk filter-box */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #0f172a; color: white; padding: 40px; display: flex; justify-content: center; min-height: 100vh; }
        .monitor-card { background: #1e293b; padding: 30px; border-radius: 24px; width: 100%; max-width: 900px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        h2 { border-left: 4px solid #6366f1; padding-left: 15px; font-size: 24px; }
        
        /* Dropdown Style */
        .filter-box { margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        select { background: #334155; color: white; border: none; padding: 8px 15px; border-radius: 8px; outline: none; cursor: pointer; }
        
        table { width: 100%; border-collapse: collapse; background: #0f172a; border-radius: 15px; overflow: hidden; }
        th { background: #334155; color: #94a3b8; padding: 15px; text-align: left; font-size: 12px; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #1e293b; font-size: 14px; color: #cbd5e1; }
        
        .badge-terang { color: #22c55e; font-weight: 600; }
        .badge-redup { color: #38bdf8; font-weight: 600; }
        .badge-mati { color: #ef4444; font-weight: 600; }
    </style>
</head>
<body>
    <div class="monitor-card">
        <div class="header">
            <h2>Log Aktivitas Sensor</h2>
            <a href="index.php" style="color: #94a3b8; text-decoration: none; font-size: 14px;">← Kembali</a>
        </div>

        <div class="filter-box">
            <span>Pilih Perangkat:</span>
            <select id="pilih-pju" onchange="resetDanUpdate()">
                <option value="PJU01">PJU Unit 1</option>
                <option value="PJU02">PJU Unit 2</option>
                <option value="PJU03">PJU Unit 3</option>
            </select>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>ID Alat</th>
                    <th>Status Sensor</th>
                    <th>Jarak Objek</th>
                    <th>Kondisi Lampu</th>
                </tr>
            </thead>
            <tbody id="isi-tabel"></tbody>
        </table>
    </div>

    <script>
        let idTerakhir = 0;
        let pjuAktif = "PJU01";

        function resetDanUpdate() {
            pjuAktif = document.getElementById('pilih-pju').value;
            idTerakhir = 0; // Reset agar memuat ulang data untuk PJU yang baru dipilih
            document.getElementById('isi-tabel').innerHTML = ''; // Kosongkan tabel sementara
            updateTabel();
        }

        function updateTabel() {
            // Mengirim parameter ?id= ke PHP
            fetch(`ambil_data.php?device=${pjuAktif}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        if (parseInt(data[0].id) > idTerakhir) {
                            idTerakhir = parseInt(data[0].id);
                            renderData(data);
                        }
                    } else {
                        document.getElementById('isi-tabel').innerHTML = '<tr><td colspan="5" style="text-align:center;">Tidak ada data untuk perangkat ini</td></tr>';
                    }
                });
        }

        function renderData(data) {
            const tbody = document.getElementById('isi-tabel');
            let html = '';
            data.forEach(row => {
                let statusPIR = (row.pir == 1) ? 'Ada Gerakan' : 'Aman';
                let valLamp = row.Lamp_status || row.lamp_status || '0';
                let labelLampu = (valLamp == "100") ? '<span class="badge-terang">TERANG</span>' : 
                                 (valLamp == "30") ? '<span class="badge-redup">REDUP</span>' : 
                                 '<span class="badge-mati">MATI</span>';
                
                html += `<tr>
                    <td>${row.created_at.substr(11, 8)}</td>
                    <td><strong>${row.device_id}</strong></td>
                    <td>${statusPIR}</td>
                    <td>${row.distance} cm</td>
                    <td>${labelLampu}</td>
                </tr>`;
            });
            tbody.innerHTML = html;
        }

        setInterval(updateTabel, 2000);
        updateTabel();
    </script>
</body>
</html>