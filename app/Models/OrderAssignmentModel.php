<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\StaffModel;
use App\Models\OrderModel;

class OrderAssignmentModel extends Model
{
    protected $table            = 'orderassignments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'staff_id',
        'status',
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
    protected $beforeUpdate = ['updateStatus'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function updateStatus(array $data)
    {
        // Ambil data dari database berdasarkan primary key (id)
        $assignment = $this->find($data['id']);

        // Jika waktu sekarang melewati estimated_arrival
        if (time() >= strtotime($assignment['estimated_arrival'])) {
            // Perbarui status
            $data['status'] = 'Arrived';
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
