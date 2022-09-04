<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class kategori_berita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori_berita');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_berita');
    }
}
