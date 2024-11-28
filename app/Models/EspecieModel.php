<?php

namespace App\Models;

use CodeIgniter\Model;

class EspecieModel extends Model
{
    protected $table = 'especies';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nombre_comercial', 'nombre_cientifico'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'nombre_comercial' => 'required|min_length[3]|max_length[100]',
        'nombre_cientifico' => 'required|min_length[3]|max_length[100]'
    ];
    
    protected $validationMessages = [
        'nombre_comercial' => [
            'required' => 'El nombre comercial es obligatorio',
            'min_length' => 'El nombre comercial debe tener al menos 3 caracteres',
            'max_length' => 'El nombre comercial no puede exceder los 100 caracteres'
        ],
        'nombre_cientifico' => [
            'required' => 'El nombre científico es obligatorio',
            'min_length' => 'El nombre científico debe tener al menos 3 caracteres',
            'max_length' => 'El nombre científico no puede exceder los 100 caracteres'
        ]
    ];
}