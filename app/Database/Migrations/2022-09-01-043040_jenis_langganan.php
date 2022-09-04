<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class jenis_langganan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_langganan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'jenis_langganan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga_langganan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_langganan', true);
        $this->forge->createTable('jenis_langganan');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_langganan');
    }
}
