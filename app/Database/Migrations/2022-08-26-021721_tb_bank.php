<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tb_bank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bank' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_bank' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'no_rekening' => [
                'type'       => 'INT',
                'constraint' => 30,
            ],
        ]);
        $this->forge->addKey('id_bank', true);
        $this->forge->createTable('tb_bank');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bank');
    }
}
