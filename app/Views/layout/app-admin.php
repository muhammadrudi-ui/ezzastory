<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezzastory</title>
    <link rel="icon"href="<?= base_url('uploads/logo_tab/logo.png') ?>" type="image/png">
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #ffffff;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.minimized {
            width: 80px;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            padding-top: 10px;
        }

        .sidebar.minimized h4 {
            display: none;
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #343a40;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar .nav-link i {
            font-size: 1.3rem;
        }

        .sidebar.minimized .nav-link span {
            display: none;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #000000;
            color: #ffffff;
        }

        .sidebar-divider {
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }

        .sidebar-toggler {
            text-align: center;
            margin-top: 15px;
        }

        #sidebarToggle {
            width: 30px;
            height: 30px;
            background: #343a40;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Header */
        .navbar {
            height: 75px;
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            background: white;
            z-index: 900;
            transition: left 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .dropdown .btn-light {
            background-color: #f8f9fa;
            /* Warna default */
            color: #343a40;
            border: 1px solid #ccc;
            transition: background 0.3s, color 0.3s, border 0.3s;
        }

        .dropdown .btn-light:hover {
            background-color: #e0e0e0;
            color: #000;
            border-color: #bbb;
        }

        .dropdown .btn-light:focus,
        .dropdown .btn-light:active,
        .dropdown.show .btn-light {
            background-color: #d6d6d6;
            color: #000;
            border-color: #aaa;
            box-shadow: none;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #000;
            color: #fff;
        }

        .dropdown-menu .dropdown-item.active,
        .dropdown-menu .dropdown-item:active {
            background-color: #343a40;
            color: #fff;
        }

        /* Main Content */
        .content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f8f9fa;
            overflow-y: auto;
            height: calc(100vh - 60px);
            transition: margin-left 0.3s ease-in-out;
            margin-top: 55px;
        }

        .sidebar.minimized~.content {
            margin-left: 80px;
        }

        .sidebar.minimized~.navbar {
            left: 80px;
            width: calc(100% - 80px);
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .navbar {
                left: 0;
                width: 100%;
            }

            .content {
                margin-left: 0;
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
                <a class="nav-link active" href="<?= base_url('admin/dashboard') ?>">
                    <i class="bi bi-grid"></i> <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/ketersediaan-jadwal') ?>">
                    <i class="bi bi-calendar-check"></i> <span>Ketersediaan Jadwal</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/data-pemesanan/index') ?>">
                    <i class="bi bi-receipt"></i> <span>Data Pemesanan</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/profile-perusahaan/index') ?>">
                    <i class="bi bi-building"></i> <span>Profile Perusahaan</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/portofolio/index') ?>">
                    <i class="bi bi-collection"></i> <span>Portofolio</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/paket-layanan/index') ?>">
                    <i class="bi bi-box-seam"></i> <span>Paket Layanan</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/laporan-keuangan/index') ?>">
                    <i class="bi bi-cash-stack"></i> <span>Laporan Keuangan</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/data-pemesanan/riwayat') ?>">
                    <i class="bi bi-clock-history"></i> <span>Riwayat Pemesanan</span>
                </a>
            </li>
            <hr class="sidebar-divider" />
        </ul>

        <!-- Sidebar Toggler -->
        <div class="sidebar-toggler">
            <button id="sidebarToggle"><i class="bi bi-chevron-left"></i></button>
        </div>
    </div>


    <!-- Main Content -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3">
        <div class="container-fluid">
            <button class="btn btn-outline-dark d-md-none" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <?php
            $username = session('username');
    $displayName = strlen($username) > 8 ? substr($username, 0, 8) . '...' : $username;
    ?>

            <!-- Profile Admin -->
            <div class="dropdown ms-auto">
                <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <?= esc($displayName) ?> <i class="bi bi-person-circle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?= base_url('admin/profile') ?>">Profile</a></li> <!-- Update link ini -->
                    <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="content">
        <main>
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Sidebar Active -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let navLinks = document.querySelectorAll(".sidebar .nav-link");
            let currentUrl = window.location.href;

            navLinks.forEach(function(link) {
                link.classList.remove("active");

                // Get the href of the link
                let linkHref = link.getAttribute("href");

                // Check if the current URL starts with or contains the link's href
                // This accounts for dynamic segments or query parameters
                if (currentUrl.includes(linkHref) || linkHref === currentUrl) {
                    link.classList.add("active");
                }

                // Special case for dashboard (exact match or root)
                if (linkHref.includes("admin/dashboard") && 
                    (currentUrl.endsWith("admin/dashboard") || currentUrl.endsWith("/admin/"))) {
                    link.classList.add("active");
                }
            });

            // Toggler untuk mode desktop
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                let sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('minimized');
            });

            // Toggler untuk mode mobile
            document.getElementById('mobileSidebarToggle').addEventListener('click', function() {
                let sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                let sidebar = document.getElementById('sidebar');
                let toggleButton = document.getElementById('mobileSidebarToggle');

                if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>