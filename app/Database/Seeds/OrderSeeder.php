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
        'customer_name' => 'Alice Johnson',
        'total_amount'  => '150.75',
        'status'        => 'Processing',
        'created_at'    => Time::now(),
        'updated_at'    => Time::now(),
      ],
      [
        'customer_name' => 'Bob Smith',
        'total_amount'  => '200.50',
        'status'        => 'Shipped',
        'created_at'    => Time::now(),
        'updated_at'    => Time::now(),
      ],
      [
        'customer_name' => 'Charlie Brown',
        'total_amount'  => '75.25',
        'status'        => 'Delivered',
        'created_at'    => Time::now(),
        'updated_at'    => Time::now(),
      ],
      [
        'customer_name' => 'David Miller',
        'total_amount'  => '120.00',
        'status'        => 'Completed',
        'created_at'    => Time::now(),
        'updated_at'    => Time::now(),
      ],
    ];

    // Using Query Builder
    $this->db->table('orders')->insertBatch($data);
  }
}
