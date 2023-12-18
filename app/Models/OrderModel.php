<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model {
  protected $table = 'orders';
  protected $useTimestamps = true;
  protected $afterFind = ['afterFindHandler'];

  protected $allowedFields = [
    'recipient',
    'total_amount',
    'sender_name',
    'address',
    'phone_number',
  ];

  public function getDelivery() {
    return $this->belongsTo('App\Models\OrderAssignmentModel', 'id', 'order_id');
  }

  public function getStatus() {
    $assignment = $this->getDelivery()->first();
    if ($assignment) {
      return $assignment['status'];
    } else {
      return 'Processing';
    }
  }

  public function afterFindHandler($data) {
    $deliveryModel = new OrderAssignmentModel();
    $staffModel = new StaffModel();

    if ($data === null) {
      return $data;
    }

    if ($data['singleton']) {
      $assignment = $deliveryModel->findAssignmentByOrderId($data['id']);
      if ($assignment) {
        $data['data']['status'] = $assignment['status'];
        $data['data']['assigned_at'] = $assignment['created_at'];
        $data['data']['estimated_arrival'] = $assignment['estimated_arrival'];
        $data['data']['staff'] = $staffModel->find($assignment['staff_id'])['name'];
      } else {
        $data['data']['status'] = 'Processing';
        $data['data']['assigned_at'] = null;
        $data['data']['estimated_arrival'] = null;
        $data['data']['staff'] = null;
      }
    } else {
      foreach ($data['data'] as $key => $value) {
        $assignment = $deliveryModel->findAssignmentByOrderId($value['id']);
        if ($assignment) {
          $value['status'] = $assignment['status'];
          $value['assigned_at'] = $assignment['created_at'];
          $value['estimated_arrival'] = $assignment['estimated_arrival'];
          $value['staff'] = $staffModel->find($assignment['staff_id'])['name'];
        } else {
          $value['status'] = 'Processing';
          $value['assigned_at'] = null;
          $value['estimated_arrival'] = null;
          $value['staff'] = null;
        }
        $data['data'][$key] = $value;
      }
    }

    return $data;
  }

  public function store($data) {
    $this->insert($data);
    return $this->db->insertID();
  }
}
