<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderAssignmentModel;
use App\Models\StaffModel;

class OrderAssignment extends BaseController
{
    protected $modelName = 'App\Models\OrderAssignmentModel';
    protected $format    = 'json';

    public function index() {

    }

    public function create() {
        $validationRules = [
            'order_id' => 'required',
        ];

        $validationMessages = [
            'order_id' => [
                'required' => 'Order ID is required',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => $this->validator->getErrors(),
            ]);
        }

        if (isset($this->request->getPost()['staff_id'])) {
            throw new \CodeIgniter\Exceptions\ModelException('Staff ID is not allowed');
        }

        if (isset($this->request->getPost()['status'])) {
            throw new \CodeIgniter\Exceptions\ModelException('Status is not allowed');
        }

        if (isset($this->request->getPost()['created_at'])) {
            throw new \CodeIgniter\Exceptions\ModelException('Created At is not allowed');
        }

        if (isset($this->request->getPost()['estimated_arrival'])) {
            throw new \CodeIgniter\Exceptions\ModelException('Estimated Arrival is not allowed');
        }

        $orderId = $this->request->getJsonVar('order_id');

        $orderModel = new \App\Models\OrderModel();
        $order = $orderModel->find($orderId);
        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Order ID ' . $orderId . ' not found',
            ]);
        }

        $orderAssignmentModel = new OrderAssignmentModel();

        if ($orderAssignmentModel->findAssignmentByOrderId($orderId)) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Order ID ' . $orderId . ' is already assigned',
            ]);
        }

        $orderAssignment = $orderAssignmentModel->create([
            'order_id' => $orderId,
        ]);

        return $this->response->setJSON($orderAssignment);
    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function delete($id) {

    }

    public function info($id) {
        $orderAssignmentModel = new OrderAssignmentModel();
        $keys = [
            'id',
            'order_id',
            'status',
            'staff',
            'estimated_arrival',
        ];

        $orderAssignment = $orderAssignmentModel->find($id);

        if (!$orderAssignment) {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Order Assignment ID ' . $id . ' not found',
            ]);
        }

        $staffModel = new StaffModel();
        $staff = $staffModel->find($orderAssignment['staff_id']);

        $orderAssignment['staff'] = $staff['name'];

        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $orderAssignment[$key];
        }

        return $this->response->setJSON($data);
    }
}
