<?php

namespace App\Models;

use CodeIgniter\Model;

class ArbolModel extends Model
{
    protected $table = 'arboles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'usuario_id', 
        'especie_id', 
        'ubicacion_geografica', 
        'estado', 
        'precio', 
        'tamanio', 
        'foto_url', 
        'fecha_venta'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'especie_id' => 'required|integer',
        'ubicacion_geografica' => 'required',
        'estado' => 'required|in_list[Disponible,Vendido]',
        'precio' => 'required|numeric',
        'tamanio' => 'permit_empty|numeric'
    ];

    protected $validationMessages = [
        'especie_id' => [
            'required' => 'Debe seleccionar una especie',
            'integer' => 'La especie seleccionada no es válida'
        ],
        'ubicacion_geografica' => [
            'required' => 'La ubicación geográfica es obligatoria'
        ],
        'estado' => [
            'required' => 'El estado es obligatorio',
            'in_list' => 'El estado debe ser Disponible o Vendido'
        ],
        'precio' => [
            'required' => 'El precio es obligatorio',
            'numeric' => 'El precio debe ser un número'
        ]
    ];

    public function getAllTrees()
    {
        return $this->select('arboles.*, especies.nombre_comercial')
                    ->join('especies', 'especies.id = arboles.especie_id')
                    ->findAll();
    }

    public function getTree($id)
    {
        return $this->select('arboles.*, especies.nombre_comercial, especies.nombre_cientifico')
                    ->join('especies', 'especies.id = arboles.especie_id')
                    ->where('arboles.id', $id)
                    ->first();
    }
}