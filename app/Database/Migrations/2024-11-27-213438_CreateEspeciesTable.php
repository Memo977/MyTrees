<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEspeciesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nombre_comercial' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nombre_cientifico' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('especies');
    }

    public function down()
    {
        //
    }
}