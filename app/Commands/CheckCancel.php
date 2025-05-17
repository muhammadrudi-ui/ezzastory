<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Controllers\PemesananController;

class CheckCancel extends BaseCommand
{
    protected $group = 'Pemesanan';
    protected $name = 'pemesanan:check-cancel';
    protected $description = 'Check and cancel expired reservations';

    public function run(array $params)
    {
        $controller = new PemesananController();
        $response = $controller->checkAndCancelExpiredReservations();
        CLI::write($response->getBody());
    }
}
