<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    public $serverKey;
    public $clientKey;
    public $isProduction = false;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        $this->isProduction = (env('CI_ENVIRONMENT') === 'production');
    }
}
