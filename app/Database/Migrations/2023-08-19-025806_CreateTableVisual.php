<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableVisual extends Migration
{
    public function up()
    {
        //field table visual
        $this->forge->addField([
            'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_dataset'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'nama_file'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'link_visual'       => [
				'type'           => 'TEXT'
			],
			'id_user'       => [
				'type'           => 'INT',
				'constraint'     => 11
            ],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at	 DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

		$this->forge->addKey('id', true);
        $this->forge->createTable('table_visual');
    }

    public function down()
    {
        $this->forge->dropTable('table_visual');
    }
}
