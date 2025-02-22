<?= $this->extend('layout/app-admin') ?>

<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan Jadwal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .calendar-container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-table th,
        .calendar-table td {
            text-align: center;
            vertical-align: middle;
            height: 100px;
        }

        .reservation {
            background: #e0e0e0;
            border-radius: 5px;
            padding: 3px 10px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="calendar-container">
            <div class="calendar-header">
                <h2 class="fw-bold">Ketersediaan Jadwal</h2>
                <div>
                    <button class="btn btn-outline-secondary">&#10094;</button>
                    <button class="btn btn-outline-secondary">&#10095;</button>
                    <button class="btn btn-outline-secondary">📅</button>
                </div>
            </div>
            <table class="table table-bordered calendar-table">
                <thead class="table-light">
                    <tr>
                        <th>Minggu</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="reservation">Reservation</span></td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td><span class="reservation">Reservation</span></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td><span class="reservation">Reservation</span></td>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                    </tr>
                    <tr>
                        <td>29</td>
                        <td>30</td>
                        <td><span class="reservation">Reservation</span></td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

<?= $this->endSection() ?>