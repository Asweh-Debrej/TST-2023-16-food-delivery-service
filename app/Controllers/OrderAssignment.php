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

        $staffModel = new StaffModel();
        $staffs = $staffModel->findAll();

        if (count($staffs) == 0) {
            $staffs = $staffModel->fake();
        }

        $staffIds = [];
        foreach ($staffs as $staff) {
            $staffIds[] = $staff['id'];
        }

        $staffId = array_rand($staffIds);


        $orderAssignmentModel = new OrderAssignmentModel();

        $orderAssignment = $orderAssignmentModel->insert([
            'order_id' => $this->request->getJsonVar('order_id'),
            'staff_id' => $staffId,
            'created_at' => date('Y-m-d H:i:s'),
            'estimated_arrival' => date('Y-m-d H:i:s', strtotime('+10 minute')),
        ]);

        return $this->response->setJSON($orderAssignmentModel->find($orderAssignment));
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
