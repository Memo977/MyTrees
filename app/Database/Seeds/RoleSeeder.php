<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre' => 'Administrador',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Operador',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Amigo',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}