<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StaffModel;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $data = StaffModel::fake(10);
        $this->db->table('staffs')->insertBatch($data);
    }
}
