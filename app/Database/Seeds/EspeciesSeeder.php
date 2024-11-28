<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EspeciesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre_comercial' => 'Laurel',
                'nombre_cientifico' => 'Cordia alliodora',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nombre_comercial' => 'Cedro Amargo',
                'nombre_cientifico' => 'Cedrela odorata',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nombre_comercial' => 'Pochote',
                'nombre_cientifico' => 'Bombacopsis quinata',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nombre_comercial' => 'Cenízaro',
                'nombre_cientifico' => 'Samanea saman',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('especies')->insertBatch($data);
    }
}