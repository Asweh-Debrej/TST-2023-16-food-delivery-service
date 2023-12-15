<?php

namespace App\Controllers;

use App\Models\OrderModel;

class ListOrder extends BaseController
{

  protected $orderModel;
  public function __construct()
  {
    $this->orderModel = new OrderModel();
  }

  public function index()
  {
    $orders = $this->orderModel->findAll();

    $data = [
      'title' => 'Orders | Drinks Store',
      'order' => $orders
    ];


    return view('order/index', $data);
  }
}
