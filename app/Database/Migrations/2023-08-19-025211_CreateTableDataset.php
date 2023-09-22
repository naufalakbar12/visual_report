<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDataset extends Migration
{
    public function up()
    {
        //field table dataset
        $this->forge->addField([
            'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_dataset'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'nama_file'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'deskripsi'       => [
				'type'           => 'TEXT'
			],
            'id_keterangan'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
            'id_user'       => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at	 DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

		$this->forge->addKey('id', true);
        $this->forge->createTable('table_dataset');
    }

    public function down()
    {
        $this->forge->dropTable('table_dataset');
    }
}
