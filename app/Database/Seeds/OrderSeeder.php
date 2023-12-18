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
        'sender_name'   => 'JANJI JIWA'
      ],
      [
        'recipient' => 'Bob Smith',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender_name'   => 'JANJI JIWA'
      ],
      [
        'recipient' => 'Charlie Brown',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender_name'   => 'JANJI JIWA'
      ],
      [
        'recipient' => 'David Miller',
        'total_amount'  => '5000',
        'created_at'    => Time::now(),
        'sender_name'   => 'JANJI JIWA'
      ],
    ];

    // Using Query Builder
    $this->db->table('orders')->insertBatch($data);
  }
}
