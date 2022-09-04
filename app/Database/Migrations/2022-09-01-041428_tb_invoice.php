<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class tb_invoice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'pembayaran_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('id_invoice', true);
        $this->forge->createTable('tb_invoice');
    }

    public function down()
    {
        $this->forge->dropTable('tb_invoice');
    }
}
