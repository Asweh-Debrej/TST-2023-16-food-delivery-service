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
        'message' => 'Order ID ' . $id . ' not found',
      ]);
    }

    $data = [
      'message' => 'success',
      'data' => $order,
    ];

    return $this->response->setJSON($data);
  }

  public function apiGetStatus($id)
  {
    $order = $this->orderModel->find($id);

    if (!$order) {
      return $this->response->setStatusCode(404)->setJSON([
        'message' => 'Order ID ' . $id . ' not found',
      ]);
    }

    $data = [
      'message' => 'success',
      'data' => [
        'status' => $order['status'],
      ],
    ];

    return $this->response->setJSON($data);
  }

  public function apiCreate()
  {
    $data = $this->request->getJSON(true);

    $validation = \Config\Services::validation();
    $validation->setRules([
      'recipient' => 'required',
      'sender' => 'required',
      'address' => 'required',
      'phone_number' => 'required|numeric',
    ]);

    if (!$validation->run($data)) {
      return $this->response->setStatusCode(400)->setJSON([
        'message' => 'Bad Request',
        'error' => $validation->getErrors(),
      ]);
    }

    $data['total_amount'] = 5000; // hardcode total_amount

    $order = $this->orderModel->insert($data);

    $data = [
      'message' => 'order successfully created',
      'data' => $order,
    ];

    return $this->response->setStatusCode(201)->setJSON($data);
  }
}
