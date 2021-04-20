<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrangMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_orang'	=> [
					'type'			=> 'INT',
					'constraint'	=> 11,
					'unsigned'		=> true,
					'auto_increment'=> true,
			],
			'nama'		=> [
					'type'			=> 'VARCHAR',
					'constraint'	=> '255',
			],
			'alamat'	=> [
					'type'			=> 'TEXT',
					'constraint'	=> '225',
			],
			'created_at' => [
					'type'			=> 'DATETIME',
					'null'			=> true
			],
			'updated_at' => [
					'type'			=> 'DATETIME',
					'null'			=> true
			]
		]);
		$this->forge->addKey('id_orang', true);
		$this->forge->createTable('tb_orang');
	}

	public function down()
	{
		$this->forge->dropTable('blog');
	}
}