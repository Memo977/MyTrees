<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualizacionModel extends Model
{
    protected $table = 'actualizaciones_arboles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'arbol_id',
        'tamanio_actual',
        'estado',
        'descripcion',
        'foto',
        'fecha_actualizacion'
    ];


    protected $useTimestamps = false;


    protected $validationRules = [
        'arbol_id' => 'required|numeric',
        'tamanio_actual' => 'required|numeric',
        'estado' => 'required',
        'descripcion' => 'required'
    ];
    
    protected $validationMessages = [
        'arbol_id' => [
            'required' => 'El ID del árbol es requerido',
            'numeric' => 'El ID del árbol debe ser numérico'
        ],
        'tamanio_actual' => [
            'required' => 'El tamaño es requerido',
            'numeric' => 'El tamaño debe ser numérico'
        ],
        'estado' => [
            'required' => 'El estado es requerido'
        ],
        'descripcion' => [
            'required' => 'La descripción es requerida'
        ]
    ];

    protected $skipValidation = false;

    public function getHistorialGlobal()
{
    return $this->select('actualizaciones_arboles.*, 
                         arboles.especie_id, 
                         especies.nombre_comercial, 
                         usuarios.nombre')
        ->join('arboles', 'arboles.id = actualizaciones_arboles.arbol_id')
        ->join('especies', 'especies.id = arboles.especie_id')
        ->join('usuarios', 'usuarios.id = arboles.usuario_id')
        ->orderBy('actualizaciones_arboles.fecha_actualizacion', 'DESC')
        ->findAll();
}

    //Historial de actualizaciones completo de un árbol
    public function getHistorialCompleto($arbol_id)
    {
        return $this->select('actualizaciones_arboles.*, arboles.nombre_comercial, usuarios.nombre as amigo_nombre')
            ->join('arboles', 'arboles.id = actualizaciones_arboles.arbol_id')
            ->join('usuarios', 'usuarios.id = arboles.usuario_id')
            ->where('actualizaciones_arboles.arbol_id', $arbol_id)
            ->orderBy('actualizaciones_arboles.fecha_actualizacion', 'DESC')
            ->findAll();
    }
}