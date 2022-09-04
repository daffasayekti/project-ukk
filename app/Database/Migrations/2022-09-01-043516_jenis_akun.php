<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class jenis_akun extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jenis' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_jenis' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('id_jenis', true);
        $this->forge->createTable('jenis_akun');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_akun');
    }
}
