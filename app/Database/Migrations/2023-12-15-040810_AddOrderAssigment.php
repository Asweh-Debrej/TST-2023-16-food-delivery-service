<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderAssigment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'staff_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'estimated_arrival' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('staff_id', 'staffs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_assignment');
    }

    public function down()
    {
        $this->forge->dropTable('order_assignment');
    }
}
