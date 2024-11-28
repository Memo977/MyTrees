<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nombre' => 'admin',
            'email' => 'admin@sistema.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'rol_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('usuarios')->insert($data);
    }
}