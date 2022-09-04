<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tb_berita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berita' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'judul_berita' => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'isi_berita' => [
                'type' => 'TEXT',
            ],
            'gambar_berita' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
            ],
            'tanggal_buat' => [
                'type' => 'DATETIME',
            ],
            'tanggal_update' => [
                'type' => 'DATETIME',
            ],
            'banyak_dilihat' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status_berita' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_berita', true);
        $this->forge->createTable('tb_berita');
    }

    public function down()
    {
        $this->forge->dropTable('tb_berita');
    }
}
