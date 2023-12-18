<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrderSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'recipient' => 'Alice Johnson',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender'   => 'JANJI JIWA',
        'address'       => 'Jl. Jalan No. 1',
        'phone_number'  => '081234567890',
      ],
      [
        'recipient' => 'Bob Smith',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender'   => 'JANJI JIWA',
        'address'       => 'Jl. Jalan No. 2',
        'phone_number'  => '081234567890',
      ],
      [
        'recipient' => 'Charlie Brown',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender'   => 'JANJI JIWA',
        'address'       => 'Jl. Jalan No. 3',
        'phone_number'  => '081234567890',
      ],
      [
        'recipient' => 'David Miller',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender'   => 'JANJI JIWA',
        'address'       => 'Jl. Jalan No. 4',
        'phone_number'  => '081234567890',
      ],
    ];

    // Using Query Builder
    $this->db->table('orders')->insertBatch($data);
  }
}
