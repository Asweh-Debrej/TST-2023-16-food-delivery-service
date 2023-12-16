<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\StaffModel;
use App\Models\OrderModel;
use PHPUnit\Util\Json;

class OrderAssignmentModel extends Model {
    protected $table            = 'order_assignment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'staff_id',
        'created_at',
        'estimated_arrival',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['afterFindHandler'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findAssignment($id) {
        return $this->where('id', $id)->first();
    }
    public function findAssignmentByOrderId($id) {
        return $this->where('order_id', $id)->first();
    }
    public function findAssignmentByStaffId($id) {
        return $this->where('staff_id', $id)->first();
    }
    public function create($input) {
        $orderModel = new OrderModel();
        $staffModel = new StaffModel();

        $fields = [
            'order_id',
            'staff_id',
            'estimated_arrival',
            'created_at',
        ];

        $order = $orderModel->find($input['order_id']);
        if (!$order) {
            throw new \CodeIgniter\Exceptions\ModelException('Order ID ' . $input['order_id'] . ' not found!');
        }

        $staffs = $staffModel->findAll();

        if (count($staffs) == 0) {
            $staffModel->fake();
            $staffs = $staffModel->findAll();
        }

        $staffIds = [];
        foreach ($staffs as $staff) {
            $staffIds[] = $staff['id'];
        }
        // find the staff who has the least estimated_arrival of latest order they have
        $staffId = null;
        $minEstimatedArrival = null;
        foreach ($staffIds as $id) {
            $assignment = $this->findAssignmentByStaffId($id);
            if ($assignment) {
                $order = $orderModel->find($assignment['order_id']);
                if ($order) {
                    if ($minEstimatedArrival == null) {
                        $minEstimatedArrival = $order['estimated_arrival'];
                        $staffId = $id;
                    } else {
                        if ($order['estimated_arrival'] < $minEstimatedArrival) {
                            $minEstimatedArrival = $order['estimated_arrival'];
                            $staffId = $id;
                        }
                    }
                }
            } else {
                $staffId = $id;
                break;
            }
        }

        $input['staff_id'] = $staffId;

        $time = rand(4, 8);
        $input['estimated_arrival'] = date('Y-m-d H:i:s', strtotime('+' . $time . ' minute'));
        $input['created_at'] = date('Y-m-d H:i:s');

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $input[$field];
        }

        $this->insert($data);
        return $this->find($this->insertID());
    }
    public function afterFindHandler($data) {
        $staffModel = new StaffModel();

        if (!isset($data['singleton'])) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['estimated_arrival'] < date('Y-m-d H:i:s')) {
                    $data[$i]['status'] = 'Completed';
                } else {
                    $data[$i]['status'] = 'Delivering';
                }
                $data[$i]['staff'] = $staffModel->find($data[$i]['staff_id'])['name'];
            }
        } else if ($data['data']) {
            if ($data['data']['estimated_arrival'] < date('Y-m-d H:i:s')) {
                $data['data']['status'] = 'Completed';
            } else {
                $data['data']['status'] = 'Delivering';
            }
            $data['data']['staff'] = $staffModel->find($data['data']['staff_id'])['name'];
        }

        return $data;
    }
}
