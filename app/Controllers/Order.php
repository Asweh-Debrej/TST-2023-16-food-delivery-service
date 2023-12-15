<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Order extends BaseController
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

  public function show($id)
  {
    $order = $this->orderModel->find($id);

    if (!$order) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Order ID ' . $id . ' not found!');
    }

    $data = [
      'title' => 'Order Detail | Drinks Store',
      'order' => $order
    ];

    return view('order/detail', $data);
  }
}
