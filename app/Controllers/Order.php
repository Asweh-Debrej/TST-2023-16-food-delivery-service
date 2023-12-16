<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderAssignmentModel;
use App\Models\StaffModel;

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
    if (!is_numeric($id)) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Order ID ' . $id . ' not found!');
    }

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

  public function apiGetSingle($id)
  {
    $order = $this->orderModel->find($id);

    if (!$order) {
      return $this->response->setStatusCode(404)->setJSON([
        'error' => 'Order ID ' . $id . ' not found',
      ]);
    }

    $data = [
      'title' => 'Order Detail | Drinks Store',
      'data' => $order,
    ];

    return $this->response->setJSON($data);
  }

  public function apiGetStatus($id)
  {
    $order = $this->orderModel->find($id);

    if (!$order) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Order ID ' . $id . ' not found!');
    }

    $data = [
      'title' => 'Order Detail | Drinks Store',
      'data' => [
        'status' => $order['status'],
      ],
    ];

    return $this->response->setJSON($data);
  }
}
