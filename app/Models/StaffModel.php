<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Factory;
use App\Models\OrderAssignmentModel;

class StaffModel extends Model
{
    protected $table            = 'staffs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
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
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public static function fake($count = 1)
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'name' => $faker->name,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        return $data;
    }

    public function getOrders() {
        return $this->hasMany(OrderAssignmentModel::class, 'staff_id', 'id');
    }
}
