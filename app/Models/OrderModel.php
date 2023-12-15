<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table = 'orders';
  protected $useTimestamps = true;

  public function getOrderDetails($orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }
}
