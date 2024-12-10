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

    protected function prepareBaseData()
    {
        $rol_id = session()->get('rol_id');
        return [
            'isAdmin' => $rol_id == 1,
            'isAmigo' => $rol_id == 3,
            'baseRoute' => $rol_id == 1 ? 'admin' : ($rol_id == 3 ? 'amigo' : 'operador')
        ];
    }

    public function index()
    {
        $data = $this->prepareBaseData();
        $data['amigos'] = $this->amigoModel->where('rol_id', 3)->orderBy('nombre', 'ASC')->findAll();
        return view('shared/amigos/index', $data);
    }

    public function verArboles($id)
    {
        $data = $this->prepareBaseData();
        $data['amigo'] = $this->amigoModel->find($id);
        
        if (!$data['amigo']) {
            return redirect()->to($data['baseRoute'] . '/amigos')->with('error', 'Amigo no encontrado');
        }

        $builder = $this->arbolModel->builder();
        $builder->select('arboles.*, especies.nombre_comercial');
        $builder->join('especies', 'especies.id = arboles.especie_id');
        $builder->where('arboles.usuario_id', $id);
        
        $data['arboles'] = $builder->get()->getResultArray();
        return view('shared/amigos/arboles', $data);
    }

    public function actualizarArbol($id)
    {
        $data = $this->prepareBaseData();
        $builder = $this->arbolModel->builder();
        $builder->select('arboles.*, especies.nombre_comercial');
        $builder->join('especies', 'especies.id = arboles.especie_id');
        $builder->where('arboles.id', $id);
        
        $data['arbol'] = $builder->get()->getRowArray();

        if (!$data['arbol']) {
            return redirect()->back()->with('error', 'Árbol no encontrado');
        }

        return view('shared/amigos/actualizar-arbol', $data);
    }

    public function guardarActualizacion()
    {
        $data = $this->prepareBaseData();
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
        
        return redirect()->to(site_url($data['baseRoute'] . '/amigos/arboles/' . $arbol['usuario_id']))
                        ->with('success', 'Actualización registrada correctamente');
    }

    public function historial($id)
    {
        $data = $this->prepareBaseData();
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

        return view('shared/amigos/historial', $data);
    }
}