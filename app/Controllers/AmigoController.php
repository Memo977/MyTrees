<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AmigoController extends BaseController
{
    protected $amigoModel;
    protected $arbolModel;
    protected $actualizacionModel;

    public function __construct()
    {
        $this->amigoModel = new \App\Models\UsuarioModel();
        $this->arbolModel = new \App\Models\ArbolModel();
        $this->actualizacionModel = new \App\Models\ActualizacionModel();
        helper(['form']);
    
        
    }

    public function index()
    {
        // Lista todos los amigos (usuarios con rol_id = 3)
        $data['amigos'] = $this->amigoModel->where('rol_id', 3)->orderBy('nombre', 'ASC')->findAll();
        return view('admin/amigos/index', $data);
    }

    public function verArboles($id)
    {
        $data['amigo'] = $this->amigoModel->find($id);
        
        if (!$data['amigo']) {
            return redirect()->to('admin/amigos')->with('error', 'Amigo no encontrado');
        }

        // Utilizamos el builder para hacer un JOIN con la tabla especies
        $builder = $this->arbolModel->builder();
        $builder->select('arboles.*, especies.nombre_comercial');
        $builder->join('especies', 'especies.id = arboles.especie_id');
        $builder->where('arboles.usuario_id', $id);
        
        $data['arboles'] = $builder->get()->getResultArray();

        return view('admin/amigos/arboles', $data);
    }

    public function actualizarArbol($id)
    {
        $builder = $this->arbolModel->builder();
        $builder->select('arboles.*, especies.nombre_comercial');
        $builder->join('especies', 'especies.id = arboles.especie_id');
        $builder->where('arboles.id', $id);
        
        $data['arbol'] = $builder->get()->getRowArray();

        if (!$data['arbol']) {
            return redirect()->back()->with('error', 'Árbol no encontrado');
        }

        return view('admin/amigos/actualizar-arbol', $data);
    }

    public function guardarActualizacion()
    {
        $rules = [
            'arbol_id' => 'required|numeric',
            'tamanio' => 'required|numeric',
            'estado' => 'required|in_list[Disponible,Vendido]',
            'descripcion' => 'required'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', implode('<br>', $this->validator->getErrors()));
        }
    
        $foto = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('./uploads/actualizaciones', $newName);
            $foto = $newName;
        }
    
        $arbol_id = $this->request->getPost('arbol_id');
    
        $actualizacionData = [
            'arbol_id' => $arbol_id,
            'tamanio_actual' => $this->request->getPost('tamanio'),
            'estado' => $this->request->getPost('estado'),
            'descripcion' => $this->request->getPost('descripcion'),
            'foto' => $foto,
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];
    
        $this->actualizacionModel->insert($actualizacionData);
    
        
        $this->arbolModel->update($actualizacionData['arbol_id'], [
            'tamanio' => $actualizacionData['tamanio_actual'],
            'estado' => $actualizacionData['estado']
        ]);
    

        $arbol = $this->arbolModel->find($arbol_id);
        
        return redirect()->to(site_url('admin/amigos/arboles/' . $arbol['usuario_id']))
                        ->with('success', 'Actualización registrada correctamente');
    }

    public function historial($id)
    {
        $builder = $this->arbolModel->builder();
        $builder->select('arboles.*, especies.nombre_comercial, usuarios.nombre as amigo_nombre');
        $builder->join('especies', 'especies.id = arboles.especie_id');
        $builder->join('usuarios', 'usuarios.id = arboles.usuario_id');
        $builder->where('arboles.id', $id);
        
        $data['arbol'] = $builder->get()->getRowArray();

        if (!$data['arbol']) {
            return redirect()->back()->with('error', 'Árbol no encontrado');
        }

        $data['actualizaciones'] = $this->actualizacionModel
            ->where('arbol_id', $id)
            ->orderBy('fecha_actualizacion', 'DESC')
            ->findAll();

        return view('admin/amigos/historial', $data);
    }
}