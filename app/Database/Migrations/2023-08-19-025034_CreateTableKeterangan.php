<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKeterangan extends Migration
{
    public function up()
    {
        //field table keterangan
        $this->forge->addField([
            'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_keterangan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at	 DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

		$this->forge->addKey('id', true);
        $this->forge->createTable('table_keterangan');
    }

    public function down()
    {
        $this->forge->dropTable('table_keterangan');
    }
}
