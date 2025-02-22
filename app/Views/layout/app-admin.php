<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ezzastory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #ffffff;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar .nav-item {
            margin-bottom: 15px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #343a40;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.8s ease-in-out;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: #000000;
            color: #ffffff;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }

        /* Untuk layar mobile */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                z-index: 1000;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4>Ezzastory</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/dashboard"><i class="bi bi-grid"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ketersediaan-jadwal"><i class="bi bi-calendar"></i> Ketersediaan
                    Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile-perusahaan"><i class="bi bi-building"></i> Profile Perusahaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-box"></i> Layanan & Paket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-journal"></i> Data Pemesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-file-earmark-bar-graph"></i> Laporan Keuangan</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
            <div class="container-fluid">
                <!-- Toggler hanya muncul di mobile -->
                <button class="btn btn-outline-dark d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="dropdown ms-auto">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown">
                        Admin1 <i class="bi bi-person-circle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            let sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });

        // Menutup sidebar ketika pengguna mengklik di luar sidebar
        document.addEventListener('click', function (event) {
            let sidebar = document.getElementById('sidebar');
            let toggleButton = document.getElementById('sidebarToggle');

            if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let sidebarLinks = document.querySelectorAll(".sidebar .nav-link");
            let currentPath = window.location.pathname;

            sidebarLinks.forEach(link => {
                if (link.getAttribute("href") === currentPath) {
                    link.classList.add("active");
                    link.style.background = "#000000";
                    link.style.color = "#ffffff";
                }
            });
        });
    </script>

</body>

</html>