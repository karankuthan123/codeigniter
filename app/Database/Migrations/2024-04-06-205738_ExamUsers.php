<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExamUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'exam_id' => ['type' => 'INT', 'usigned'=>true, 'constraint' => 5, 'unsigned' => true,],
            'user_id' => ['type' => 'INT', 'usigned'=>true, 'constraint' => 5, 'unsigned' => true,],
            'state' => ['type' => 'ENUM("iptal","beklemede","onaylandı")',
            'default' => 'beklemede',
            'null' => FALSE],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('exam_id', 'exams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('exam_users');
    }

    public function down()
    {
        $this->forge->dropTable('exam_users');
    }
}
