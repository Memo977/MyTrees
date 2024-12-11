<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nombre' => 'Administrador',
            'apellidos' => 'Principal',
            'email' => 'admin@sistema.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'rol_id' => 1,
            'direccion' => 'San Juan Ciudad Quesada, 375m noreste del antiguo Bar Bambú',
            'pais' => 'Costa Rica',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('usuarios')->insert($data);
    }
}