<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT','usigned'=>true, 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'examName' => ['type' => 'VARCHAR', 'constraint' => 200],
            'examRole' => ['type' => 'ENUM("teknisyen","tekniker","mühendis","yüksek mühendis")',
            'default' => 'teknisyen',
            'null' => FALSE],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('exams');
    }

    public function down()
    {
        $this->forge->dropTable('exams');
    }
}
