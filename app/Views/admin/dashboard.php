<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="mb-4">Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-grid"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear"></i> Mengelola Layanan</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-box"></i> Mengelola Paket</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-calendar-check"></i> Mengelola
                    Reservasi</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
            <div class="container-fluid">
                <span class="navbar-brand">Dashboard</span>
                <div class="dropdown">
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

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Today's Money</h5>
                    <h3>$53k</h3>
                    <span class="text-success">+55% than last week</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Today's Users</h5>
                    <h3>2300</h3>
                    <span class="text-success">+3% than last month</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Ads Views</h5>
                    <h3>3,462</h3>
                    <span class="text-danger">-2% than yesterday</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Sales</h5>
                    <h3>$103,430</h3>
                    <span class="text-success">+5% than yesterday</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>