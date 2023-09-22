<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUser extends Migration
{
    public function up()
    {
        //field table user
        $this->forge->addField([
            'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'username'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'id_role'      => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at	 DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

		$this->forge->addKey('id', true);
        $this->forge->createTable('table_user');
    }

    public function down()
    {
       $this->forge->dropTable('table_user');
    }
}
