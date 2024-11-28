<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActualizacionesArbolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'arbol_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tamanio_actual' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'      => true,
            ],
            'fecha_actualizacion' => [
                'type' => 'DATETIME',
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
        $this->forge->addForeignKey('arbol_id', 'arboles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('actualizaciones_arboles');
    }

    public function down()
    {
        //
    }
}