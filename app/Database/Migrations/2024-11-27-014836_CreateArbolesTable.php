<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArbolesTable extends Migration
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
            'usuario_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'especie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'ubicacion_geografica' => [
                'type' => 'TEXT',
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'precio' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'tamanio' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'foto_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'fecha_venta' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('especie_id', 'especies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('arboles');
    }

    public function down()
    {
        //
    }
}