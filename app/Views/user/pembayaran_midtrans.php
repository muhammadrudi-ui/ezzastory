<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - <?= esc($pemesanan['nama_paket']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= esc($clientKey) ?>"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Pembayaran <?= esc($pembayaran['jenis']) ?></h4>
            </div>
            <div class="card-body">
                <h5>Paket: <?= esc($pemesanan['nama_paket']) ?></h5>
                <p>Jenis Layanan: <?= esc($pemesanan['jenis_layanan'] ?? 'Event Lainnya') ?></p>
                <p>Jumlah: Rp <?= number_format($pembayaran['jumlah'], 0, ',', '.') ?></p>
                <p>Status: <span class="badge bg-warning"><?= esc($pembayaran['status']) ?></span></p>
                <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pay-button').onclick = function() {
            snap.pay('<?= esc($snapToken) ?>', {
                onSuccess: function(result) {
                    window.location.href = '<?= base_url('user/pembayaran/finish') ?>?order_id=<?= esc($pembayaran['order_id']) ?>&transaction_status=settlement';
                },
                onPending: function(result) {
                    window.location.href = '<?= base_url('user/pembayaran/finish') ?>?order_id=<?= esc($pembayaran['order_id']) ?>&transaction_status=pending';
                },
                onError: function(result) {
                    window.location.href = '<?= base_url('user/pembayaran/finish') ?>?order_id=<?= esc($pembayaran['order_id']) ?>&transaction_status=error';
                },
                onClose: function() {
                    window.location.href = '<?= base_url('user/reservasi?tab=pembayaran') ?>';
                }
            });
        };
    </script>
</body>
</html>