<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tb_pembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'langganan_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tanggal_bayar' => [
                'type' => 'DATETIME',
            ],
            'status_pembayaran' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'bank_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_pembayaran', true);
        $this->forge->createTable('tb_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pembayaran');
    }
}
