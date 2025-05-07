<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DBSeederAll extends Seeder
{
    public function run()
    {
        $this->call('AdminSeeder');
        $this->call('UserProfileSeeder');
        $this->call('ProfileSeeder');
        $this->call('PaketLayananSeeder');
        $this->call('PortofolioSeeder');

    }
}
