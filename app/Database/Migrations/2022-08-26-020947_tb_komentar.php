<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tb_komentar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komentar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'berita_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'isi_komentar' => [
                'type' => 'TEXT',
            ],
            'tanggal_komentar' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_komentar', true);
        $this->forge->createTable('tb_komentar');
    }

    public function down()
    {
        $this->forge->dropTable('tb_komentar');
    }
}
