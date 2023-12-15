<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\StaffModel;
use App\Models\OrderModel;
use PHPUnit\Util\Json;

class OrderAssignmentModel extends Model
{
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
    protected $afterFind      = ['setStatus'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function setStatus($data) {
        if (!isset($data['data']) || !isset($data['method']) || !isset($data['singleton'])) {
            for ($i = 0; $i < count($data); $i++) {
                if ($data[$i]['estimated_arrival'] < date('Y-m-d H:i:s')) {
                    $data[$i]['status'] = 'Completed';
                } else {
                    $data[$i]['status'] = 'Delivering';
                }
                print_r($data[$i]);
            }
        } else {
            if ($data['data']['estimated_arrival'] < date('Y-m-d H:i:s')) {
                $data['data']['status'] = 'Completed';
            } else {
                $data['data']['status'] = 'Delivering';
            }
        }

        return $data;
    }


    public function getStaff() {
        return $this->hasOne(StaffModel::class, 'id', 'staff_id');
    }

    public function getOrder() {
        return $this->hasOne(OrderModel::class, 'id', 'order_id');
    }
}
