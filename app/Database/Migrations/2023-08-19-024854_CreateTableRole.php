<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRole extends Migration
{
    public function up()
    {
        //field table sole
        $this->forge->addField([
            'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_role'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at	 DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

		$this->forge->addKey('id', true);
        $this->forge->createTable('table_role');
    }

    public function down()
    {
        $this->forge->dropTable('table_role');
    }
}
